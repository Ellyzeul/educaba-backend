<?php

use App\Models\Patient;
use App\Models\ProgramSetStatus;
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
        Schema::create('program_sets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->json('inputs');
            $table->foreignIdFor(ProgramSetStatus::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_sets');
    }
};
