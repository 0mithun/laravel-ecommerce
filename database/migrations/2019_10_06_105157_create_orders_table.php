<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('status',['pending','processing','completed','decline']);
            $table->decimal('grand_total', 8, 6);
            $table->unsignedInteger('item_count');

            $table->boolean('payment_status')->default(1);
            $table->string('payment_method')->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('country');
            $table->string('post_code');
            $table->string('phone_number');
            $table->string('notes')->nullable();
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
}
