<?php

namespace App\Services;

use App\Models\Product;

class ProductService{
    public function findById($id)
    {
            $product=Product::find($id);
            
        
        return $product;
    }
    public function findByUserId($id)
    {
        // dd($id);
        try{
            $products=Product::with('size')->where('user_id',$id)->get();
            // dd($products);
            
        }catch(\Throwable $e)
        {
            $products=$e->getMessage();
        }
        return $products;
        
    }
    public function addProduct($request,$id)
    {
        try{
           
            $data=[
                'name'=>$request['name'],
                'price'=>$request['price'],
                'status'=>$request['status'],
                'size_id'=>$request['size'],
                'user_id'=>$id
            ];
            Product::create($data);
            $response=[
                "status"=>"success",
                "message"=>"Product created successfully"
            ];
        }catch(\Throwable $e)
        {
            $response=[
                "status"=>"error",
                "message"=>$e->getMessage()
            ];
        }
       
        return $response;
    }

    public function updateProduct($request,$id)
    {
        try{
            
            $product=Product::find($id);
            $data=[
                'name'=>$request['name'],
                'price'=>$request['price'],
                'status'=>$request['status'],
                'size_id'=>$request['size'],
            ];
            $product->update($data);
            $response=[
                "status"=>"success",
                "message"=>"Product updated successfully"
            ];
        }catch(\Throwable $e)
        {
            $response=[
                "status"=>"error",
                "message"=>$e->getMessage()
            ];
        }
       
        return $response;
    }


    public function destroy($id)
    {
        try{
            $product=Product::find($id);
            $product->delete();
            $response=[
                "status"=>"success",
                "message"=>"Product deleted successfully"
            ];
        }catch(\Throwable $e)
        {
            $response=[
                "status"=>"error",
                "message"=>$e->getMessage()
            ];
        }
       
        return $response;
    }
}