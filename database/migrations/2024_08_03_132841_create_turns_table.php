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
        Schema::create('turns', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('extra_id')->nullable();
            $table->foreign('extra_id')
                ->references('id')
                ->on('extras')
                ->onDelete('cascade');

            $table->dateTime('date');
            $table->string('entry_time');
            $table->string('departure_time');
            $table->string('total_hours');
            $table->enum('status', ['pendiente', 'pagado', 'cancelado', 'ejecutado'])->default('pendiente');
            $table->double('hourly_rate')->nullable(); //precio x hora €
            $table->double('total')->nullable(); // total generado €
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turns');
    }
};
