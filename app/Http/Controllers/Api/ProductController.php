<?php
namespace App\Http\controllers\Api;

use App\Http\Controllers\PbeBaseController;
use App\Model\Product;



class ProductController extends PbeBaseController {
    
    public function index()
    {
        $products = Product::where('pr_deleted_at', null)
        ->get();
        return response()->json($products,200);
    }

    public function store()
    {
        $this->isAdmin();
        $prCode = request('code');
        $prName = request ('name');
        $prPrice = request ('price');

        #periksa apakah ada data yang kosong 
        #1.variabel untuk menampung semua error
        $errors = [];
        #cek apakah ada data yang kosong 
        if(empty($prCode)){
            $errors[]="kode produk tidak boleg kosong";
        }
        if(empty($prName)){
            $errors[] = "nama produk tidak boleh kosong";
        }
        if (empty($prPrice) || $prPrice <= 0){
            $errors []=  "harga produk tidak boleh kosong dan harus lebih besar dari pada 0";
        }

        #cek jika kode sudah digunakan 
        $product = Product::where("pr_code", $prCode)->first();
       
        if($product != null){
            $errors[]="kode produk $prCode sudah digunakan";
        }
        if(count($errors) > 0) {
            return response()->json(["errors" => $errors], 400);
        }


        $productRequest =[
            'pr_code' => $prCode,
            'pr_name' => $prName,
            'pr_price' => $prPrice,
        ];
        $productId = Product::insertGetId($productRequest);
        $productResponse = Product::find($productId);

        return response()->json($productResponse, 201);
       
    }
    
    
    public function getById($productId)
    {
        $productResponse = Product::where('pr_id', $productId)
            ->where('pr_deleted_at', null)->first();
        if($productResponse === null){
            return response()->json(["error" => "Not Found"], 404);
        }
        return response()->json($productResponse, 200);
    }

    
    public function update($productId)
    {
        #ambil data dari request body
        $this->isSuperadmin();
        $prName = request ('name');
        $prPrice = request ('price');
        $prStock = request('stock');
        
       #populate data sesuai dengan database
        $productRequest =
        [          
            'pr_name' => $prName,
            'pr_price' => $prPrice,
            'pr_stock' => $prStock,
        ];

        #periksa apakah ada data yang kosong 
        #1.variabel untuk menampung semua error
        $errors = [];
        #cek apakah ada data yang kosong 
        if(empty($prName)){
            $errors[]="Nama produk tidak boleh kosong";
        }
        if(empty($prPrice) || $prPrice <= 0){
            $errors[] = "Harga produk tidak boleh kosong dan harus lebih besar dari 0";
        }
        if (empty($prStock) || $prStock <= 0){
            $errors []=  "Stock produk tidak boleh kosong dan harus lebih besar dari pada 0";
        }

        #cek jika kode sudah digunakan 
        $product = Product::where("pr_code", $prName)->first();
        if($product != null){
            $errors[]="kode produk $prName sudah digunakan";
        }
        if(count($errors) > 0) {
            return response()->json(["errors" => $errors], 400);
        }

        #proses update
        Product::where('pr_id', $productId)
        ->update($productRequest);
        return response()->json(['message' => "data berhasil diupdate"]);

        #ambil data terbaru dan kembalikan 
        $productResponse = Product::find($productId);
        return response()->json($productResponse); 

    }

    
    public function softDelete($productId)
    {
        #proses update
        $this->isSuperadmin();
        Product::where('pr_id', $productId)
        ->update(["pr_deleted_at"=>now()]); #direstore ubah jadi null
        return response()
        ->json(['message' => "data berhasil dihapus"]);
    }

    
    public function delete ($productId)
    {
        $this->isSuperadmin();
        Product::deleteById($productId);
        return response()
        ->json(['message' => "data berhasil dihapus"]);
    }

    
    public function restore($productId)
    {
        #proses update
        $this->isSuperadmin();
        Product::where('pr_id', $productId)
        ->update(["pr_deleted_at"=>null]); 
        return response()
        ->json(['message' => "data berhasil dikembalikan"]);
    }
}