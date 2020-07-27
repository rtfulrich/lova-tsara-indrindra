<?php

namespace App\Http\Livewire\Website\Pages;

use App\CourseChapter;
use Livewire\Component;

class CourseChapterItemContent extends Component
{

    public $chapter;
    public $chapterContent;

    public function mount(string $hashTag, string $courseSlug, string $chapterSlug) {
        $this->chapter = CourseChapter::where('slug', $chapterSlug)->first();

        abort_if( (
                is_null($this->chapter) or 
                $this->chapter->course->slug !== $courseSlug or
                $this->chapter->course->hashTags()->where('name', $hashTag)->first() === null
            ),
            404, 'Tsy tazana ny pejy nangatahanao !!!'
        );

        $this->chapterContent = $this->chapter->content->content;
    }

    public function render()
    {
        return view('livewire.website.pages.course-chapter-item-content');
    }
}
