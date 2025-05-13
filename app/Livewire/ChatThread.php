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
        $this->loadChats();
    }

    public function sendMessage(): void
    {
        $this->validate();

        $chat = $this->createChat();
        $this->broadcastMessage($chat);

        $this->reset('message');
        $this->chats->push($chat);
    }

    #[On('echo-private:Chat.{sender.id},MessageSent')]
    public function receiveNewMessage(): void
    {
        $this->loadChats();
    }

    private function loadChats(): void
    {
        $this->chats = Chat::with('sender:id,name', 'receiver:id,name')
            ->where(fn ($query) => $query
                ->whereIn('chats.sender_id', [$this->sender->id, $this->receiver->id])
                ->whereIn('chats.receiver_id', [$this->sender->id, $this->receiver->id])
            )
            ->get();
    }

    private function createChat(): Chat
    {
        return Chat::create([
            'message' => $this->message,
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
        ]);
    }

    private function broadcastMessage(Chat $chat): void
    {
        broadcast(new MessageSent($chat))->toOthers();
    }

    public function render()
    {
        return view('livewire.chat-thread');
    }
}
