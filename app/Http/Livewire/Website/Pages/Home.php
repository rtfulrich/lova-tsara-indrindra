<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{

    public $formations;
    public $tutos;

    public function mount() {
        $this->formations = Course::where('published', true)->whereIn('category', ['formation', 'practice'])->latest()->get();
        $this->tutos = Course::where('published', true)->where('category', 'tutorial')->latest()->get();
    }

    public function render()
    {
        return view('livewire.website.pages.home');
    }
}
