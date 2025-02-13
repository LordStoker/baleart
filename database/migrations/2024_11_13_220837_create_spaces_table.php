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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('regNumber', 10)->unique();
            $table->text('observation_CA', 5000)->nullable();
            $table->text('observation_ES', 5000)->nullable();
            $table->text('observation_EN', 5000)->nullable();
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('website', 100);
            $table->enum('accessType', ['y', 'n', 'p']);
            $table->decimal('totalScore', 4, 2);
            $table->integer('countScore');
            $table->foreignId('address_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('space_type_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('restrict'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
