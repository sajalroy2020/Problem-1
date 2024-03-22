<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $singleData= User::find($id);
        return view('home', compact('singleData'));
    }

    public function profile()
    {
        $myData=User::find(Auth::id());
        return view('profile', compact('myData'));
    }

    public function allNote()
    {
        $data['allNotes']=Note::where('user_id', auth()->id())->get();
        return view('welcome', $data);
    }

    public function edit($id)
    {
        $editData=User::find($id);
        return view('edit', compact('editData'));
    }

}
