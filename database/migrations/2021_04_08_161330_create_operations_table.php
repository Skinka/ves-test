<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->string('operation_id')->unique();
            $table->double('filled')->default(0);
            $table->double('spent')->default(0);
            $table->double('change')->default(0);
            $table->timestamps();
        });

        Schema::create('operation_products', function (Blueprint $table) {
            $table->id();
            $table->string('operation_id');
            $table->foreignId('product_id');
            $table->string('name');
            $table->double('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_products');
        Schema::dropIfExists('operations');
    }
}
