<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bin_id');
            $table->string('status');
            $table->longText('remarks')->nullable();
            $table->timestamps();

            $table->foreign('bin_id')->references('id')->on('bins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bin_statuses');
    }
}
