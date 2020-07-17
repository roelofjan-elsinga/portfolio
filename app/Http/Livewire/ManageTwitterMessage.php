<?php

namespace Main\Http\Livewire;

use Livewire\Component;

class ManageTwitterMessage extends Component
{
    public ?string $message;

    public function mount(?string $message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.manage-twitter-message');
    }
}
