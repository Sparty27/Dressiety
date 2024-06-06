<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    public $page;

    public function mount()
    {
        $this->page = $this->getPageForComponent();
        $this->initialize();
    }

    private function getPageForComponent()
    {
        $identifier = $this->getPageIdentifier();
        $pageTitle = config('page_mappings')[$identifier] ?? null;

        return $pageTitle ? Page::where('title', $pageTitle)->first() : null;
    }

    abstract protected function getPageIdentifier();

    abstract protected function initialize();
}
