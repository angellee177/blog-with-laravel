<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Auth;

class article extends Model
{
    use Notifiable;
    
    protected $table = 'articles';
    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getArticleUser()
    {
        return Auth::user()->id;
    }
}

$user_id = Auth::user()->id;
