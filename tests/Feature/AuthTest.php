<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_to_products(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'pVY0A@example.com',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'pVY0A@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products");
    }

    public function test_unaunthenticated_user_cannot_access_product(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(302);
        $response->assertRedirect("/login");
    }
}
