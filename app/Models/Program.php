<?php

namespace App\Models;

use App\Repositories\ProgramSetRepository;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'inputs', 'has_single_set', 'patient_id'];

    protected $casts = ['inputs' => 'array'];

    protected $appends = ['sets'];

    public function getSetsAttribute()
    {
        return (new ProgramSetRepository)->list($this->id);
    }
}
