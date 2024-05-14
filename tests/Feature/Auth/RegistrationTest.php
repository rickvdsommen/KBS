<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {   
        $email = 'test@example.com';
        $signedUrl = URL::temporarySignedRoute('register', now()->addDays(7), ['email' => $email]);

        $response = $this->get($signedUrl);

        $response->assertStatus(200);
    }
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $email = 'test@example.com';
        $signedUrl = URL::temporarySignedRoute('register', now()->addDays(7), ['email' => $email]);
        
        $response = $this->post($signedUrl, [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
