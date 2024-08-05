<?php

namespace App\Livewire;

use App\Enums\MessageTypeEnum;
use Livewire\Attributes\On;
use Livewire\Component;

class Popup extends Component
{
    public $message = '';
    public $color = 'bg-blue-500'; // default color
    public $duration = 3000; // default duration in milliseconds
    public $visible = false;
    public $queue = [];

    #[On('showPopup')]
    public function showPopup($message, string $color, $duration = 7000)
    {
        $messageColorType = MessageTypeEnum::tryFrom($color);

        if($messageColorType)
            $color = $messageColorType->getPopupColor();

        $this->queue[] = [
            'message' => $message,
            'color' => $color,
            'duration' => $duration,
        ];

        if(count($this->queue) > 5)
        {
            $deleteNumber = count($this->queue) - 5;
            $this->queue = array_slice($this->queue, $deleteNumber);
        }

        if (!$this->visible) {
            $this->displayNextPopup();
        }
    }

    public function displayNextPopup()
    {
        if(count($this->queue) >= 3)
            foreach($this->queue as $popup)
                $popup['duration'] = 100;

        if (!empty($this->queue)) {
            $nextPopup = array_shift($this->queue);
            $this->message = $nextPopup['message'];
            $this->color = $nextPopup['color'];
            $this->duration = $nextPopup['duration'];
            $this->visible = true;

            $this->dispatch('show-popup', [
                'duration' => $this->duration,
                'message' => $this->message,
                'color' => $this->color,
                'visible' => $this->visible,
            ]);
        }
    }

    public function hidePopup()
    {
        $this->visible = false;
        if (!empty($this->queue)) {
            $this->displayNextPopup();
        }
    }

    public function render()
    {
        return view('livewire.popup');
    }
}
