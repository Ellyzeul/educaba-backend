<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['program_id', 'goal_id', 'user_id', 'inputs'];

    protected $casts = ['inputs' => 'array'];
    
    protected $appends = ['program_name', 'goal_name'];
    
    public function getProgramNameAttribute()
    {
        return Program::find($this->program_id)->name ?? null;
    }
    
    public function getGoalNameAttribute()
    {
        return Goal::find($this->goal_id)->name ?? null;
    }
}
