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
        Schema::create('extras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('extra_type_id');
                $table->foreign('extra_type_id')
                    ->references('id')
                    ->on('extra_types')
                    ->onDelete('cascade');

            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_day');
            $table->string('phone');
            $table->string('dni');
            $table->string('dni_expiration');
            $table->string('genre');
            $table->string('street');
            $table->string('apartament');
            $table->string('municipality');
            $table->string('province');
            $table->string('postal_code');
            $table->string('height');
            $table->string('weight');
            $table->string('shirt_size');
            $table->string('shoe_size');
            $table->boolean('has_vehicle');
            $table->string('vehicle')->nullable();
            $table->string('vehicle_capacity')->nullable();
            $table->string('specialities')->nullable();
            $table->string('experience')->nullable();
            $table->string('profile')->nullable();
            $table->string('dni_front')->nullable();
            $table->string('dni_back')->nullable();
            $table->string('social_security_front')->nullable();
            $table->string('social_security_back')->nullable();
            $table->string('license_front')->nullable();
            $table->string('license_back')->nullable();
            $table->string('food_front')->nullable();
            $table->string('food_back')->nullable();
            $table->string('title_hosteleria')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extras');
    }
};
