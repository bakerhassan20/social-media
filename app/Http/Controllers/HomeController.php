<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Post_attachments;
use Illuminate\Support\Facades\Auth;
use App\Models\Friends;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $friend1 = collect();
        $friend2 = collect();

        $users = User::all()->where('id','!=', Auth::user()->id);
        $friends1 =Friends::where('user_id',Auth::user()->id)->get('friend_id');
        $friends2 =Friends::where('friend_id',Auth::user()->id)->get('user_id');
        foreach($friends1 as $friend){
            $fr1 = User::where('id',$friend->friend_id)->first();
            $friend1->add($fr1);

        }
        foreach($friends2 as $friend){
            $fr2 = User::where('id',$friend->user_id)->first();
            $friend2->add($fr2);

        }
        if(isset($friend1)&&isset($friend2)){
        $friends = $friend1->merge($friend2);
        }elseif(!isset($friend1)&&isset($friend2)){
          $friends = $friend2;
        }elseif(isset($friend1)&&!isset($friend2)){
            $friends = $friend1;
        }else{
            $friends=null;
        }

         $posts = Post::all()->sortByDesc('id');

      return view('home',compact('users','posts','friends'));

    }



}
