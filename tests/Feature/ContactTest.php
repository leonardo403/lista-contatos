<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        return $this->actingAs($user, 'sanctum');
    }

    public function test_can_create_contact()
    {
        $this->authenticate();

        $data = [
            'name' => 'João da Silva',
            'email' => 'joao@email.com',
            'phone' => '11999999999',
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'João da Silva']);

        $this->assertDatabaseHas('contacts', ['email' => 'joao@email.com']);
    }

    public function test_validation_error_on_create()
    {
        $this->authenticate();

        $response = $this->postJson('/api/contacts', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'phone']);
    }

    public function test_can_update_contact()
    {
        $this->authenticate();

        $contact = Contact::factory()->create();

        $response = $this->putJson("/api/contacts/{$contact->id}", [
            'name' => 'Atualizado',
            'email' => 'novo@email.com',
            'phone' => '1122223333',
        ]);

        $response->assertOk()
                 ->assertJsonFragment(['name' => 'Atualizado']);
    }

    public function test_can_delete_contact()
    {
        $this->authenticate();

        $contact = Contact::factory()->create();

        $response = $this->deleteJson("/api/contacts/{$contact->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
