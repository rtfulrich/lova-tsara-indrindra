<?php

namespace App\Http\Livewire\Website\Includes;

use Livewire\Component;

class RightSidebar extends Component
{

    public $currentPage = 'home';

    public $showSidebarMenu = false;

    protected $listeners = [
        'showSideBarMenu' => 'showSideBarMenu'
    ];

    public function toHome() {
        if ($_SERVER['HTTP_ORIGIN'] === substr($_SERVER['HTTP_REFERER'], 0, -1)) return;
        return redirect()->route('home');

    }

    public function showSideBarMenu() {
        $this->showSideBarMenu = true;
        $this->render();
    }

    public function render()
    {
        return view('livewire.website.includes.right-sidebar');
    }
}
