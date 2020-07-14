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
            $table->string('name');
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();;
            $table->integer('brand_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('quantity');
            $table->integer('alert_quantity')->nullable();
            $table->text('description');
            $table->string('color');
            $table->string('size');
            $table->double('cost_price');
            $table->double('selling_price');
            $table->double('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->boolean('main_slider')->default(0)->nullable();
            $table->boolean('mid_slider')->default(0)->nullable();
            $table->boolean('hot_deal')->default(0)->nullable();
            $table->boolean('buy_get_one')->default(0)->nullable();
            $table->boolean('best_rated')->default(0)->nullable();
            $table->boolean('hot_new')->default(0)->nullable();
            $table->boolean('trend')->default(0)->nullable();
            $table->boolean('featured')->default(0)->nullable();;
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->enum('status',['Active','Inactive']);
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
        Schema::dropIfExists('products');
    }
}
