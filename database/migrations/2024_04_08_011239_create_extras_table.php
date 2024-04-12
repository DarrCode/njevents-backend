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

            $table->integer('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('language_id');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('adress');

            $table->string('personal_identification');
            $table->string('height');
            $table->string('clothing_size');
            $table->string('clothing_restrictions');
            $table->string('CV');
            $table->string('years_experience');

            $table->string('specialities');
            $table->string('certifications');
            $table->string('turn');
            $table->string('holiday_availability');
            $table->string('special_events');
            $table->boolean('vehicle');

            $table->string('type_vehicle');
            $table->string('capacity_vehicle');
            $table->string('Location_preferences ');
            $table->string('health_conditions');
            $table->string('comments');
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
