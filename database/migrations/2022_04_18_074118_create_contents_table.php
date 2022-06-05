<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
           
            $table->unsignedBigInteger('sub_content_id')->nullable();
            $table->foreign('sub_content_id')->references('id')->on('contents');

            $table->unsignedBigInteger('compare_id')->nullable();
            $table->foreign('compare_id')->references('id')->on('contents');
           
            $table->unsignedBigInteger('revise_year_id')->nullable();
            $table->foreign('revise_year_id')->references('id')->on('revise_years');
           
            $table->text('content')->nullable();
            $table->text('content_text')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
