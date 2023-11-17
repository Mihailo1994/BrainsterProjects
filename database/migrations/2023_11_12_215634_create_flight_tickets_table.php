<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flight_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('from');
            $table->string('to');
            $table->string('travel_date');
            $table->string('return_date')->nullable();
            $table->string('type');
            $table->integer('n_of_adults');
            $table->integer('n_of_kids');
            $table->integer('n_of_babies');
            $table->string('class');
            $table->enum('status', ['completed', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_tickets');
    }
};
