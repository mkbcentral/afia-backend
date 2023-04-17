<?php

use App\Models\CategoryTarification;
use App\Models\Hospital;
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
        Schema::create('tarifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abreviation')->nullable();
            $table->integer('price_private')->default(0);
            $table->integer('price_subscribe')->default(0);
            $table->boolean('status')->default(true);
            $table->foreignIdFor(Hospital::class)->constrained();
            $table->foreignIdFor(CategoryTarification::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifications');
    }
};
