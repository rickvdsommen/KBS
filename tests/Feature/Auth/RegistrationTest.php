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

    public function test_registration_screen_returns_error_with_missing_signed_url(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(403);
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
            'birthday' => '2024-05-01',
            'function' => 'test gebruiker',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_new_users_can_not_register_with_tampered_email_in_form(): void
    {
        $email = 'test@example.com';
        $temperedEmail = 'foo@bar.com';
        $signedUrl = URL::temporarySignedRoute('register', now()->addDays(7), ['email' => $email]);
        
        $response = $this->post($signedUrl, [
            'name' => 'Test User',
            'email' => $temperedEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        
        $this->assertNotEquals(
            $email,
            $temperedEmail
        );

        $response->assertSessionHasErrors([
            'email' => "The selected email is invalid."
        ]);
    }
}
