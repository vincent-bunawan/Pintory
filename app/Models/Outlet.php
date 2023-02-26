<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function owner() {
        return $this->belongsTo(Admin::class,'id','owner_id');
    }
}
