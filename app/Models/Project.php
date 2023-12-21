<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $table = 'project';

    protected $primaryKey = 'p_projnum';

    protected $fillable = [
        'p_projnum', 
        'p_categories', 
        'p_desc',
        'p_prodnum',
        'p_complx', 
        'p_agegrd', 
        'p_type',
        'p_quota',
        'p_lq', 
        'p_la', 
        'p_season',
        'p_retail',
        'p_toolbdg', 
        'p_tgtcost', 
        'p_crncost',
        'p_cosi',
        'p_stat', 
        'p_notes',
        'p_licen',
        'p_crfpr'
    ];
    
    public function assigned() {
        return $this->hasMany(AssignedMember::class, 'p_projnum', 'p_projnum');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'p_projnum', 'p_prodnum');
    }

    public function keyUpdates()
    {
        return $this->hasMany(KeyUpdates::class, 'p_projnum', 'p_projnum');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'p_projnum', 'p_projnum');
    }

}
