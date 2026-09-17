<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_information', function (Blueprint $table) {
            $table->increments('book_id');
            $table->integer('genre_id');
            $table->integer('image_id');
            $table->text('title',100);
            $table->text('sub_title',100)->nullable();
            $table->text('description',100)->nullable();
            $table->text('authors',100)->nullable();
            $table->text('publisher',100)->nullable();
            $table->integer('page_count');
            $table->float('rating', 8, 2)->nullable();
            $table->string('status')->default('AC');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_information');
    }
}
