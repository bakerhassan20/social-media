<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{

    public $messageText;
    public $user_id=1;
    protected $listeners = ['newid'];
    public function newid($friendId)
    {
        $this->user_id = $friendId;
    }


    public function render()
    {

    $messages = Messages::where([
                ['user_id_send',Auth::user()->id],
                ['user_id_receive',$this->user_id]
                               ])->orWhere([
                ['user_id_receive',Auth::user()->id],
                ['user_id_send',$this->user_id]
                             ])->get()->sortBy('id');

    $user_info = User::where('id',$this->user_id)->first();

    return view('livewire.chat', compact('messages' ,'user_info'));
    }

    public function sendMessage()
    {
        Messages::create([
            'user_id_send' => auth()->user()->id,
            'user_id_receive' => $this->user_id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }
}
