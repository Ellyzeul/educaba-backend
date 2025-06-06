<?php

use App\Models\Organization;
use App\Models\Program;
use App\Models\ProgramSetStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
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
            $table->foreignIdFor(ProgramSetStatus::class)->default(Str::repeat('0', 26))->constrained();
            $table->foreignIdFor(Program::class)->constrained();
            $table->foreignIdFor(Organization::class)->constrained();
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
