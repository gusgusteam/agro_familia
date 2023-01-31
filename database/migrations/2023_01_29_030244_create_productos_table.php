<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('precio_venta');
            $table->double('precio_compra');
            $table->tinyInteger('stock')->default(0);
            $table->tinyInteger('stock_minimo');
            $table->string('origen')->default("desconocido");
            $table->tinyInteger('activo')->default(1);
            $table->foreignId('id_proveedor')->nullable()->constrained('proveedors')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('id_tipo_producto')->nullable()->constrained('tipo__productos')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('productos');
    }
}
