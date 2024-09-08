<?php

namespace App\Livewire\Form\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $firstName, $lastName, $email, $password, $passwordConfirmation;

    public function submit()
    {
        $this->validate([
            'firstName'             => 'required|max:100',
            'lastName'              => 'required|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|required_with:passwordConfirmation|same:passwordConfirmation',
            'passwordConfirmation'  => 'required|min:8'
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'role_name'     => 'Member',
                'first_name'    => $this->firstName,
                'last_name'     => $this->lastName,
                'email'         => $this->email,
                'password'      => bcrypt($this->password),
                'key_generated' => 0
            ]);

            DB::commit();

            return redirect()->route('auth.login')->with('success', 'Thanks for registering. Now you can login using your email and password');

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('error', 'Something wrong, please try again later!');
        }
    }

    public function render()
    {
        return view('livewire.form.auth.register');
    }
}
