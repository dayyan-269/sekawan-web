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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->enum('status', ['selesai', 'menunggu', 'batal', 'berlangsung'])->nullable()->default('menunggu');
            $table->integer('bbm')->unsigned()->default(0);
            $table->dateTime('tanggal_order')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();

            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
