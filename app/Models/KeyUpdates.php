<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyUpdates extends Model
{
    use HasFactory;

    protected $table = 'key_updates';

    protected $primaryKey = 'ku_ID';

    protected $fillable = [
        'ku_keyupdate', 
        'ku_keydate', 
        'p_projnum',
        'shown_at'
    ];
}
