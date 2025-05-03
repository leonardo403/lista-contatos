<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        return $this->actingAs($user, 'sanctum');
    }

    public function test_can_create_address_for_contact()
    {
        $this->authenticate();

        $contact = Contact::factory()->create();

        $data = [
            'cep' => '01001-000',
            'street' => 'Praça da Sé',
            'number' => '1',
            'neighborhood' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
        ];

        $response = $this->postJson("/api/contacts/{$contact->id}/addresses", $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['city' => 'São Paulo']);

        $this->assertDatabaseHas('addresses', ['cep' => '01001-000']);
    }

    public function test_can_delete_address()
    {
        $this->authenticate();

        $contact = Contact::factory()->create();
        $address = $contact->addresses()->create([
            'cep' => '01001-000',
            'street' => 'Praça da Sé',
            'number' => '1',
            'neighborhood' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
        ]);

        $response = $this->deleteJson("/api/contacts/{$contact->id}/addresses/{$address->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }
}

