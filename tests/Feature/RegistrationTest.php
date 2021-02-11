<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire;
use App\Http\Livewire\Registration;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_contains_registration_livewire_component()
    {
        $this->get(route('register'))->assertSeeLivewire('registration');
    }

    public function test_redirectAfterRegistration_method_without_authentication()
    {
        Livewire::test(Registration::class)
            ->call('redirectAfterRegistration')
            ->assertStatus(401);
    }

    public function test_authentication_after_registration()
    {
        Livewire::test(Registration::class)
            ->set('name', 'tester1')
            ->set('email', 'tester1@test.com')
            ->set('password', 'password2')
            ->set('password_confirmation', 'password2')
            ->call('register');
        $this->assertAuthenticated();
    }

    public function test_account_creation_in_registration_process()
    {
        $email = 'tester1@test.com';
        Livewire::test(Registration::class)
            ->set('name', 'tester1')
            ->set('email', $email)
            ->set('password', 'password2')
            ->set('password_confirmation', 'password2')
            ->call('register');

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_registration_validation()
    {
        Livewire::test(Registration::class)
            ->set('name', 't')
            ->set('email', 'bad_email')
            ->set('password', 'p')
            ->set('password_confirmation', 'other_password')
            ->call('register')
            ->assertHasErrors(['name', 'email', 'password', 'password_confirmation']);
    }
}
