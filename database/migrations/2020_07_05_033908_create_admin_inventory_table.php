<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_book_inventory', function (Blueprint $table) {
            $table->increments('inventory_id');
            $table->integer('book_id');
            $table->double('book_price',8,2);
            $table->integer('book_qty');
            $table->double('book_sale_total_amount',8,2);
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
        Schema::dropIfExists('admin_inventory');
    }
}
