<div class="overflow-hidden bg-white shadow sm:rounded-lg">
<div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900">Informations personnelles</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
</div>
<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
    <dl class="sm:divide-y sm:divide-gray-200">
        <form wire:submit.prevent="abc">
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Nom</dt>
                <div>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <!-- Heroicon name: mini/envelope -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                            </svg>
                        </div>
                        <input  wire:model="name"  type="text" name="name" id="name" class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com">
                    </div>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <div>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <!-- Heroicon name: mini/envelope -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                        </div>
                        <input wire:model="email" value="{{$user->email}}" type="email" name="email" id="email" class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com">
                    </div>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <button type="submit">Save Contact</button>
        </form>

    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Mot de passe</dt>
            <a href="../reset-password/{{\Request::session()->token()}}}}" class="mt-1 text-left text-sm text-gray-900 sm:col-span-2 sm:mt-0">Modifier mon mot de passe</a>
        </div>
        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Avatar</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                            <!-- Heroicon name: mini/paper-clip -->
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 w-0 flex-1 truncate">resume_back_end_developer.pdf</span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                        </div>
                    </li>
                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                            <!-- Heroicon name: mini/paper-clip -->
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 w-0 flex-1 truncate">coverletter_back_end_developer.pdf</span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                        </div>
                    </li>
                </ul>
            </dd>
        </div>
    </dl>
</div>
</div>
