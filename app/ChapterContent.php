<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapterContent extends Model
{
    
    public function courseChapter() {
        return $this->belongsTo(CourseChapter::class, 'chapter_id');
    }

}
