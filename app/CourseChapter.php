<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function content() {
        return $this->hasOne(ChapterContent::class, 'chapter_id');
    }

    public function groupChapter() {
        return $this->belongsTo(GroupChapter::class);
    }

    public function comments() {
        return $this->hasMany(CourseComment::class, 'chapter_id');
    }

}
