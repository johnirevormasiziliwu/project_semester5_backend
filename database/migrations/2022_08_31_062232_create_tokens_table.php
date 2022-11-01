<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id("tk_id");
            $table->string('tk_token');
            $table->dateTime('tk_expired');
            //foreign key
            $table->unsignedBigInteger('tk_us_id')->nullable();
            $table->foreign('tk_us_id', 'fk_tk_us_id')->references('us_id')->on('users');
            //timestamp
            $table->timestamp("tk_create_at")->default(date('Y-m-d H:i:s'));
            $table->dateTime("tk_update_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}   