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
        Schema::create('charging_points', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 200);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('type', 50);
            // Type es si es coche o mobil
            $table->integer('power')->nullable();
            //Nullable pos si no hay datos
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('status', 50)->default('proposed');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_points');
    }
};
