<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LoginForm extends Component
{
    public string $email;

    public string $password;

    protected $rules = [
        'email' => ['required', 'email:dns'],
        'password' => ['required'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.login-form');
    }
}
