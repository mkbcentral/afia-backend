<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\Currency;
use App\Models\FormPatient;
use App\Models\Hospital;
use App\Models\Rate;
use App\Models\TypeOtherInvoice;
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
        Schema::create('other_invoice_subscribes', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('name')->nullable();
            $table->enum('gender',['M','F'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignIdFor(Hospital::class)->constrained();
            $table->foreignIdFor(Branch::class)->constrained();
            $table->foreignIdFor(FormPatient::class)->nullable()->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Rate::class)->constrained();
            $table->foreignIdFor(Currency::class)->constrained();
            $table->foreignIdFor(Company::class)->constrained();
            $table->boolean('is_valided')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_printed')->default(false);
            $table->boolean('product_delivered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_invoice_subscribes');
    }
};
