<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class product extends Model{
    protected $primaryKey = 'pr_id';
    protected $hidden = ['pr_create_at', 'pr_update_at', 'pr_deleted_at'];
    const CREATED_AT ='pr_create_at';
    const UPDATED_AT ='pr_update_at';


    public static function insertGetId($productRequest)
    {
        return DB::table('products')->insertGetId($productRequest);
    }
    public static function deleteById($productId)
    {
        return DB::table("products")
        ->where(["pr_id" => $productId])
        ->delete();

    }


}
