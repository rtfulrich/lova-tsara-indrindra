<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    public function courseChapters() {
        return $this->hasMany(CourseChapter::class);
    }

}
