<?php

use App\Models\Branch;
use App\Models\Hospital;
use App\Models\PatientType;
use App\Models\User;
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
        Schema::create('form_patients', function (Blueprint $table) {
            $table->id();
            $table->string('number',20)->unique();
            $table->foreignIdFor(Hospital::class)->constrained();
            $table->foreignIdFor(Branch::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_patients');
    }
};
