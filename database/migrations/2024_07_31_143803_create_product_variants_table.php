<?php

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(ProductSize::class)->constrained();
            $table->foreignIdFor(ProductColor::class)->constrained();
            $table->unsignedInteger('quality')->default(0);
            $table->string('img')->nullable();
            //dat lai ten, co gioi han so luong do dai index
            $table->unique(['product_id', 'product_size_id', 'product_color_id'], 'product_variants_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
