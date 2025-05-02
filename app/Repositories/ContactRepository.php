<?php

namespace App\Repositories;

use App\DTOs\ContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function all(int $userId)
    {
        return Contact::with('addresses')->where('user_id', $userId)->get();
    }

    public function create(ContactDTO $data): Contact
    {
        return Contact::create($data->toArray());
    }

    public function find(int $id): ?Contact
    {
        return Contact::with('addresses')->find($id);
    }

    public function update(int $id, ContactDTO $data): ?Contact
    {
        $contact = Contact::find($id);
        if (!$contact) return null;

        $contact->update($data->toArray());
        return $contact;
    }

    public function delete(int $id): bool
    {
        $contact = Contact::find($id);
        if (!$contact) return false;

        return $contact->delete();
    }
}
