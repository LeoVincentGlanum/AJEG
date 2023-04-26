<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <form wire:submit.prevent="save">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manche 1
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manche 2
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manche 3
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manche 4
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manche 5
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($scores as $index => $score)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="name" id="name-{{ $index }}"
                                           wire:model="scores.{{ $index }}.name"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="round1" id="round1-{{ $index }}"
                                           wire:model="scores.{{ $index }}.round1"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="round2" id="round2-{{ $index }}"
                                           wire:model="scores.{{ $index }}.round2"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="round3" id="round3-{{ $index }}"
                                           wire:model="scores.{{ $index }}.round3"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="round4" id="round4-{{ $index }}"
                                           wire:model="scores.{{ $index }}.round4"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="round5" id="round5-{{ $index }}"
                                           wire:model="scores.{{ $index }}.round5"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="score" id="score-{{ $index }}"
                                           wire:model="scores.{{ $index }}.score"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        <div class="flex items-center">
                            <input type="text" name="newNom" id="newNom" wire:model="newNom"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md mr-2">
                            <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    wire:click="addRow">Ajouter une ligne
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end my-4">
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Enregistrer les scores
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
