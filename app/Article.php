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
        'title', 'description', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getStatus(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM pages WHERE Field = "status"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}

// $user_id = Auth::user()->id;
