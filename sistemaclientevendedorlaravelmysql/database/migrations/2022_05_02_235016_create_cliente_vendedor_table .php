<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteVendedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::create('cliente_vendedor', function (Blueprint $table) {
            //
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente')->onDelete('cascade');;
            $table->foreignId('vendedor_id')->constrained('vendedor')->onDelete('cascade');;

            

        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::dropIfExists('cliente_vendedor');
    }
}
