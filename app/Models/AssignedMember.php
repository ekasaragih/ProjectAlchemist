<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedMember extends Model
{
    use HasFactory;

    protected $table = 'assigned';

    // Fillable fields to prevent MassAssignmentException
    protected $fillable = [
        'p_projnum',
        'role_name',
        'us_ID',
    ];

    // Define the relationship with the UserGroup model
    public function memberGroup()
    {
        return $this->belongsTo(UserGroup::class, 'grp_ID');
    }

    // Define the relationship with the Project model
    public function assignedProject()
    {
        return $this->hasMany(Users::class, 'p_projnum');
    }

    public function user() {
        return $this->belongsTo(Users::class, 'us_ID', 'us_ID');
    }
}
