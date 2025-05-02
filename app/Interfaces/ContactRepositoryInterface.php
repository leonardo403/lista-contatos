<?php

namespace App\Interfaces;

use App\DTOs\ContactDTO;
use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function all(int $userId);
    public function create(ContactDTO $data): Contact;
    public function find(int $id): ?Contact;
    public function update(int $id, ContactDTO $data): ?Contact;
    public function delete(int $id): bool;
}
