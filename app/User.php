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
    
    public function followings(){
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers(){
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId){
        
        //すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        //相手が自分自身でないかの確認
        $its_me = $this->id == $userId;
        
        if($exist || $its_me){
            //すでにフォローしていれば何もしない
            return false;
        }else{
            //未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId){
        //すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        //相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me){
            //すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        }else{
            //未フォローであれば何もしない
            return false;
        }
        
        
    }
    
    public function is_following($userId){
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_microposts(){
        // フォローしているユーザのIDの配列を取得
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        // 自分のIDを配列に代入
        $follow_user_ids[] = $this->id;
        // microposts テーブルの user_id カラムでの中の、配列にあるIDの投稿をリターンする
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    // お気に入りに追加しているmicropostを$user->favorites()で取得できるようにする
    public function favorites(){
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    //お気に入りに追加する
    public function add_favorite($micropostId){
        // 既にお気に入り登録しているかの確認
        if( $this->favoring($micropostId) ){
            return false;
        }else{
            // お気に入りに登録されていなければ登録する
            $this->favorites()->attach($micropostId);
            return true;
        }
    }
    // お気に入りを解除する
    public function delete_favorite($micropostId){
        // 既にお気に入り登録しているかの確認
        if( $this->favoring($micropostId) ){
             // お気に入りに登録されていれば解除する
            $this->favorites()->detach($micropostId);
            return true;
        }else{
           
            return false;
        }
    }
    // 投稿がお気に入りに追加済みならtrue、そうでなければfalseを返す
    public function favoring($micropostId){
        return $this->favorites()->where('microposts.id', $micropostId)->exists();
    }
    
    
}
