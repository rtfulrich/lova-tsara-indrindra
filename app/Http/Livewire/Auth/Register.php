<?php

namespace App\Http\Livewire\Auth;

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
            'username' => ['required', 'min:4', 'alpha_dash'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ], [
            '*.required' => 'Tsimaintsy fenoina ny :attribute',
            'username.alpha_dash' => 'Litera , digita sy - ary _ ihany no azo ampiasaina',
            '*.min' => ':min karàka farafakely ny :attribute',
            'email.email' => 'Tsy marina ny email nomenao',
            'email.unique' => 'Efa voampiasa ny email nomenao',
            'password.same' =>  'Tsy mitovy ny teny miafina roa nomenao'
        ], [
            'username' => 'anarasafidy',
            'password' => 'tenimiafina'
        ]);
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->roles = ['student'];
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
