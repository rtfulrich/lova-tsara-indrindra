<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapterContents() {
        return $this->hasMany(ChapterContent::class);
    }

    public function groupChapter() {
        return $this->belongsTo(GroupChapter::class);
    }

}
