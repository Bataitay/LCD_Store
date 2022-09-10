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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('0')->comment('0=Pending, 1=Approved');
            $table->string('note')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('address');
            $table->string('order_total_price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('customer_id')->constrained('customers');

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
