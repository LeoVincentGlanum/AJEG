<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Models\Record;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class TableRank extends Component
{
    use WithPagination;

    public string $searchPlayer = '';
    public string $searchCategory = '';
    public array $categories;

    public function mount()
    {
        $this->categories = [
            'TopGame',
            'WorstGame',
            'TopRound',
            'WorstRound',
        ];
    }

    public function makeQueryFilter(): LengthAwarePaginator
    {

        if ($this->searchPlayer !== '') {
            $this->goToPage(1);

            $user = User::query()
                ->where('name', 'like', '%' . $this->searchPlayer . '%')->first();

            if ($user) {
                if ($this->searchCategory !== '' && in_array($this->searchCategory, $this->categories)) {
                    return Record::query()
                        ->where('user_id', $user->id)
                        ->where('type', $this->searchCategory)
                        ->paginate(10);
                }
                return Record::query()
                    ->where('user_id', $user->id)
                    ->paginate(10);
            }
        }
        if ($this->searchCategory !== '' && in_array($this->searchCategory, $this->categories)) {
            return Record::query()
                ->where('type', $this->searchCategory)
                ->paginate(10);
        }
        return Record::query()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.table-rank', [
            'records' => $this->makeQueryFilter(),
        ]);
    }
}
