<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $user = Auth::user();
        $isAdmin = $user->is_admin;

        $user = Auth::user();
        $isAdmin = $user->role_flag;

        if($isAdmin === 1){
            return redirect()->route('stock.index');

        }elseif($isAdmin === 0){
            return view('tagAdd', ['tags' =>$tags]);
        }else{
            return redirect()->route('stock.index');
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create([
            'name' =>$request->input('name'),
        ]);

        return redirect()->back()->with('message', '新しいタグを作成しました');
    }
}
