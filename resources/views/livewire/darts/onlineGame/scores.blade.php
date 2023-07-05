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
                                    <div class="flex flex-col">
                                        <select wire:model="scores.{{ $index }}.name">
                                            <option value="">Sélectionner un joueur</option>
                                            @foreach($this->users as $user)
                                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error("scores.".$index.".name") <span class="error" style="color: red">Nom requis</span> @enderror
                                    </div>
                                </td>
                                @foreach($rounds as $round_index => $round)
                                    <td x-data class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" name="scores[{{ $index }}][round_score]"
                                               id="{{$round_index}}-{{ $index }}"
                                               wire:model="scores.{{ $index }}.{{$round_index}}.round_score"
                                               wire:focus="init_count()"
                                               wire:input="decrement_count()"
                                               data-player="{{$index}}"
                                               onfocus="focusEvent(this)"
                                               @if($round['throw_count'] == 0) disabled @endif
                                               class="input-score shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        >
                                        @error("scores.$index.$round_index") <span class="error" style="color: red">Manche requise</span> @enderror
                                    </td>
                                @endforeach
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="score" id="score-{{ $index }}" disabled
                                           wire:model="scores.{{ $index }}.score"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error("scores.".$index.".score") <span class="error" style="color: red">Total requis</span> @enderror
                                </td>
                                <td>
                                    <a wire:click="removeRow({{$index}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        <div class="flex items-center">
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
<script>


    let inputId = '';

    function focusEvent(element) {
        inputId = element.id
    }

    document.addEventListener('livewire:load', function (dartScore) {

        var dartboard = new Dartboard('#dartboard')
        dartboard.render()


        document.querySelector('#dartboard').addEventListener('throw', function (d) {
            var input = document.getElementById(inputId)

            if (@this.count == 0) {
                alert('Passe ton tour !')
                return
            }

            var score = 0;

            if (input.value != '') {
                score = parseInt(input.value);
            }

            score += d.detail.score
            input.value = score

            input.dispatchEvent(new Event("input"));
        })

    })
</script>
