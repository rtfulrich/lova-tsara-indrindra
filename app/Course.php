<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    public function courseChapters() {
        return $this->hasMany(CourseChapter::class, 'course_id');
    }

    public function groupChapters() {
        return $this->hasMany(GroupChapter::class);
    }

    public function comments() {
        return $this->hasMany(CourseComment::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function hashTags() {
        return $this->belongsToMany(HashTag::class, 'hash_tag_course', 'course_id', 'hash_tag_id');
    }

}
