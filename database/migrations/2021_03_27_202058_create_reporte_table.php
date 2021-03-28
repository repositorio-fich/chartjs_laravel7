<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteTable extends Migration
{
    public function up()
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->float('total');
            $table->timestamps();
        });
    }

    public function down(){ Schema::dropIfExists('reporte'); }
}
