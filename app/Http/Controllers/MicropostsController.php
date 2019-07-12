<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    // ログイン状態によってホームページの表示を変える

    public function index(){
        $data =[];
        // ログイン状態なら実行
        if(\Auth::check()){
            // ログインしたユーザのインスタンス
            $user = \Auth::user();
            // ログインしたユーザの投稿を降順で10個ずつ表示
            $microposts = $user->feed_microposts()->orderBy('created_at','desc')->paginate(10);
            
            $data =[
                'user' => $user,
                'microposts' => $microposts
                ];
        }
        return view('welcome',$data);
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'content' => 'required|max:191',
        ]);
            
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        //  直前のページを表示       
        return back();
    }
    
    public function destroy($id){
        $micropost = \App\Micropost::find($id);
        
        // 他者の Micropost を勝手に削除されないよう、ログインユーザのIDと 
        // Micropost の所有者のID（user_id）が一致しているかを調べる
        
        if(\Auth::id() == $micropost->user_id){
            $micropost->delete();
           
        }
        //  dd($micropost);
        return back();
    }
}
