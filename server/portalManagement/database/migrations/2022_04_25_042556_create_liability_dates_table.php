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
        Schema::create('liability_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liability_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('required_amount');
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('liability_dates');
    }
};
