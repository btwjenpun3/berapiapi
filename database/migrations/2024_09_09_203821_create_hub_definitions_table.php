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
        Schema::create('hub_definitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hub_id');
            $table->foreign('hub_id')->references('id')->on('hubs')->onDelete('cascade');
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('method');
            $table->string('endpoint')->nullable();
            $table->json('path_parameter');
            $table->json('headers');
            $table->json('queries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hub_definitions');
    }
};
