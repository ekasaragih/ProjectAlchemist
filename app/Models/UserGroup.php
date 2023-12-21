<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_grp';

    protected $primaryKey = 'grp_ID';

    protected $fillable = [
        'grp_ID', 
        'grp_name'
    ];

    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(Users::class, 'grp_ID');
    }
    
}
