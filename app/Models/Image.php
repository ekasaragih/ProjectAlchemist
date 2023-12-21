<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $primaryKey = 'i_ID';

    // Fillable fields to prevent MassAssignmentException
    protected $fillable = [
        'p_projnum',
        'i_photoname',
        'i_uploadedby'
    ];
}
