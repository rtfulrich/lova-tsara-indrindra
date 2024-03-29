<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array'
    ];

    public function courseComments() {
        return $this->hasMany(CourseComment::class, 'author');
    }

    public function commentReplies() {
        return $this->hasMany(CourseCommentReply::class, 'author');
    }

    public function ownCourses() {
        return $this->hasMany(Course::class, 'author');
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_user');
    }

    /**
     * @param string $role
     * @return $this
     */
    public function addRole(string $role)
    {
        $roles = $this->getRoles();
        $role = trim($role);
        if ($role !== "") {
            $roles[] = $role;
            
            $roles = array_unique($roles);
            $this->setRoles($roles);

            return $this;
        }
        return;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles)
    {
        $this->setAttribute('roles', $roles);
        return $this;
    }

    /***
     * @param $role
     * @return mixed
     */
    public function hasRole(string $role)
    {
        return in_array($role, $this->getRoles());
    }

    /***
     * @param $roles
     * @return mixed
     */
    public function hasRoles(array $roles)
    {
        $currentRoles = $this->getRoles();
        foreach($roles as $role) {
            if ( ! in_array($role, $currentRoles )) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->getAttribute('roles');

        if (is_null($roles)) {
            $roles = [];
        }

        return $roles;
    }

    public function adminlte_image() {
        return 'https://picsum.photos/300/300';
    }
}
