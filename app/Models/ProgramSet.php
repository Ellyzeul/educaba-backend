<?php

namespace App\Models;

use App\Repositories\GoalRepository;
use App\Repositories\ProgramSetStatusRepository;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramSet extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'program_id', 'organization_id', 'program_set_status_id'];

    protected $appends = ['goals', 'status'];

    protected $hidden = ['program_set_status_id', 'organization_id', 'program_id', 'created_at', 'updated_at'];

    public function getGoalsAttribute()
    {
        return (new GoalRepository)->list($this->id)->values();
    }

    public function getStatusAttribute()
    {
        return (new ProgramSetStatusRepository)
            ->find($this->program_set_status_id ?? Str::repeat('0', 26), $this->organization_id)
            ->name;
    }
}
