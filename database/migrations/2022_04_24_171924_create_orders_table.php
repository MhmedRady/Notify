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
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['pending', 'processing', 'payment', 'review', 'completed', 'cancelled', 'declined', 'new'])->nullable();
            $table->timestamps();
//            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('status_id')->nullable()->default(1)->constrained('order_status')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();

            $table->foreignId('delivery_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();

            $table->foreignId('product_id')->nullable()->constrained()->references('id')->on('products')->nullOnDelete();
            $table->double('price')->default(0);

            $table->foreignId('user_address_id')->nullable()->constrained()->references('id')->on('user_address')->nullOnDelete();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('received_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
