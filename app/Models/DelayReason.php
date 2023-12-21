<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayReason extends Model
{
    use HasFactory;

    protected $table = 'reason_delay';

    protected $primaryKey = 'rd_ID';

    // Fillable fields to prevent MassAssignmentException
    protected $fillable = [
        'rd_delaytype',
        'p_projnum',
        'a_ID',
        'rd_delaydesc'
    ];
}
