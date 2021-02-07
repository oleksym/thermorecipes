<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Hash;
use Auth;

class Registration extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $registered = false;

    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|same:password',
    ];

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function redirectAfterRegistration()
    {
        Auth::check() || abort(401);
        session()->flash('message', __('Hello chef! Now Thermorecipies world is yours :)'));
        return redirect()->route('home');
    }

    public function register()
    {
        $this->validate();
        $user = new User(['name' => $this->name, 'email' => $this->email, 'password' => Hash::make($this->password)]);
        $user->save();
        Auth::login($user);
        $this->registered = true;
    }

    public function render()
    {
        return view('livewire.registration')
            ->layout('layouts.app');
    }
}
