<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mt-10 sm:mt-0">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead class=" bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Name') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Victories') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Pats') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Draws') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Losses') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tournament->participants as $participant)
                            @php
                                $positif = $participant->isParticipationScorePositif();
                                $negatif = !$positif;
                            @endphp
                            <tr
                                @class([
                                'bg-green-300' => $positif,
                                'bg-red-300' => $negatif,
                                ])
                            >
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                {{ $participant->name ?? "-" }}
                            </td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                {{ $participant->pivot->wins ?? "" }}
                            </td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                {{ $participant->pivot->paths ?? "-" }}
                            </td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                {{ $participant->pivot->draws ?? "-" }}
                            </td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                {{ $participant->pivot->losses ?? "-" }}
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-8" colspan="12">
                                    <div class="text-center">
                                        <x-heroicon-o-face-frown class="mx-auto h-12 w-12 text-gray-400"/>
                                        <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">{{ __('No participants') }}</h3>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
