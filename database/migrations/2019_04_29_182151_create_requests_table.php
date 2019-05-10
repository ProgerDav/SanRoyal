<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('organization');
            $table->string('speciality')->nullable()->default(NULL);
            $table->string('city')->nullable()->default(NULL);
            $table->string('source')->nullable()->default(NULL);
            $table->string('site')->nullable()->default(NULL);
            $table->text('categories');
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
        Schema::dropIfExists('requests');
    }
}
