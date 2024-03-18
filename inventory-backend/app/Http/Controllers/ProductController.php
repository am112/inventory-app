<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Jobs\ProcessProductTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'field' => ['in:id,type,brand,model,capacity,quantity'],
            'direction' => ['in:asc,desc']
        ]);

        $products = Product::query();

        if($request->filled('search')){
            foreach(Product::SEARCHABLE as $index => $column){
                if($index == 0){
                    $products->where($column, 'LIKE', '%'.$request->search.'%');
                }else{
                    $products->orWhere($column, 'LIKE', '%'.$request->search.'%');
                }
            }
        }
        if($request->filled(['field', 'direction'])){
            $products->orderBy($request->field, $request->direction);
        }

        $products = $products->paginate(10)->withQueryString();

        return ProductResource::collection($products);
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required',
        ]);

        $imagePath = $request->file('file')->store('file');
        ProcessProductTransaction::dispatch('app/' . $imagePath);
        return ['success' => true];
    }
}
