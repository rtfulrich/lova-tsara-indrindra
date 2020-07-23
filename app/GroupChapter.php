<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupChapter extends Model
{
    
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function courseChapters() {
        return $this->hasMany(CourseChapter::class);
    }

}
