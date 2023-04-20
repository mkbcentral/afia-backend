<?php

use App\Models\Branch;
use App\Models\Consultation;
use App\Models\Currency;
use App\Models\FormPatient;
use App\Models\Hospital;
use App\Models\Rate;
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
        Schema::create('invoice_privates', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignIdFor(Hospital::class)->constrained();
            $table->foreignIdFor(Branch::class)->constrained();
            $table->foreignIdFor(FormPatient::class)->constrained();
            $table->foreignIdFor(Consultation::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Rate::class)->constrained();
            $table->foreignIdFor(Currency::class)->constrained();
            $table->boolean('is_valided')->default(false);
            $table->boolean('is_cons_paid')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_printed')->default(false);
            $table->boolean('is_hospitalized')->default(false);
            $table->boolean('is_dead')->default(false);
            $table->boolean('product_delivered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_privates');
    }
};
