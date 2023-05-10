<div class="flex justify-center items-center py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Catégorie</th>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td class="border px-4 py-2">{{$record->type}}</td>
                            <td class="border px-4 py-2">{{ App\Models\User::query()->where('id', $record->user_id)->first()->name }}</td>
                            <td class="border px-4 py-2">{{$record->score}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
