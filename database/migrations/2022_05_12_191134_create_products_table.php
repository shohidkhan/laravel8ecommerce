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
          $table->id();
          $table->unsignedBigInteger('category_id');
          $table->unsignedBigInteger('subcategory_id');
          $table->integer('childcategory_id')->nullable();
          $table->integer('brand_id')->nullable();
          $table->integer('pickup_point_id')->nullable();
          $table->string('name');
          $table->string('slug')->nullable();
          $table->string('code');
          $table->string('unit')->nullable();
          $table->string('tags')->nullable();
          $table->string('color')->nullable();
          $table->string('size')->nullable();
          $table->string('video')->nullable();
          $table->string('purchase_price')->nullable();
          $table->string('selling_price')->nullable();
          $table->string('discount_price')->nullable();
          $table->string('stock_quantity')->nullable();
          $table->string('description')->nullable();
          $table->string('thumbnail')->nullable();
          $table->string('images')->nullable();
          $table->string('featured')->nullable();
          $table->string('today_deal')->nullable();
          $table->string('status')->nullable();
          $table->string('flash_deal_id')->nullable();
          $table->string('cash_on_delivery')->nullable();
          $table->integer('warehouse_id')->nullable();
          $table->integer('admin_id')->nullable();
          $table->string('date')->nullable();
          $table->string('month')->nullable();
          $table->timestamps();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
          $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
