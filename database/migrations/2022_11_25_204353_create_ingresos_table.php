<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->double('monto');
            $table->timestamp('fecha');
            $table->tinyInteger('activo')->default(1);
            $table->tinyInteger('visto')->default(0);
            $table->foreignId('id_caja')->nullable()->constrained('cajas')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('id_tipo')->nullable()->constrained('tipos')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('id_usuario')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete(); //
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
        Schema::dropIfExists('ingresos');
    }
}
