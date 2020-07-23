<?php

namespace App\Http\Livewire\Admin;

use App\Course;
use Livewire\Component;

class ShowCourseDescription extends Component
{
    
    public $course;
    public $courseDescription;
    
    public function mount(int $id) {
        $this->course = Course::find($id);
        $this->courseDescription = $this->course->description;
    }

    public function render()
    {
        return view('livewire.admin.show-course-description');
    }
}
