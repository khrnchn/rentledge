<?php

use App\Enums\AvailabilityStatusEnum;
use App\Enums\PropertyCategoryEnum;
use App\Enums\PropertyTypeEnum;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id');
            $table->string('name');
            $table->string('address');
            $table->enum('type', PropertyTypeEnum::toValues());
            $table->enum('category', PropertyCategoryEnum::toValues());
            $table->float('rental_fee', 10, 2);
            $table->float('deposit_fee', 10, 2);
            $table->enum('availability_status', AvailabilityStatusEnum::toValues());
            $table->text('least_agreement')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
