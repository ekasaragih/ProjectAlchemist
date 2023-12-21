<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'log';

    protected $primaryKey = 'l_ID';

    protected $fillable = [
        'p_projnum',
        'l_field',
        'l_before',
        'l_after',
        'change_by'
    ];
}
