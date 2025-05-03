<?php
namespace App\Repositories;

use App\DTOs\AddressDTO;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    public function create(AddressDTO $data): Address
    {
        return Address::create($data->toArray());
    }

    public function update(int $id, AddressDTO $data): ?Address
    {
        $address = Address::find($id);
        if (!$address) return null;

        $address->update($data->toArray());
        return $address;
    }

    public function delete(int $id): bool
    {
        $address = Address::find($id);
        if (!$address) return false;

        return $address->delete();
    }

    public function find(int $id): ?Address
    {
        return Address::find($id);
    }
}
