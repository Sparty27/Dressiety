<?php

namespace App\Livewire\Admin\Sms;

use App\Models\SmsTemplate;
use Livewire\Component;

class SmsTemplates extends Component
{
    public $templates;

    public function mount()
    {
        $this->templates = SmsTemplate::all()->toArray();
    }

    public function saveTemplate($templateName)
    {
        foreach($this->templates as $template)
        {
            if($template['name'] == $templateName)
                $data = $template;
        }

        $template = SmsTemplate::where('id', $data['id'])->first();

        $template->update(
            $data
        );

    }

    public function render()
    {
        return view('livewire.admin.sms.sms-templates')
            ->layout('components.layouts.admin');
    }
}
