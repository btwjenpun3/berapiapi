<?php

namespace App\Livewire\Form\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        $credential = $this->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        try {
            if(Auth::attempt($credential)) {
                $user = Auth::user();        

                Session::put('user_id', $user->id);

                Session::put('user_name', $user->name);  

                session()->regenerate();

                return redirect()->route('dashboard.index');

            } else {
                throw new \Exception('Wrong email / Password');
            }

        } catch (\Exception $e) {
            $this->dispatch('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.form.auth.login');
    }
}
