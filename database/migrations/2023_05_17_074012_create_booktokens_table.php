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
        Schema::create('booktokens', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->unsigned();
            $table->string('book_call_id');
            $table->string('book_copy_id');
            $table->boolean('isavailable')->default(1);
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
        Schema::dropIfExists('booktokens');
    }
};
