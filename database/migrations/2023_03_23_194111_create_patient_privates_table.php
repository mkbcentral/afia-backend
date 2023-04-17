<?php

use App\Models\Commune;
use App\Models\FormPatient;
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
        Schema::create('patient_privates', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->enum('gender',['F','M'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('other_phone',20)->nullable();
            $table->foreignIdFor(Commune::class)->nullable()->constrained();
            $table->string('quartier',255)->nullable();
            $table->string('street',255)->nullable();
            $table->foreignIdFor(FormPatient::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_privates');
    }
};
