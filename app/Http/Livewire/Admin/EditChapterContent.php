<?php

namespace App\Http\Livewire\Admin;

use App\ChapterContent;
use App\CourseChapter;
use Illuminate\Http\Request;
use Livewire\Component;

class EditChapterContent extends Component
{
    public $pageTitle;
    public $chapter;
    public $chapterTitle;
    public $chapterId;
    public $chapterContent = null;
    public $alreadyExists = false;
    public $textContent;

    public $showAddContentForm = false;

    // --------------------- PROCESS METHODS ---------------------
    public function mount(int $id) {
        $this->chapter = CourseChapter::findOrFail($id);
        $this->chapterId = $this->chapter->id;
        $this->chapterTitle = $this->chapter->title;
        $this->pageTitle = "$this->chapterTitle - {$this->chapter->course->title}";

        $chapterContentCollection = ChapterContent::where('chapter_id', $id)->first('content');
        if ($chapterContentCollection !== null) 
            $this->chapterContent = $chapterContentCollection->content;
        if ($this->chapterContent) $this->alreadyExists = true;
    }

    // --------------------- FRONT METHODS ---------------------
    public function showAddContentForm() {
        $this->showAddContentForm = true;
    }

    public function render()
    {
        return view('livewire.admin.edit-chapter-content');
    }
}
