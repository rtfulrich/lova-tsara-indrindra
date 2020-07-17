<?php

namespace App\Http\Controllers\Admin;

use App\ChapterContent;
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

}
