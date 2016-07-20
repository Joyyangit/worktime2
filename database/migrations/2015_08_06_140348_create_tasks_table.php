<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('author');
            $table->integer('leader');

            $table->smallInteger('caty')->default( 1 );
            $table->smallInteger('priority')->default( 1 );
            $table->smallInteger('department')->default( 1 );
            $table->smallInteger('status')->default( 1 );

            $table->integer('tag')->default( 1 );

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
        //
    }
}
