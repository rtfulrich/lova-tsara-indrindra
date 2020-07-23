<?php

namespace App\Http\Livewire\Admin;

use App\Course;
use App\CourseChapter;
use App\GroupChapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class NewCourse extends Component
{
    
    public $courseTitle = "";
    public $newChapterNumber = "";
    public $newChapterTitle = "";
    public $newGroupOfChaptersNumber = "";
    public $newGroupOfChaptersTitle = "";
    public $newChapterNumberInGroup = "";
    public $chaptersWithParentGroup = [];

    public $chapters = [];
    public $groupOfChapters = [];

    public $showFlashMsg = true;
    public $showAddGroupOfChaptersForm = false;
    public $showAddChapterForm = false;
    public $showCourseTitleForm = true;

    public function submit() {
        if (trim($this->courseTitle) === "") {
            session()->flash('msg', 'Mila fenoina ny lohatenin\' lesona !!!');
            return;
        }
        $course = new Course();
        $course->title = $this->courseTitle;
        $course->author = Auth::user()->id;
        $course->slug = Str::slug($this->courseTitle);
        $course->save();

        $lastCourseId = Course::latest()->first('id')->id;
        /*if (!empty($this->chapters)) {
            foreach ($this->chapters as $newChapter) {
                $chapter = new CourseChapter();
                $chapter->number = $newChapter['number'];
                $chapter->title = $newChapter['title'];
                $chapter->course_id = $lastCourseId;
                $chapter->save();
            }
        }*/
        if (!empty($this->chaptersWithParentGroup)) {
            foreach ($this->chaptersWithParentGroup as $groupItem) {
                $groupChapter = new GroupChapter();
                $groupChapter->title = $groupItem['title'];
                $groupChapter->number = $groupItem['number'];
                $groupChapter->course_id = $lastCourseId;
                $groupChapter->save();
                
                $lastGroupChapterId = GroupChapter::latest()->first('id')->id;
                foreach ($groupItem['chapters'] as $chapterItem) {
                    $chapter = new CourseChapter();
                    $chapter->number = $chapterItem['number'];
                    $chapter->title = $chapterItem['title'];
                    $chapter->course_id = $lastCourseId;
                    $chapter->group_chapter_id = $lastGroupChapterId;
                    $chapter->save();
                }
            }
        }
        session()->flash('msg', 'Course voaforona soamantsara !!!');
        return redirect()->route('admin.course.edit', $lastCourseId);
    }

    public function addChapter() {
        if (trim($this->newChapterTitle) === "") {
            session()->flash('msg', 'Mila fenoina lohatenin\' toko !!!');
            $this->showAddChapterForm = true;
            $this->showCourseTitleForm = false;
            $this->showAddGroupOfChaptersForm = false;
            $this->showFlashMsg = true;
            return;
        }
        if (trim($this->newChapterNumberInGroup) === "") {
            session()->flash('msg', 'Mila omena ny nomerao an vondrona toko !!!');
            return;
        }
        $this->chapters[] = [
            'number' => $this->newChapterNumber === "" ? count($this->chapters) + 1 : $this->newChapterNumber,
            'title' => $this->newChapterTitle,
            'group_number' => $this->newChapterNumberInGroup
        ];
        $this->chaptersWithParentGroup = [];
        foreach ($this->groupOfChapters as $groupItem) {
            $this->chaptersWithParentGroup[] = [
                'number' => $groupItem['number'],
                'title' => $groupItem['title'],
                'chapters' => $this->filter_by_value($this->chapters, 'group_number', $groupItem['number'])
            ];
        }

        $this->newChapterNumber = "";
        $this->newChapterTitle = "";
        $this->newChapterNumberInGroup = "";
        $this->showAddChapterForm = true;
        $this->showCourseTitleForm = false;
        $this->showAddGroupOfChaptersForm = false;
    }
    public function debug() {dd($this->chaptersWithParentGroup);}
    public function addGroupOfChapters() {
        if (!empty($this->groupOfChapters)) {
            if (array_search($this->newGroupOfChaptersNumber, array_column($this->groupOfChapters, 'number')) !== false) {
                session()->flash('msg', 'Efa misy io numero nomenao io !!!');
                return;
            }
        }
        if (trim($this->newGroupOfChaptersTitle) === "" or trim($this->newGroupOfChaptersNumber) === "") {
            session()->flash('msg', 'Mila fenoina daholo !!!');
            return;
        }

        $this->groupOfChapters[] = [
            'number' => $this->newGroupOfChaptersNumber,
            'title' => $this->newGroupOfChaptersTitle
        ];
        $this->chaptersWithParentGroup[] = [
            'number' => $this->newGroupOfChaptersNumber,
            'title' => $this->newGroupOfChaptersTitle, 
            'chapters' => []
        ];

        $this->newGroupOfChaptersNumber = "";
        $this->newGroupOfChaptersTitle = "";
    }

    public function removeFlashMsg() {
        $this->showFlashMsg = false;
    }

    public function showAddChapterForm() {
        $this->showAddChapterForm = true;
        $this->showAddGroupOfChaptersForm = false;
        $this->showCourseTitleForm = false;
    }

    public function cancelAddNewChapter() {
        $this->showAddChapterForm = false;
        $this->showAddGroupOfChaptersForm = false;
        $this->showCourseTitleForm = true;
    }

    public function showAddGroupOfChaptersForm() {
        $this->showAddGroupOfChaptersForm = true;
        $this->showAddChapterForm = false;
        $this->showCourseTitleForm = false;
    }

    public function cancelAddGroupOfChapters() {
        $this->showAddGroupOfChaptersForm = false;
        $this->showAddChapterForm = false;
        $this->showCourseTitleForm = true;
    }

    public function render() {
        return view('livewire.admin.new-course');
    }

    public function updatedNewChapterNumber() {
        $this->newChapterNumber = (int) $this->newChapterNumber;
        if ($this->newChapterNumber == 0) $this->newChapterNumber = "";
    }

    public function updatedNewGroupOfChaptersNumber() {
        $this->newGroupOfChaptersNumber = (int) $this->newGroupOfChaptersNumber;
        if ($this->newGroupOfChaptersNumber == 0) $this->newGroupOfChaptersNumber = "";
    }

    public function updatedNewChapterNumberInGroup() {
        $this->newChapterNumberInGroup = (int) $this->newChapterNumberInGroup;
        if ($this->newChapterNumberInGroup == 0) $this->newChapterNumberInGroup = "";
    }

    private function filter_by_value ($array, $index, $value){
        $newarray = [];
        if(is_array($array) && count($array)>0) 
        {
            foreach(array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                
                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
            /*for ($i = 0; $i < count($array); $i++) {
                $temp[$i] = $array[$i][$index];
                if ($temp[$i] == $value) $newarray[] = $array[$i];
            }*/
        }
        return $newarray;
    } 

}
