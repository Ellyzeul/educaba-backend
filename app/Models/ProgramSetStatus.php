<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSetStatus extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'program_set_status';
}
