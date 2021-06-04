<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('sales_person_id')->nullable();
            $table->integer('license_type_id')->nullable();
            $table->longText('license');
            $table->integer('license_duration')->nullable();
            $table->dateTime('license_expiry')->nullable();
            $table->longText('allowed_test')->nullable();
            //adding no_of_devices_allowed column to store number of devices on which one license is valid
            $table->integer('no_of_devices_allowed')->default(1);
            $table->integer('is_deleted')->default('0')->nullable();
            $table->dateTime('trial_activated_at')->nullable('0000-00-00');
            $table->dateTime('license_activated_at')->nullable('0000-00-00');
            // $table->longText('device_name')->nullable();
            // $table->longText('device_model')->nullable();
             $table->longText('user_device_unique_id')->nullable();
             $table->tinyInteger('is_active')->default('0');
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
        Schema::dropIfExists('licenses');
    }
}
