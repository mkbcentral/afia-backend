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
        Schema::table('patient_privates', function (Blueprint $table) {
            $table->string('parcel_number',255)->nullable()->after('commune_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_privates', function (Blueprint $table) {
            $table->dropColumn('parcel_number');
        });
    }
};
