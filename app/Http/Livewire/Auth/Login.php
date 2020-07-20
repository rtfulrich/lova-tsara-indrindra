<?php

namespace App\Http\Livewire\Auth;

use App\User;
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
            $this->addError('email', 'Email na tenimiafina diso');
            // $this->addError('email', trans('auth.failed'));
            return;
        }

        $user = User::find(Auth::user()->id);
        if ($user->hasRole('superadmin')) return redirect()->route('admin.dashboard');

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
