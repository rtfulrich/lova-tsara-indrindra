<?php

namespace App\Http\Livewire\Admin;

use App\Course;
use App\CourseChapter;
use Livewire\Component;

class NewCourse extends Component
{
    
    public $courseTitle = "";
    public $showAddChapterForm = false;
    public $newChapterNumber = "";
    public $newChapterTitle = "";
    public $chapters = [];

    public $showFlashMsg = true;

    public function submit() {
        if (trim($this->courseTitle) === "") {
            session()->flash('msg', 'Mila fenoina ny lohatenin\' lesona !!!');
            return;
        }
        $course = new Course();
        $course->title = $this->courseTitle;
        $course->save();

        if (!empty($this->chapters)) {
            $lastCourseId = Course::latest()->first('id')->id;
            foreach ($this->chapters as $newChapter) {
                $chapter = new CourseChapter();
                $chapter->number = $newChapter['number'];
                $chapter->title = $newChapter['title'];
                $chapter->course_id = $lastCourseId;
                $chapter->save();
            }
        }
        session()->flash('msg', 'Course voaforona soamantsara !!!');
        return redirect()->route('admin.course.edit', $lastCourseId);
    }

    public function addChapter() {
        if (trim($this->newChapterTitle) === "") {
            session()->flash('msg', 'Mila fenoina lohatenin\' toko !!!');
            $this->showAddChapterForm = true;
            $this->showFlashMsg = true;
            return;
        }
        $this->chapters[] = [
            'number' => $this->newChapterNumber === "" ? count($this->chapters) + 1 : $this->newChapterNumber,
            'title' => $this->newChapterTitle
        ];
        $this->newChapterNumber = "";
        $this->newChapterTitle = "";
        $this->showAddChapterForm = true;
    }

    public function removeFlashMsg() {
        $this->showFlashMsg = false;
    }

    public function showAddChapterForm() {
        $this->showAddChapterForm = true;
    }

    public function cancelAddNewChapter() {
        $this->showAddChapterForm = false;
    }

    public function render() {
        return view('livewire.admin.new-course');
    }

    public function updatedNewChapterNumber() {
        $this->newChapterNumber = (int) $this->newChapterNumber;
        if ($this->newChapterNumber == 0) $this->newChapterNumber = "";
    }

}
