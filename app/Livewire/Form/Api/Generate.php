<?php

namespace App\Livewire\Form\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Generate extends Component
{
    public $password;

    public $apiKey;

    public $buttonText, $generatedAt;

    public $showApi = false;

    public function mount()
    {        
        $user = Auth::user();

        if ($user->key_generated) {
            $this->buttonText = 'Re-generate';
            $this->generatedAt = $user->key_generated_at_formatted;
        } else {
            $this->buttonText = 'Generate';
        }
    }

    public function generate(Request $request)
    {
        $this->validate([
            'password' => 'required'
        ]);

        try {
            $user = Auth::user();

            if (Hash::check($this->password, $user->password)) {
                if (! $user->key_generated) {
                    $token = $request->user()->createToken('berapiapi_token');

                    $this->apiKey = $token->plainTextToken;

                    $request->user()->update([
                        'key_generated' => true,
                        'key_generated_at' => Carbon::now()
                    ]);

                    $this->showApi = true;

                    $this->mount();

                } else {
                    $request->user()->tokens()->delete();

                    $token = $request->user()->createToken('berapiapi_token');

                    $this->apiKey = $token->plainTextToken;

                    $request->user()->update([
                        'key_generated_at' => Carbon::now()
                    ]);

                    $this->showApi = true;

                    $this->mount();
                }                

            } else {
                $this->dispatch('error', 'Wrong password.');
            }
            
        } catch (\Exception $e) {
            $this->dispatch('error', 'Something error! Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.form.api.generate');
    }
}
