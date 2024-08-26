<?php

namespace App\Livewire\Admin\Logs;

use App\Models\Log;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;

    public $searchText;

    public $startAt;

    public $endAt;

    public $selectedLevel;


    public function updatedStartAt()
    {
    }

    public function updatedSelectedLevel()
    {

    }

    public function render()
    {
        $startAt = Carbon::parse($this->startAt)->format('Y-m-d');
        $endAt = Carbon::parse($this->endAt)->format('Y-m-d');
        $selectedLevel = $this->selectedLevel;

        $logs = Log::where('message', 'like', '%'.$this->searchText.'%')
            ->when($this->startAt, function ($query) use ($startAt) {
                return $query->whereDate('created_at', '>=', $startAt);
            })
            ->when($this->endAt, function ($query) use ($endAt) {
                return $query->whereDate('created_at', '<=', $endAt);
            })
            ->when($this->selectedLevel, function ($query) use ($selectedLevel) {
                return $query->where('level', '=', $selectedLevel);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.logs.logs', ['logs' => $logs])
            ->layout('components.layouts.admin');
    }
}
