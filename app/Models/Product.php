<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'agent_id',  //Product Manager
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'agent_id'); //relationship with User model,represnt Product Manager.
    }

}
