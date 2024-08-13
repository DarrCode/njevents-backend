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
        Schema::create('request_extras', function (Blueprint $table) {
            $table->id();

            $table->string('extra_type');
            $table->date('date');
            $table->enum('status', ['pending', 'aproved', 'rejected'])->default('pending');
            $table->integer('quantity');
            $table->string('entry_time');
            $table->string('departure_time');
            $table->string('dress_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_extras');
    }
};
