<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;

class SpecificLanguageCategory extends Component
{

    public $courses;
    public $tutos;
    public $hashTag;
    public $pageTitle;

    public function mount(string $hashTag) {
        $this->hashTag = $hashTag;
        $this->pageTitle = Str::upper($hashTag) . ' - ' . \env('APP_NAME');
        $this->courses = Course::whereHas('hashTags', function (Builder $query) use ($hashTag) {
            $query->where('name', $hashTag);
        })->whereIn('category', ['formation', 'practice'])->latest()->get();

        $this->tutos = Course::whereHas('hashTags', function (Builder $query) use ($hashTag) {
            $query->where('name', $hashTag);
        })->where('category', 'tutorial')->latest()->get();
        
        \abort_if(count($this->courses) === 0 and count($this->tutos) === 0, 404, 'Tsy tazana ny pejy nangatahanao');
    }

    public function render()
    {
        return view('livewire.website.pages.specific-language-category');
    }
}
