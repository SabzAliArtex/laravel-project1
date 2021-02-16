<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_activations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longText('license');
            $table->dateTime('license_expiry')->nullable();
            $table->dateTime('trial_activated_at')->nullable('0000-00-00');
            $table->dateTime('license_activated_at')->nullable('0000-00-00');
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
        Schema::dropIfExists('license_activations');
    }
}
