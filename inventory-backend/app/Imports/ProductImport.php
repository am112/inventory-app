<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToCollection, WithChunkReading
{
    /**
    * @param Collection $collection
    */

    /*
        0 => "Product ID"
        1 => "Types"
        2 => "Brand"
        3 => "Model"
        4 => "Capacity"
        5 => "Status"
    */
    public function collection(Collection $collection): void
    {
        // exclude the header
        $collection = $collection->except(0);

        // get unique ID and pull from DB
        $productsID = $collection->unique(0)->pluck(0);
        $products = Product::select('id', 'type', 'brand', 'model', 'capacity', 'quantity')
        ->whereIn('id',$productsID)->get();

        // foreach product in DB, Add or minus quantity based on status
        foreach($products as $product){
            foreach($collection->where(0, $product->id) as $item){
                if($item[5] == 'Sold'){
                    $product->quantity -= 1;
                }else if($item[5] == 'Buy'){
                    $product->quantity += 1;
                }
            }
        }

        // bulk insert for minimize sql query
        Product::upsert($products->toArray(), ['id'], ['quantity']);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
