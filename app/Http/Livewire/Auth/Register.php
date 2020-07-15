<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    
    public $username = '';

    public $email = '';

    public $password = '';

    public $passwordConfirmation = '';

    
    public function register()
    {
        $this->validate([
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);
            // dd($this->username, $this->email, $this->password);
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        $user->sendEmailVerificationNotification();

        Auth::login($user, true);

        redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
