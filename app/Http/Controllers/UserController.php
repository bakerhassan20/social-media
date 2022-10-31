<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\trait\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;

class UserController extends Controller
{
    use ImageTrait;

    public function index(){
    
        $posts = Post::all()->where('user_id',Auth::user()->id)->sortByDesc('id');

        return view('user.profile',compact('posts'));

    }


    public function updateimage(Request $request)
    {

        if($request->file('image')){

        if(Auth::user()->img != 'default_img.png'){
            Storage::disk('user_image')->delete(Auth::user()->img);
        }
            $dataimage = $this->insertImage(Auth::user()->email,$request->image,'assets/Users_Img/');
            Auth::user()->update([
                'img' => $dataimage,
            ]);

         }

         if($request->file('cover_image')){

            if(Auth::user()->cover_img != 'defulat_cover_img.jpg'){
                Storage::disk('user_image')->delete(Auth::user()->cover_img);
            }

            $dataimage = $this->insertImage(Auth::user()->email . 'cover',$request->cover_image,'assets/Users_Img/');
            Auth::user()->update([
                'cover_img' => $dataimage,
            ]);

         }

         return redirect()->route('profile');

    }


    public function update_password(request $request){

        $request ->validate([
        'old_password' =>'required',
        'new_password' =>'required|confirmed|min:6',
        ]
          ,[  
            'new_password.min' => 'new password must be 6 at least',
            'new_password.confirmed' => 'new password confirmed not match',


          ]);
        
        $current_user=Auth::User();

        if(Hash::check($request->old_password,$current_user->password)){
        $current_user->update([

            'password' =>bcrypt($request->passwordRe),

        ]);

        flash()->addSuccess('Password Successfuly Updated');
        return back();
        }
        else {
     
        return back()->with('error','old password dose not matched');
        }

        }


}
