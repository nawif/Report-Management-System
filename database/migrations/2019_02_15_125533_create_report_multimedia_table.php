<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_multimedia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->unique();
            $table->string('title');
            $table->foreign('report_id')->references('id')->on('reports'->onDelete('cascade'));
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
        Schema::dropIfExists('report_multimedia');
    }
}
