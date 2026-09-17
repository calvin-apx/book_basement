<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBookRecommendationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_recommendation', function (Blueprint $table) {
            //
            $table->integer('genre_id_1')->after('id');
            $table->integer('genre_id_2')->after('genre_id_1');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_recommendation', function (Blueprint $table) {
            //
            $table->dropColumn(['genre_id_1','genre_id_2']);
        });
    }
}
