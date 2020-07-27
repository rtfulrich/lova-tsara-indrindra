<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'author');
    }

    public function chapter() {
        return $this->belongsTo(CourseChapter::class, 'chapter_id');
    }

    public function replies() {
        return $this->hasMany(CourseCommentReply::class, 'comment_id');
    }

}
