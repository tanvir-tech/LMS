<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('bookname');
            $table->string('authorname');
            $table->string('publisher');
            $table->integer('year');
            // $table->integer('category_id');
            $table->integer('edition');
            $table->string('language');
            // $table->integer('quantity');
            // $table->string('callid');
            // $table->string('bookcoverlink');
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
        Schema::dropIfExists('book_requests');
    }
};
