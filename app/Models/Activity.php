<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';

    protected $primaryKey = 'a_ID';

    // Fillable fields to prevent MassAssignmentException
    protected $fillable = [
        'p_projnum',
        'a_name',
        'a_sch',
        'a_act',
        'a_actlzd'
    ];

    // Define the relationship with the Project model
    public function assignedProject()
    {
        return $this->hasMany(Users::class, 'p_projnum');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'p_projnum', 'p_prodnum');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'p_projnum', 'p_projnum');
    }
}
