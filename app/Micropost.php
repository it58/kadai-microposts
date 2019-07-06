<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable=['content', 'user_id'];
    
    // 単数形で定義
    public function user(){
        
        // Micropost のインスタンスが所属している唯一の User
        //（投稿者の情報）を$micropost->user()->first() 
        // もしくは $micropost->user という簡単な記述で取得
        
        return $this->belongsTo(User::class);
    }
}
