<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// 複数形 microposts でメソッドを定義
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    // User のインスタンスから、その User が持つ Microposts を
    // $user->microposts()->get() もしくは $user->microposts 
    // という簡単な記述で取得
    
    public function microposts(){
        return $this->hasMany(Micropost::class);
    }
}
