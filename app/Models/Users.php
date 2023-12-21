<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Users extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'us_ID';
    public $incrementing = false;

    protected $fillable = [
        'us_ID', 
        'us_name', 
        'us_username',
        'us_email', 
        'us_pwd',
        'grp_ID'
    ];
    
    // Define the relationship with the UserGroup model
    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'grp_ID');
    }
}
