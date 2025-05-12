<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatThread extends Component
{
    public User $sender;
    public User $receiver;

    #[Validate('required|min:3')]
    public string $message = '';

    public function sendMessage()
    {
        $this->validate();

        Chat::create(
            $this->only(['message']) + [
                'sender_id' => $this->sender->id,
                'receiver_id' => $this->receiver->id,
            ]
        );
    }

    public function render()
    {
        $chats = Chat::query()
            ->where(function ($query) {
                $query->where('chats.sender_id', $this->sender->id)
                    ->orWhere('chats.receiver_id', $this->sender->id);
            })
            ->with('sender:id,name', 'receiver:id,name')
            ->get();

        return view('livewire.chat-thread', compact('chats'));
    }
}
