<?php

namespace App\Http\Livewire\Admin;

use App\Course;
use App\CourseChapter;
use Livewire\Component;

class EditCourse extends Component
{

    public $originalCourseTitle;
    public $course;
    public $courseTitle;
    public $chapters = [];
    public $chapterToEditNumber = null;
    public $chapterToEditTitle = null;
    public $newChapterNumber = "";
    public $newChapterTitle = "";

    public $showFlashMsg = true;
    public $showEditCourseTitleForm = false;
    public $showAddChapterForm = false;
    public $newCourseTitleCanBeSaved = false;

    // ---------------------- PROCESS METHODS --------------------
    public function handleUpdateChapterNumber(int $id) {
        if ($this->newChapterNumber == $this->chapterToEditNumber) {
            $this->cancelEditChapter(); 
            return;
        }
        $chapter = CourseChapter::findOrFail($id);
        $chapter->number = $this->newChapterNumber;
        $chapter->save();

        session()->flash('msg', 'Laharana toko voaova soamantsara !!!');
        $this->cancelEditChapter();
        $this->reloadChapters();
    }

    private function reloadChapters() {
        $this->chapters = [];
        $this->course = Course::findOrFail($this->course->id);
        foreach ($this->course->courseChapters as $chapter) {
            $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
        }
    }

    public function handleUpdateChapterTitle(int $id) {
        if ($this->newChapterTitle == $this->chapterToEditTitle) {
            $this->cancelEditChapter(); 
            return;
        }
        $chapter = CourseChapter::findOrFail($id);
        $chapter->title = $this->newChapterTitle;
        $chapter->save();

        session()->flash('msg', 'Lohatenin\' toko voaova soamantsara !!!');
        $this->cancelEditChapter();
        $this->chapters = [];
        $this->course = Course::findOrFail($this->course->id);
        foreach ($this->course->courseChapters as $chapter) {
            $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
        }
    }

    public function addChapter() {
        $chapter = new CourseChapter();
        $chapter->number = $this->newChapterNumber;
        $chapter->title = $this->newChapterTitle;
        $chapter->course_id = $this->course->id;
        $saved = $chapter->save();
        if ($saved) {
            session()->flash('msg', 'Toko voampy soamantsara !!!');
            $this->showAddChapterForm = false;
            $this->reloadChapters();
        }
        else session()->flash('msg', 'Error, Toko tsy voampy !!!');
        $this->newChapterNumber = "";
        $this->newChapterTitle = "";
    }

    public function saveNewCourseTitle() {
        $course = Course::findOrFail($this->course->id);
        $course->title = $this->courseTitle;
        $course->save();
        session()->flash('msg', 'Lohatenin\' lesona voaova soamantsara !!!');
        $this->originalCourseTitle = $course->title;
        $this->showEditCourseTitleForm = false;
        $this->newCourseTitleCanBeSaved = false;
    }

    public function updatedNewChapterNumber() {
        if (strlen($this->newChapterNumber) > 0) {
            $this->newChapterNumber = (int) $this->newChapterNumber;
            if ($this->newChapterNumber == 0) 
                $this->newChapterNumber = $this->chapterToEditNumber;
        }
    }

    public function updatedCourseTitle() {
        if ($this->originalCourseTitle !== $this->courseTitle) {
            $this->newCourseTitleCanBeSaved = true;
        }
        else {
            $this->newCourseTitleCanBeSaved = false;
        }
    }

    public function mount(int $id) {
        $this->course = Course::findOrFail($id);
        $this->courseTitle = $this->course->title;
        $this->originalCourseTitle = $this->courseTitle;

        foreach ($this->course->courseChapters as $chapter) {
            $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
        }
        // dd($this->chapters);
    }

    // ---------------------- FRONT METHODS --------------------
    public function removeFlashMsg() {
        $this->showFlashMsg = false;
    }

    public function editChapterContent(int $id) {
        $chapter = CourseChapter::findOrFail($id);
        return redirect()->route('admin.course.chapter.edit-content', $chapter->id);
    }

    public function showAddChapterForm() {
        $this->showEditCourseTitleForm = false;
        $this->showAddChapterForm = true;
    }

    public function editChapterNumber(int $id) {
        $this->chapterToEditNumber = CourseChapter::findOrFail($id)->number;
        $this->chapterToEditTitle = null;
        // $this->chapterToEditNumberOriginal = $this->chapterToEditNumber;
    }

    public function editChapterTitle(int $id) {
        $this->chapterToEditNumber = null;
        $this->chapterToEditTitle = CourseChapter::findOrFail($id)->title;
    }

    public function showCourseTitleContent() {
        $this->showEditCourseTitleForm = false;
        $this->newCourseTitleCanBeSaved = false;
        $this->courseTitle = $this->originalCourseTitle;
    }

    public function showEditCourseTitleForm() {
        $this->showEditChapterForm = false;
        $this->showEditCourseTitleForm = true;
    }

    public function render()
    {
        return view('livewire.admin.edit-course');
    }

    public function cancelAddNewChapter() {
        $this->showAddChapterForm = false;
        $this->showEditCourseTitleForm = false;
    }

    public function cancelEditChapter() {
        $this->chapterToEditNumber = null;
        $this->chapterToEditTitle = null;
        $this->newChapterNumber = "";
        $this->newChapterTitle = "";
    }

}
