<?php 

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request; 


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index ()
    { 
      $products= Product::all(); 
      
      return response()->json($products); 
    }

    public function store(Request $request)
    {
        $name = $request->input('name'); 
        $qty = $request->input('qty'); 

        $products = Product::create([
            'name'=>$name, 
            'qty'=>$qty, 
        ]); 

        if ($products)
        {
            return response()->json([
                'Success'=>true, 
                'Message'=>'Data product berhasil ditambahkan', 
                'Data'=> $products,
            ], 201); 
        }
        else 
        {
            return response()->json([
                'Message'=> 'Data Gagal di tambahkan'
            ], 400); 
        }
    
    }

    public function show($id)
    {
        $products = Product::find($id); 
        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        
        $name = $request->input('name'); 
        $qty = $request->input('qty'); 

       $products = Product::find($id);
       $update_product = $products->update([
           'name'=>$name,
           'qty'=>$qty, 
       ]);

        if ($update_product)
        {
            return response()->json([
                'Success'=>true, 
                'Message'=>'Data product berhasil update', 
            
            ], 201); 
        }
        else 
        {
            return response()->json([
                'Message'=> 'Data Gagal di update'
            ], 400); 
        }
    }

    public function delete($id)
    {
        Product::destroy($id);
        return response()->json([
            'Message'=>'Data Berhasil dihapus', 
        ], 201);
    }

    
}