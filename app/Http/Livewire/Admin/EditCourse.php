<?php

namespace App\Http\Livewire\Admin;

use App\Course;
use App\CourseChapter;
use App\GroupChapter;
use App\HashTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditCourse extends Component
{
    use WithFileUploads;

    public $originalCourseTitle;
    public $course;
    public $courseTitle;
    public $courseCategory;
    public $courseLevel;
    public $courseImage = null;
    public $courseDescription;
    public $isCoursePublished;
    public $useGroupOfChapters;

    public $chapters = [];
    public $groupOfChapters = [];
    public $chapterToEditNumber = null;
    public $chapterToEditTitle = null;
    public $newChapterNumber = "";
    public $newChapterTitle = "";
    public $newGroupOfChaptersNumber = "";
    public $newGroupOfChaptersTitle = "";
    public $newCourseImage = null;

    public $groupChapterIdToBeAdded = null;
    public $groupChapterIdToBeRemoved = null;

    public $showFlashMsg = true;
    public $showEditCourseTitleForm = false;
    public $showAddChapterForm = false;
    public $showAddGroupChapterForm = false;
    public $showConfirmDeleteGroupChapter = false;
    public $newCourseTitleCanBeSaved = false;
    public $showConfigs = false;
    public $showTagSuggestions = false;

    public $newHashTag = "";
    public $hashTagSuggestions = [];

    // ---------------------- PROCESS METHODS --------------------
 
        public function mount(int $id) { 
            $this->course = Course::findOrFail($id);
            $this->courseTitle = $this->course->title;
            $this->originalCourseTitle = $this->courseTitle;
            $this->courseCategory = $this->course->category;
            $this->courseLevel = $this->course->level;
            $this->courseImage = $this->course->image;
            $this->courseDescription = $this->course->description;
            $this->isCoursePublished = $this->course->published;
            $this->useGroupOfChapters = $this->course->use_group_chapters;

            foreach ($this->course->courseChapters as $chapter) {
                $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
            }
            foreach ($this->course->groupChapters as $groupChapter) {
                $this->groupOfChapters[] = collect($groupChapter)
                    ->except(['created_at', 'updated_at'])
                    ->put('chapters', collect($groupChapter->courseChapters)->toArray());
            }
            // dd($this->groupOfChapters);
        }

        public function changeCourseImage() {
            $this->validate([
                'newCourseImage' => 'image|max:1024',
            ]);
            
            // future old filename
            $futureOld = $this->courseImage;
            $fullPath = 'public/course_images/'.$futureOld;

            // store and upload new image
            $fileName = '' . time() . rand(11111, 99999) . '.' . $this->newCourseImage->getClientOriginalExtension();
            $this->newCourseImage->storeAs('public/course_images', $fileName);
            $this->course->image = $fileName;
            $this->course->save();
            $this->newCourseImage = null;
            $this->courseImage = $this->course->image;
            
            if (Storage::exists($fullPath)) Storage::delete($fullPath);
        }

        public function addHashTagFromExisted(int $hashTagId) {
            $this->course->hashTags()->attach(HashTag::find($hashTagId));
            $this->course = Course::findOrFail($this->course->id);
            $this->newHashTag = "";
            $this->showTagSuggestions = false;
        }

        public function removeHashTagFromCourse(int $hashTagId) {
            $this->course->hashTags()->detach(HashTag::find($hashTagId));
            $this->course = Course::findOrFail($this->course->id);
        }

        public function addHashTag(int $courseId) {
            if (trim($this->newHashTag) === "") return;
            $hashTag = new HashTag();
            $hashTag->name = $this->newHashTag;
            $hashTag->save();

            $hashTag->courses()->attach($this->course);
            $this->newHashTag = "";
            $this->course = Course::find($this->course->id);
        }

        public function handleUpdateChapterNumber(int $id) {
            if ($this->newChapterNumber == $this->chapterToEditNumber) {
                $this->cancelEditChapter(); 
                return;
            }
            $chapter = CourseChapter::findOrFail($id);
            $chapter->number = $this->newChapterNumber;
            $chapter->save();

            session()->flash('msg', 'Laharana toko voaova soamantsara !!!');
            $this->cancelEditChapter();
            $this->reloadChapters();
        }

        private function reloadChapters() {
            $this->chapters = [];
            $this->course = Course::findOrFail($this->course->id);
            foreach ($this->course->courseChapters as $chapter) {
                $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
            }
            $this->groupOfChapters = [];
            foreach ($this->course->groupChapters as $groupChapter) {
                $this->groupOfChapters[] = collect($groupChapter)
                    ->except(['created_at', 'updated_at'])
                    ->put('chapters', collect($groupChapter->courseChapters)->toArray());
            }
        }

        public function addGroupOfChapters() {
            if (trim($this->newGroupOfChaptersNumber) === "" or trim($this->newGroupOfChaptersTitle) === "") {
                session()->flash('msg', 'Mila fenoina daholo na ny laharany na ny lohateniny');
                return;
            }
            $groupChapter = new GroupChapter();
            $groupChapter->number = $this->newGroupOfChaptersNumber;
            $groupChapter->title = $this->newGroupOfChaptersTitle;
            $groupChapter->course_id = $this->course->id;
            $groupChapter->save();

            $this->newGroupOfChaptersNumber = "";
            $this->newGroupOfChaptersTitle = "";
            $this->showAddGroupChapterForm = false;
            $this->reloadChapters();
        }

        public function handleUpdateChapterTitle(int $id) {
            if ($this->newChapterTitle == $this->chapterToEditTitle) {
                $this->cancelEditChapter(); 
                return;
            }
            $chapter = CourseChapter::findOrFail($id);
            $chapter->title = $this->newChapterTitle;
            $chapter->save();

            session()->flash('msg', 'Lohatenin\' toko voaova soamantsara !!!');
            $this->cancelEditChapter();
            $this->chapters = [];
            $this->course = Course::findOrFail($this->course->id);
            /*foreach ($this->course->courseChapters as $chapter) {
                $this->chapters[] = collect($chapter)->except(['created_at', 'updated_at']);
            }*/
            $this->reloadChapters();
        }

        public function addChapter(int $groupChapterId) {
            $chapter = new CourseChapter();
            $chapter->number = $this->newChapterNumber;
            $chapter->title = $this->newChapterTitle;
            $chapter->group_chapter_id = $groupChapterId;
            $chapter->course_id = $this->course->id;
            $chapter->slug = Str::slug($this->newChapterTitle);
            $saved = $chapter->save();
            if ($saved) {
                session()->flash('msg', 'Toko voampy soamantsara !!!');
                $this->showAddChapterForm = false;
                $this->reloadChapters();
            }
            else session()->flash('msg', 'Error, Toko tsy voampy !!!');
            $this->newChapterNumber = "";
            $this->newChapterTitle = "";
            $this->groupChapterIdToBeAdded = null;
        }

        public function deleteGroupChapter(int $groupChapterId) {
            $groupChapter = GroupChapter::findOrFail($groupChapterId);
            $groupChapter->courseChapters()->delete();
            $groupChapter->delete();
            session()->flash('msg', 'Vondrotoko voafafa soamantsara !!!');
            $this->reloadChapters();
            $this->showConfirmDeleteGroupChapter = false;
            $this->groupChapterIdToBeRemoved = null;
        }

        public function saveNewCourseTitle() {
            $course = Course::findOrFail($this->course->id);
            $course->title = $this->courseTitle;
            $course->save();
            session()->flash('msg', 'Lohatenin\' lesona voaova soamantsara !!!');
            $this->originalCourseTitle = $course->title;
            $this->showEditCourseTitleForm = false;
            $this->newCourseTitleCanBeSaved = false;
        }

        public function updatedNewChapterNumber() {
            if (strlen($this->newChapterNumber) > 0) {
                $this->newChapterNumber = (int) $this->newChapterNumber;
                if ($this->newChapterNumber == 0) 
                    $this->newChapterNumber = $this->chapterToEditNumber;
            }
        }

        public function updatedCourseTitle() {
            if ($this->originalCourseTitle !== $this->courseTitle) {
                $this->newCourseTitleCanBeSaved = true;
            }
            else {
                $this->newCourseTitleCanBeSaved = false;
            }
        }
    // END PROCESS METHODS

    // ---------------------- FRONT METHODS --------------------
        public function removeFlashMsg() {
            $this->showFlashMsg = false;
        }

        public function updatedNewCourseImage() {
            $this->validate([
                'newCourseImage' => 'image|max:1024'
            ]);
        }

        public function updatedNewHashTag() {
            $this->newHashTag = Str::lower(trim($this->newHashTag));
            if (strlen($this->newHashTag) > 0) {
                $this->hashTagSuggestions = collect(HashTag::where('name', 'LIKE', '%' . $this->newHashTag . '%')
                    ->whereDoesntHave('courses', function (Builder $query) {
                        $query->where('course_id', $this->course->id);
                    })
                    ->get())
                ->toArray();
                $this->showTagSuggestions = !empty($this->hashTagSuggestions);
            } else $this->showTagSuggestions = false;
        }


        public function hideTagSuggestions() {
            $this->showTagSuggestions = false;
        }

        public function editChapterContent(int $id) {
            $chapter = CourseChapter::findOrFail($id);
            return redirect()->route('admin.course.chapter.edit-content', $chapter->id);
        }

        public function showAddChapterForm(int $groupOfChapterId) {
            $this->showEditCourseTitleForm = false;
            $this->showAddChapterForm = true;
            $this->groupChapterIdToBeAdded = $groupOfChapterId;
        }

        public function editChapterNumber(int $id) {
            $this->chapterToEditNumber = CourseChapter::findOrFail($id)->number;
            $this->chapterToEditTitle = null;
            // $this->chapterToEditNumberOriginal = $this->chapterToEditNumber;
        }

        public function editChapterTitle(int $id) {
            $this->chapterToEditNumber = null;
            $this->chapterToEditTitle = CourseChapter::findOrFail($id)->title;
        }

        public function showCourseTitleContent() {
            $this->showEditCourseTitleForm = false;
            $this->newCourseTitleCanBeSaved = false;
            $this->courseTitle = $this->originalCourseTitle;
        }

        public function showEditCourseTitleForm() {
            $this->showEditChapterForm = false;
            $this->showEditCourseTitleForm = true;
        }

        public function render()
        {
            return view('livewire.admin.edit-course');
        }

        public function cancelAddNewChapter() {
            $this->showAddChapterForm = false;
            $this->showEditCourseTitleForm = false;
            $this->groupChapterIdToBeAdded = null;
        }

        public function cancelEditChapter() {
            $this->chapterToEditNumber = null;
            $this->chapterToEditTitle = null;
            $this->newChapterNumber = "";
            $this->newChapterTitle = "";
        }

        public function showAddGroupChapterForm() {
            $this->showAddGroupChapterForm = true;
            $this->showEditCourseTitleForm = false;
            $this->showAddChapterForm = false;
        }

        public function hideAddGroupChapterForm() {
            $this->showAddGroupChapterForm = false;
        }

        public function updatedNewGroupOfChaptersNumber() {
            $this->newGroupOfChaptersNumber = (int) $this->newGroupOfChaptersNumber;
            if ($this->newGroupOfChaptersNumber == 0) $this->newGroupOfChaptersNumber = "";
        }

        public function confirmDeleteGroupChapter(int $chapterGroupId) {
            if ($this->groupChapterIdToBeRemoved) return;
            $this->groupChapterIdToBeRemoved = $chapterGroupId;
            $this->showConfirmDeleteGroupChapter = true;
        }

        public function cancelDeleteGroupChapter() {
            $this->showConfirmDeleteGroupChapter = false;
            $this->groupChapterIdToBeRemoved = null;
        }

        public function showConfigs() {
            $this->showConfigs = true;
        }

        public function hideConfigs() {
            $this->showConfigs = false;
        }

        public function updatedCourseCategory() {
            $this->course->category = $this->courseCategory;
            $this->course->save();
        }

        public function updatedCourseLevel() {
            $this->course->level = $this->courseLevel;
            $this->course->save();
        }

        public function updatedUseGroupOfChapters() {
            $this->course->use_group_chapters = $this->useGroupOfChapters;
            $this->course->save();
        }

        public function updatedIsCoursePublished() {
            $this->course->published = $this->isCoursePublished;
            $this->course->save();
        }

    // END FRONT METHODS

}
