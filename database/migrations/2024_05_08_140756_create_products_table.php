<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('sub_subcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_code')->unique()->nullable();
            $table->string('name',191);
            $table->string('slug',255)->unique();
            $table->longText('product_details')->nullable();
            $table->text('short_description')->nullable();
            $table->text('special_note')->nullable();
            $table->string('warranty',191)->nullable();
            $table->double('unit_price',8,2)->nullable();
            $table->double('discount_price',8,2)->default(0);
            $table->integer('sku')->default(0);
            $table->integer('alert_quantity')->default(0);
            $table->string('video_link')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('thumbnail_path',255)->nullable();
            $table->string('product_unit')->nullable();
            $table->string('product_sizes',500)->nullable();
            $table->string('product_colors',500)->nullable();
            $table->string('product_tags',500)->nullable();
            $table->boolean('is_exchangeable')->default(false);
            $table->boolean('is_refundable')->default(false);
            $table->string('status',10)->default("active")->comment("active,in-active");
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->softDeletes();
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
};
