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

        if($request->delete){

            $friend = Friends::where(['user_id'=>$user_id,'friend_id'=>$friend_id])->orWhere(['user_id'=>$friend_id,'friend_id'=>$user_id])->first();

            $friend->delete();
            flash()->addError('Friend Deleted Successfully');
            return back();

        }else{

         if($request->cancel){
             $friend_request = FriendRequest::where(['user_id'=>$user_id,'friend_id'=>$friend_id])->orWhere(['user_id'=>$friend_id,'friend_id'=>$user_id])->first();

             $friend_request->delete();
             flash()->addError('Request Canceled Successfully');
             return back();

         }elseif($request->accept){

             $friend_request2 = FriendRequest::where(['user_id'=> $friend_id,'friend_id'=>$user_id])->first();
             $friend_request2->delete();
             Friends::create([
                 'user_id' => $user_id,
                 'friend_id' => $friend_id,
            ]);
             flash()->addSuccess('Request Accepted Successfully');
             return back();
         }else{
             FriendRequest::create([
                 'user_id' => $user_id,
                 'friend_id' => $friend_id,
            ]);
            flash()->addSuccess('Request Sent Successfully');
            return back();
         }
        }
     }

}
