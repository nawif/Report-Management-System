<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('report_id')->references('id')->on('reports'->onDelete('cascade'));
            $table->foreign('tag_id')->references('id')->on('tags'->onDelete('cascade'));
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
        Schema::dropIfExists('report_tags');
    }
}
