<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatThread extends Component
{
    public User $sender;

    public User $receiver;

    public object $chats;

    #[Validate('required|min:3')]
    public string $message = '';

    public function mount(): void
    {
        $this->chats = $this->getChats();
    }

    public function sendMessage()
    {
        $this->validate();

        $chat = Chat::create(
            $this->only(['message']) + [
                'sender_id' => $this->sender->id,
                'receiver_id' => $this->receiver->id,
            ]
        );

        broadcast(new MessageSent($chat))->toOthers();

        $this->reset('message');
        $this->chats->push($chat);
    }

    #[On('echo-private:Chat.{sender.id},MessageSent')]
    public function receiveNewMessage()
    {
        $this->chats = $this->getChats();
    }

    public function getChats()
    {
        return Chat::query()
            ->where(function ($query) {
                $query->where('chats.sender_id', $this->sender->id)
                    ->orWhere('chats.receiver_id', $this->sender->id);
            })
            ->where(function ($query) {
                $query->where('chats.sender_id', $this->receiver->id)
                    ->orWhere('chats.receiver_id', $this->receiver->id);
            })
            ->with('sender:id,name', 'receiver:id,name')
            ->get();
    }

    public function render()
    {
        return view('livewire.chat-thread');
    }
}
