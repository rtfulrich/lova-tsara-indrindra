<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use Livewire\Component;

class LatestCourses extends Component
{

    public $courses;

    public function mount() {
        $this->courses = Course::whereIn('category', ['formation', 'practice'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.website.pages.latest-courses');
    }
}
