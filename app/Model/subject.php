<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $fillable = [
        'subject_name', 'subject_code'
    ];
}
