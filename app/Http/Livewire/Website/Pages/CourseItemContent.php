<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use Livewire\Component;

class CourseItemContent extends Component
{

    public $course;

    public $showCourseAbout = true;
    public $groupChaptersToShow = null;

    public function mount(string $slug, string $hexId) {
        $courseId = (int) hexdec($hexId);
        $this->course = Course::find($courseId);

        if ($this->course->use_group_chapters) 
            $this->groupChaptersToShow = $this->course->groupChapters()->first('id')->id;

        // $groups = $this->course->groupChapters()->get();
        // foreach ($groups as $group) dd($group->courseChapters);
        // dd($chapters);
    }

    public function setGroupChapterToShow(int $groupId) {
        $this->groupChaptersToShow = $this->course->groupChapters()->where('id', $groupId)->get('id')[0]->id;
    }

    public function changeShowCourseAbout() {
        $this->showCourseAbout = !$this->showCourseAbout;
    }

    public function render()
    {
        return view('livewire.website.pages.course-item-content');
    }
}
