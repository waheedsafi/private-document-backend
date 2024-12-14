<?php

namespace App\Models;

use App\Traits\template\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Urgency extends Model
{
    use HasFactory, Auditable;

    protected $guarded = [];
}
