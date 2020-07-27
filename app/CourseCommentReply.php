<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCommentReply extends Model
{
    
    public function parentComment() {
        return $this->belongsTo(CourseComment::class, 'course_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'author');
    }

}
