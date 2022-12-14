<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Post_attachments;
use App\Http\trait\ImageTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Friends;
use Illuminate\Support\Facades\Storage;
use Hash;

class UserController extends Controller
{
    use ImageTrait;

    public function index(){

        $posts = Post::all()->where('user_id',Auth::user()->id)->sortByDesc('id');

        $friend1 = collect();
        $friend2 = collect();
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
        return view('user.profile',compact('posts','friends'));
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


        public function user_profile($id){
              $id = (int)$id;

             if($id == Auth::user()->id){
                return redirect()->route('profile');
            }else{

                $user = User::findOrFail($id);
                $UserFriend =Friends::where(['user_id'=>Auth::user()->id,'friend_id'=>$user->id])->orWhere(['user_id'=>$user->id,'friend_id'=>Auth::user()->id])->count();
                $posts = Post::all()->where('user_id',$id)->sortByDesc('id');
                $friends1 = Friends::Where('user_id','=',$user->id)->where('friend_id','!=',Auth::user()->id)->get('friend_id');
                $friends2 =Friends::where('friend_id','=',$user->id)->where('user_id','!=',Auth::user()->id)->get('user_id');

                return view('user.user_profile',compact('posts','user','UserFriend','friends1','friends2'));
            }

        }


}
