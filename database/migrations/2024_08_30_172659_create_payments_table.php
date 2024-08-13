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
        //pdt de cobro/pago (segun el signo) , multas bonos(recargos/descuentos),total pagado y un historico de las transacciones de pago
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('extra_id')->nullable();
            $table->foreign('extra_id')
                ->references('id')
                ->on('extras')
                ->onDelete('cascade');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('turn_id')->nullable();
            $table->foreign('turn_id')
                ->references('id')
                ->on('turns')
                ->onDelete('cascade');

            $table->enum('status', ['pendiente', 'rechazado', 'pagado']);
            $table->float('multas', 8, 2);
            $table->float('bonos', 8, 2);
            $table->float('total', 8, 2);
            $table->dateTime('fecha_pago');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
