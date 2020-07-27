<?php

namespace App\Http\Livewire\Website\Includes;

use App\Course;
use Livewire\Component;

class AsideRight extends Component
{

    public $course;
    public $courseAuthor;

    public $websiteMaster;

    public function mount(int $courseId = null) {
        if (!is_null($courseId)) {
            $this->course = Course::find($courseId);
            $this->courseAuthor = 
                ($this->course->owner->first_name and $this->course->owner->last_name) ? 
                    ($this->course->owner->first_name . ' ' . $this->course->owner->last_name) : 
                    $this->course->owner->username;
        }
        else $this->websiteMaster = 'Tahirintsoa Ulrich';
    }

    public function render()
    {
        return view('livewire.website.includes.aside-right');
    }
}
