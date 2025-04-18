<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['name', 'cpf', 'relationship', 'email', 'phone_primary', 'phone_secondary', 'patient_id'];
}
