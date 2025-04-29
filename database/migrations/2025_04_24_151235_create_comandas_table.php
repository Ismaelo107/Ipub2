<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comandas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesa_id')->constrained('mesas');
            //Desde el stock puedo acceder a las categorias
            //$table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('stock_id')->constrained('stocks');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio', 8, 2);
            //$table->enum('estado', ['abierta', 'pendiente', 'cerrada'])->default('cerrada');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comandas');
    }
};
