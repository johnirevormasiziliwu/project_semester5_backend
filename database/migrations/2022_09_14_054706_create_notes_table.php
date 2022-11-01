<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id("n_id");
            $table->string('n_title');
            $table->text('n_note');
            $table->unsignedBigInteger('n_us_id');
            $table->foreign('n_us_id', 'fk_n_us_id')
            ->references('us_id')->on('users');
            #timestamp
            
            $table->timestamp('n_create_at')->default(date('Y-m-d H:i:s'));
            $table->dateTime("n_update_at")->useCurrent();
            $table->dateTime("n_deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}