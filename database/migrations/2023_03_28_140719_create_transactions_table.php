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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('external_transaction_id')->nullable();
            $table->timestamp('date');
            $table->string('status');
            $table->string('type');
            $table->text('to_message')->nullable();
            $table->string('from');
            $table->string('from_name');
            $table->string('from_handler_name');
            $table->string('to');
            $table->string('to_name');
            $table->string('to_handler_name');
            $table->string('initiated_by');
            $table->string('on_behalf_of')->nullable();
            $table->string('approved_by')->nullable();
            $table->decimal('original_amount', 12, 2);
            $table->string('currency');
            $table->decimal('amount', 12, 2);
            $table->decimal('external_amount', 12, 2)->nullable();
            $table->string('external_currency')->nullable();
            $table->decimal('external_fx_rate', 12, 6)->nullable();
            $table->string('external_service_provider')->nullable();
            $table->decimal('fee', 12, 2)->nullable();
            $table->string('fee_currency')->nullable();
            $table->decimal('discount', 12, 2)->nullable();
            $table->string('discount_currency')->nullable();
            $table->decimal('promotion', 12, 2)->nullable();
            $table->string('promotion_currency')->nullable();
            $table->decimal('coupon', 12, 2)->nullable();
            $table->string('coupon_currency')->nullable();
            $table->decimal('balance', 12, 2)->nullable();
            $table->string('balance_currency')->nullable();
            $table->text('information')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
