<?php

namespace App\Http\Livewire\Website\Pages;

use App\Course;
use App\CourseComment;
use App\CourseCommentReply;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseItemContent extends Component
{

    public $course;
    public $courseComments;
    public $courseFirstHashTag;

    public $newCourseComment = "";
    public $newCommentReply = "";

    public $showCourseAbout = true;
    public $groupChaptersToShow = null;
    public $commentIdToReply = null;
    public $commentIdToShowReplies = null;

    // PROCESS METHODS
        public function mount(string $hashTag, string $slug) {
            $this->course = Course::where('slug', $slug)->first();
            if ($this->course->hashTags()->first()->name !== $hashTag) 
                abort(404, 'Tsy tazana ny rohy nangatahanao !!!');
            if (is_null($this->course)) 
                abort(404, 'Tsy hita ny rohy nampidirinao !!!');
            
            $this->courseComments = $this->course->comments()->latest()->get();
            $this->courseFirstHashTag = $this->course->hashTags()->first()->name;

            if ($this->course->use_group_chapters) 
                $this->groupChaptersToShow = $this->course->groupChapters()->first()->id;
        }

        public function replyComment(int $commentId) {
            if (trim($this->newCommentReply) === "") return;
            $commentReply = new CourseCommentReply();
            $commentReply->content = $this->newCommentReply;
            $commentReply->comment_id = $commentId;
            $commentReply->author = User::find(Auth::user()->id)->id;
            $commentReply->course_id = $this->course->id;
            $commentReply->save();

            $this->newCommentReply = "";
            $this->courseComments = $this->course->comments()->latest()->get();
            $this->commentIdToReply = null;
            $this->commentIdToShowReplies = $commentId;
        }

        public function addCourseComment() {
            if (trim($this->newCourseComment) === "") return;
            $comment = new CourseComment();
            $comment->content = $this->newCourseComment;
            $comment->course_id = $this->course->id;
            $comment->author = User::find(Auth::user()->id)->id;
            $comment->save();

            $this->courseComments = $this->course->comments()->latest()->get();
            $this->newCourseComment = "";
        }
    
    // FRONT METHODS  
        public function toggleCommentReplies(int $commentId) {
            if ($this->commentIdToShowReplies === $commentId) $this->commentIdToShowReplies = null;
            else $this->commentIdToShowReplies = $commentId;
        }

        public function showReplyCommentForm(int $commentId) {
            $this->commentIdToReply = $commentId;
        }
        public function cancelReply() {
            $this->commentIdToReply = null;
        }
        
        public function setGroupChapterToShow(int $groupId) {
            $this->groupChaptersToShow = $this->course->groupChapters()->where('id', $groupId)->get('id')[0]->id;
        }

        public function changeShowCourseAbout() {
            $this->showCourseAbout = !$this->showCourseAbout;
        }

        public function render()
        {
            return view('livewire.website.pages.course-item-content');
        }

}
