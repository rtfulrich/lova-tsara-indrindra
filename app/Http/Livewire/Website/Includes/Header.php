<?php

namespace App\Http\Livewire\Website\Includes;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    public function showLoginForm() {
        return redirect()->route('login');
    }

    public function showRegisterForm() {
        return redirect()->route('register');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.website.includes.header');
    }
}
