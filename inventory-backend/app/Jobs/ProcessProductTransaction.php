<?php

namespace App\Jobs;

use App\Events\ProductUpdateEvent;
use App\Imports\ProductImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessProductTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    private $filePath;
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $file = storage_path($this->filePath);
            Excel::import(new ProductImport, $file);
            event(new ProductUpdateEvent('updated-sucess'));
        }catch(\Exception $e){
            event(new ProductUpdateEvent('updated-failed'));
        }
    }
}
