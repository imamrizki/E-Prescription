<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObatalkesMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obatalkes_m', function (Blueprint $table) {
            $table->id('obatalkes_id');
            $table->string('obatalkes_kode', 100)->nullable();
            $table->string('obatalkes_nama', 250)->nullable();
            $table->double('stok')->nullable();
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
        Schema::dropIfExists('obatalkes_m');
    }
}
