<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("pr_id");
            $table->string("pr_code");
            $table->string("pr_name");
            $table->bigInteger("pr_price");
            $table->bigInteger("pr_stock")->default(0);
            $table->timestamp("pr_create_at");
            $table->dateTime("pr_update_at")->useCurrent();
            $table->dateTime("pr_deleted_at")->nullable()->default(null);
            
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
