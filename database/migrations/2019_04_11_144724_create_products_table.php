<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string("name");

            $table->string("slug")->unique();

            $table->mediumText("description");

            $table->string("image");

            $table->bigInteger("scid")->unsigned()->default(1);
            $table->foreign("scid")->references("id")->on("sub_categories");

            $table->integer("bid")->unsigned()->default(1);
            $table->foreign("bid")->references("id")->on("brands");

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
        Schema::dropIfExists('products');
    }
}
