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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('name_ar')->unique();
            $table->bigInteger('license_number');
            $table->text('license_address');
            $table->date('date_of_issuance_of_license');
            $table->bigInteger('central_number');
            $table->bigInteger('file_number');
            $table->bigInteger('civil_authority_number');
            $table->bigInteger('commercial_register_number');
            $table->bigInteger('address_automatic_number');
            $table->string('description');
            $table->text('address');
            $table->date('expired_at')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
