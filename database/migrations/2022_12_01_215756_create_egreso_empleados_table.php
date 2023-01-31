<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresoEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egreso_empleados', function (Blueprint $table) {
            $table->id();
            $table->integer('monto')->default(0);
            $table->foreignId('id_egreso')->nullable()->constrained('egresos')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('id_empleado')->nullable()->constrained('empleados')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('egreso_empleados');
    }
}
