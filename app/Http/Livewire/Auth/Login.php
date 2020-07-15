<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    protected $listeners = ['logout'];
    
    public $email = '';

    public $password = '';

    public $remember = false;

    public function authenticate()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        } else {
            if (Auth::user()->role === "superadmin") return redirect()->route('admin.dashboard');
        }

        redirect(route('home'));
    }

    public function logout() {
        dd('logout');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
