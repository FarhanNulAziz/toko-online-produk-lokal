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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name', 100);
            $table->string('phone', 20);
            $table->text('address');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->string('payment_method', 50)->nullable();
            $table->enum('status', [
                'pending',
                'paid',
                'shipped',
                'done',
                'cancelled'
            ])->default('pending');

            $table->timestamp('order_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
