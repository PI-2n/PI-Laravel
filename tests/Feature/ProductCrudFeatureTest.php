<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (Role::count() === 0) {
            Role::create(['id' => 1, 'name' => 'admin']);
            Role::create(['id' => 2, 'name' => 'customer']);
        }
    }

    public function test_public_users_can_list_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_public_users_cannot_view_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_view_single_product()
    {
        $user = User::factory()->create(['role_id' => 2]);
        Sanctum::actingAs($user);

        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $product->id]]);
    }

    public function test_authenticated_user_can_create_product()
    {
        $user = User::factory()->create(['role_id' => 1]);
        Sanctum::actingAs($user);

        $productData = [
            'sku' => 'TEST-SKU-001',
            'name' => 'Producto Test',
            'price' => 100.50,
            'description' => 'Descripción corta',
            'active' => true,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJsonPath('data.sku', 'TEST-SKU-001');

        $this->assertDatabaseHas('products', ['sku' => 'TEST-SKU-001']);
    }

    public function test_authenticated_user_can_update_product()
    {
        $user = User::factory()->create(['role_id' => 1]);
        Sanctum::actingAs($user);

        $product = Product::factory()->create();

        $updateData = [
            'sku' => $product->sku,
            'name' => 'Nombre Actualizado',
            'price' => 200.00,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Nombre Actualizado');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Nombre Actualizado',
            'price' => 200.00,
        ]);
    }

    public function test_authenticated_user_can_delete_product()
    {
        $user = User::factory()->create(['role_id' => 1]);
        Sanctum::actingAs($user);

        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
