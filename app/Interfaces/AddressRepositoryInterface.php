<?php
namespace   App\Interfaces;

use App\DTOs\AddressDTO;
use App\Models\Address;

interface AddressRepositoryInterface
{
    public function create(AddressDTO $data): Address;
    public function update(int $id, AddressDTO $data): ?Address;
    public function delete(int $id): bool;
    public function find(int $id): ?Address;
}
