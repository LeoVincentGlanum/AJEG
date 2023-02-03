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
                                <x-heroicon-m-users class="w-5 h-5 text-gray-400"/>
                            </div>
                            <input wire:model="name" type="text" class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="xxXSpartacus38Xxx">
                        </div>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <div>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <x-heroicon-m-envelope class="w-5 h-5 text-gray-400"/>
                            </div>
                            <input wire:model="email" value="{{$user->email}}" type="text"
                                   class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Spartacus@glanum.com">
                        </div>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="py-4 sm:gap-4 sm:py-1 sm:px-10">
                    <div class="text-right">
                        <button type="submit" class="rounded-full border border-transparent bg-indigo-600 px-3.5 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>

            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Mot de passe</dt>
                <a href="../reset-password/{{ \Request::session()->token() }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    {{ __('Update password') }}
                </a>
            </div>

            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Avatar</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <form wire:submit.prevent="savePicture" class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('img/'.$user->photo) }}"  onerror="this.onerror=null; this.src='/img/user-default.png'" alt="Photo de profil de {{$user->name}}" />
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
                                <img src="{{ $photo->temporaryUrl() }}"  onerror="this.onerror=null; this.src='/img/user-default.png'" class="h-16 w-16 object-cover rounded-full">
                                <button class="mt-2 rounded-full border border-transparent bg-indigo-600 px-3.5 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Save Photo</button>
                            @endif
                            @error('photo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                    </form>
                </dd>
            </div>
        </dl>
    </div>
</div>
