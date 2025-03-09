<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("price");
            $table->string("oldPrice");
            $table->boolean("isSale")->default(true);
            $table->text("image")->nullable();
            $table->boolean("isNew")->default(true);
            $table->bigInteger("category_id");
            $table->boolean("isStocked")->default(true);
            $table->string("productNumber");
            $table->json("imageGallery")->nullable();
            $table->json("colors")->nullable();
            $table->text("content")->nullable();
            $table->text("description")->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
