<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app', 40)->nullable();
            $table->string('apm', 40)->nullable();
            $table->string('nombre', 60)->nullable();
            $table->string('curp', 18)->nullable();
            $table->string('telefono_fijo', 10)->nullable();
            $table->string('telefono_celular', 13)->nullable();
            $table->string('correo', 100)->nullable()->nullable();
            $table->string('lugar_trabajo', 100)->nullable();
            $table->string('ocupacion', 100)->nullable();
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
        Schema::dropIfExists('tutores');
    }
}
