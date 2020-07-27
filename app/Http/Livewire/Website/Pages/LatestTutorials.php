<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use Livewire\Component;

class LatestTutorials extends Component
{

    public $tutos;

    public function mount() {
        $this->tutos = Course::where('category', 'tutorial')->latest()->get();
    }

    public function render()
    {
        return view('livewire.website.pages.latest-tutorials');
    }
}
