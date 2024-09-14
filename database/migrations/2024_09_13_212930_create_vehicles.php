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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('no_kendaraan', 100)->nullable()->default('-');
            $table->enum('jenis_kendaraan', ['tambang', 'penumpang'])->nullable();
            $table->enum('kepemilikan', ['sewa', 'dibeli'])->nullable()->default('dibeli');
            $table->enum('status', ['aktif', 'tidak aktif', 'maintenance'])->nullable()->default('aktif');
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
        Schema::dropIfExists('vehicles');
    }
};
