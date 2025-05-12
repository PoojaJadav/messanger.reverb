<div>
    <div class="p-5">
        <ul role="list" class="space-y-6">
            @foreach($chats as $chat)
                <li class="relative flex gap-x-4">
                    <div class="absolute top-0 -bottom-6 left-0 flex w-6 justify-center">
                        <div class="w-px bg-gray-200"></div>
                    </div>
                    <flux:avatar size="xs" :name="$chat->sender->name"/>
                    <div class="flex-auto rounded-md p-3 ring-1 ring-gray-200 ring-inset">
                        <div class="flex justify-between gap-x-4">
                            <div class="py-0.5 text-xs/5 text-gray-500">
                                <span class="font-medium text-gray-900">
                                    {{ $chat->sender->name }}
                                </span>
                            </div>
                            <time datetime="2023-01-23T15:56" class="flex-none py-0.5 text-xs/5 text-gray-500">
                                {{ $chat->created_at->diffForHumans() }}
                            </time>
                        </div>
                        <p class="text-sm/6 text-gray-500">
                            {{ $chat->message }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- New comment form -->
        <div class="mt-6 flex gap-x-3">
            <flux:avatar size="xs" :name="$sender->name"/>
            <form wire:submit="sendMessage" class="relative flex-auto">
                <div
                    class="overflow-hidden rounded-lg pb-12 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <label for="comment" class="sr-only">Add your comment</label>

                    <textarea rows="2" wire:model="message" id="comment"
                              class="block w-full resize-none bg-transparent px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                              placeholder="Add your comment..."></textarea>
                </div>

                <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pr-2 pl-3">
                    <button type="submit"
                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                        {{ __('send') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
