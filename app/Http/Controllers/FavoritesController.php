<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request, $id){
        \Auth::user()->add_favorite($id);
        return back();
    }
    
    public function destroy($id){
        \Auth::user()->delete_favorite($id);
        return back();
    }
}
