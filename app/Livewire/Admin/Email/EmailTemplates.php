<?php

namespace App\Livewire\Admin\Email;

use App\Models\EmailTemplate;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class EmailTemplates extends Component
{
    public $templates;

    public function mount()
    {
        $this->templates = EmailTemplate::all()->toArray();
    }

    public function saveTemplate($templateName)
    {
        foreach($this->templates as $template)
        {
            if($template['name'] == $templateName)
                $data = $template;
        }

        $template = EmailTemplate::where('id', $data['id'])->first();

        $template->update(
            $data
        );

    }

    public function render()
    {
        return view('livewire.admin.email.email-templates')
            ->layout('components.layouts.admin');
    }
}
