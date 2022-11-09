<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FriendId extends Component
{
    public $user_id=2;


    public function addTodo($id)
    {

    $this->user_id = $id;
    $this->emit('newid', $this->user_id);

    }
    public function render()
    {
        return view('livewire.friend-id');
    }
}
