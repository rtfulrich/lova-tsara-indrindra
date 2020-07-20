<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public function mount() {
        // dd(Auth::user()->roles);
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
