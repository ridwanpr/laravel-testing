<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
    }

    public function createUser(bool $isAdmin = false): User
    {
        return User::factory()->create([
            'is_admin' => $isAdmin,
        ]);
    }

    public function test_api_returns_all_products()
    {
        $products = Product::factory(10)->create();

        $response = $this->actingAs($this->admin)->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJson($products->toArray());
    }

    public function test_api_product_store_successfull()
    {
        $product = [
            'name' => 'Product 123',
            'price' => 320,
        ];

        $response = $this->actingAs($this->admin)->postJson('/api/products', $product);

        $response->assertStatus(201);
        $response->assertJson($product);
        $this->assertDatabaseHas('products', $product);
    }

    public function test_api_product_store_returns_errors()
    {
        $product = [
            'name' => '',
            'price' => 320,
        ];

        $response = $this->actingAs($this->admin)->postJson('/api/products', $product);

        $response->assertStatus(422);
    }
}
