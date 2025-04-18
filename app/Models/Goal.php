<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'program_set_id'];

    protected $hidden = ['program_set_id', 'created_at', 'updated_at'];
}
