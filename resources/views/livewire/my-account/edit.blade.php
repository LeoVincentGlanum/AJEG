<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Informations personnelles</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <form wire:submit.prevent="saveContact">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nom</dt>
                    <div>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <!-- Heroicon name: mini/envelope -->
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z"/>
                                </svg>
                            </div>
                            <input wire:model="name" type="text"
                                   class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   placeholder="xxXSpartacus38Xxx">
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
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                    <path
                                        d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                </svg>
                            </div>
                            <input wire:model="email" value="{{$user->email}}" type="text"
                                   class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Spartacus@glanum.com">
                        </div>
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="py-4 sm:gap-4 sm:py-1 sm:px-10">
                    <div class="text-right">
                        <button type="submit"
                                class="rounded-full border border-transparent bg-indigo-600 px-3.5 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Modifier
                        </button>
                    </div>
                </div>
            </form>

            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Mot de passe</dt>
                <a href="../reset-password/{{\Request::session()->token()}}}}"
                   class="font-medium text-indigo-600 hover:text-indigo-500">Modifier mon mot de passe</a>
            </div>
            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Avatar</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <form wire:submit.prevent="savePicture" class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('storage/photos/'.$user->photo) }}" alt="Current profile photo" />
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" wire:model="photo" class="block w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-violet-50 file:text-violet-700
                              hover:file:bg-violet-100
                            "/>
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="h-16 w-16 object-cover rounded-full">
                                <button class="mt-2 rounded-full border border-transparent bg-indigo-600 px-3.5 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Save Photo</button>
                            @endif
                            @error('photo') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </form>
                </dd>
            </div>
        </dl>
    </div>
</div>
