<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friends;
use Illuminate\Support\Facades\Auth;


class FriendsController extends Controller
{
    public function add_friend(Request $request){

       $user_id = Auth::user()->id;
       $friend_id = $request->friend_id;
       $friend_request = FriendRequest::where(['user_id'=> $user_id,'friend_id'=>$friend_id])->first();
       $friend_request2 = FriendRequest::where(['user_id'=> $friend_id,'friend_id'=>$user_id])->first();

       if($request->delete){
        $friend= Friends::where(['user_id'=>Auth::user()->id,'friend_id'=>$user_id])->orWhere(['user_id'=>$user_id,'friend_id'=>Auth::user()->id])->first();

        $friend->delete();
        flash()->addError('Friend Deleted Successfully');
        return back();

       }else{


        if(FriendRequest::where(['user_id'=> $user_id,'friend_id'=>$friend_id])->exists()){
            $friend_request->delete();
            flash()->addError('Request Canceled Successfully');
            return back();
           }elseif(FriendRequest::where(['user_id'=> $friend_id,'friend_id'=>$user_id])->exists()){
            $friend_request2->delete();
            Friends::create([
                'user_id' => $user_id,
                'friend_id' => $friend_id,
           ]);
            flash()->addSuccess('Request Accepted Successfully');
            return back();
           }
           else{
            FriendRequest::create([
                 'user_id' => $user_id,
                 'friend_id' => $friend_id,
            ]);
            flash()->addSuccess('Request Sent Successfully');
            return back();
           }


       }




    }

    public function cancel_friend(Request $request){

        $user_id = Auth::user()->id;
        $friend_id = $request->friend_id;
        $friend_request = FriendRequest::where(['user_id'=> $friend_id,'friend_id'=>$user_id])->first();
        if(FriendRequest::where(['user_id'=> $friend_id,'friend_id'=>$user_id])->exists()){
         $friend_request->delete();
         flash()->addError('Request Canceled Successfully');
         return back();
        }


     }

}
