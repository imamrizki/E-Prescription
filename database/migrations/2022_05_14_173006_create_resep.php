<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id('resep_id');
            $table->string('resep_kode', 50);
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
        Schema::dropIfExists('resep');
    }
}
