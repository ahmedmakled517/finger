<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegestrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regestrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("date");
            $table->string("attend");
            $table->string("sinout");
            // $table->string("hour_add");
            // $table->string("hour_dis");
            $table->string("employee_id");
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
        Schema::dropIfExists('regestrations');
    }
}
