<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember_me;
    public $logged_in = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function redirectAfterLogin()
    {
        Auth::check() || abort(401);
        return redirect()->route('home');
    }

    public function login()
    {
        // TODO: rate limiter
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $this->logged_in = true;
    }

    public function render()
    {
        return view('livewire.login')
            ->layout('layouts.app');
    }
}
