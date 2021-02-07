<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire;
use App\Http\Livewire\Login;
use App\Models\User;

class LoginTest extends TestCase
{
    public function test_login_page_contains_login_livewire_component()
    {
        $this->get(route('login'))->assertSeeLivewire('login');
    }

    public function test_redirectAfterLogin_method_without_authentication()
    {
        Livewire::test(Login::class)
            ->call('redirectAfterLogin')
            ->assertStatus(401);
    }

    public function test_authentication_after_login()
    {
        $user = User::factory()->create();
        $user->save();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login');
        $this->assertAuthenticated();
    }

    public function test_not_authentication_after_login()
    {
        $user = User::factory()->create();
        $user->save();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'bad_password')
            ->call('login');
        $this->assertGuest();
    }

    public function test_registration_validation()
    {
        Livewire::test(Login::class)
            ->set('email', 'bad_email')
            ->set('password', 'p')
            ->call('login')
            ->assertHasErrors(['email']);
    }
}
