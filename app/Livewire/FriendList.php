<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class FriendList extends Component
{
    #[URL]
    public null|User $receiver;

    public function setReceiver(User $receiver): void
    {
        $this->receiver = $receiver;
    }
    public function render()
    {
        return view('livewire.friend-list',
            [
                'users' => User::whereNot('id', auth()->id())->get(),
                'sender' => Auth::user(),
            ]);
    }
}
