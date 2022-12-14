<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_devices', function (Blueprint $table) {
            $table->id();
            $table->string('license_id');
            $table->string('user_id');
            $table->string('device_id');
            $table->string('device_name')->nullable();
            $table->string('device_os')->nullable();
            $table->dateTime('activation_date');
            $table->boolean('is_deleted')->default('0')->nullable();
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
        Schema::dropIfExists('license_devices');
    }
}
