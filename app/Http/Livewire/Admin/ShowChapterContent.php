<?php

namespace App\Http\Livewire\Admin;

use App\ChapterContent;
use Livewire\Component;

class ShowChapterContent extends Component
{

    public $chapterContent;
    public $courseTitle;
    public $chapterTitle;

    public $showFlashMsg = true;

    public function mount(int $id) {
        $chapterContentModel = ChapterContent::findOrFail($id);
        $this->chapterContent = $chapterContentModel->content;
        $this->chapterTitle = $chapterContentModel->courseChapter->title;
        $this->courseTitle = $chapterContentModel->courseChapter->course->title;
    }

    public function render()
    {
        return view('livewire.admin.show-chapter-content');
    }

    public function removeFlashMsg() {
        $this->showFlashMsg = false;
    }
}
