<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepRacikanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_racikan_detail', function (Blueprint $table) {
            $table->id('racikan_detail_id');
            $table->integer('resep_racikan_id');
            $table->integer('obatalkes_id');
            $table->double('jumlah');
            $table->text('additional_data')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_count')->nullable();
            $table->dateTime('last_modified_date')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->dateTime('deleted_date')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_racikan_detail');
    }
}
