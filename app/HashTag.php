<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashTag extends Model
{

    public function courses() {
        return $this->belongsToMany(Course::class, 'hash_tag_course', 'hash_tag_id', 'course_id');
    }

}
