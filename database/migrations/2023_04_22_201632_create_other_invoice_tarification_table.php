<?php

use App\Models\OtherInvoice;
use App\Models\Tarification;
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
        Schema::create('other_invoice_tarification', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtherInvoice::class)->constrained();
            $table->foreignIdFor(Tarification::class)->constrained();
            $table->integer('qty')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_invoice_tarification');
    }
};
