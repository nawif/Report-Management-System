<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('roles')->insert(
            array(
                'name' => 'View',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Delete',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Edit',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Create',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
