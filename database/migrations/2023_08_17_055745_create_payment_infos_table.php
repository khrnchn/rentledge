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
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id');
            $table->string('account_name');
            $table->string('bank_name');
            $table->string('account_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_infos');
    }
};
