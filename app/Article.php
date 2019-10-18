<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Auth;

class article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }   
}

$user_id = Auth::user()->id;
echo(Auth::user());