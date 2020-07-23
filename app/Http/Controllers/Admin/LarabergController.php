<?php

namespace App\Http\Controllers\Admin;

use App\ChapterContent;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use VanOns\Laraberg\Models\Gutenbergable;

class LarabergController extends Controller
{
    use Gutenbergable;
    
    public function storeChapterContent(int $id, Request $request) {
        $chapterContent = new ChapterContent();
        $chapterContent->content = $request->courseContent;
        $chapterContent->chapter_id = $id;
        $chapterContent->save();
        session()->flash('msg', 'Kontenan\' toko feno soamantsara');
        return redirect()->route('admin.course.chapter.show-content', ChapterContent::latest()->first('id')->id);
    }

    public function updateChapterContent(int $id, Request $request) {
        $chapterContent = ChapterContent::where('chapter_id', $id)->first();
        $chapterContent->content = $request->courseContent;
        $chapterContent->save();
        session()->flash('msg', 'Kontenan\' toko voaova soamantsara !!!');
        return redirect()->route('admin.course.chapter.show-content', $chapterContent->id);
    }

    public function updateCourseDescription(Request $request, int $courseId) {
        $course = Course::find($courseId);
        $course->description = $request->courseDescription;
        $course->save();

        session()->flash('msg', 'Famaritana ny fampianarana voaova soamantsara !!!');
        return redirect()->back();
    }

}
