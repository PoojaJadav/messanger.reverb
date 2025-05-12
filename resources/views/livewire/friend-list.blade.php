<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($users as $user)
                        <li @class(["relative py-5 dark:hover:bg-white/[7%] hover:bg-zinc-800/5",
"bg-white/[7%] bg-zinc-800/5" => $user->id == $receiver?->id
                                   ])>
                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="mx-auto flex max-w-4xl justify-between gap-x-6">
                                    <div class="flex min-w-0 gap-x-4">
                                        <flux:avatar size="xl" :name="$user->name"/>
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                                                <span wire:click="setReceiver({{ $user }})" class="cursor-pointer">
                                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                    {{ $user->name }}
                                                </span>
                                            </p>
                                            <p class="mt-1 flex text-xs/5 text-gray-500 dark:text-white">
                                                <a href="mailto:{{ $user->email }}"
                                                   class="relative truncate hover:underline">
                                                    {{ $user->email }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex shrink-0 items-center gap-x-4">
                                        <svg class="size-5 flex-none text-gray-400 dark:text-white" viewBox="0 0 20 20"
                                             fill="currentColor"
                                             aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 col-span-2">
                @if($receiver)
                    <livewire:chat-thread :sender="$sender" :receiver="$receiver"/>
                @endif
            </div>
        </div>
    </div>
</div>
