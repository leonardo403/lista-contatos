<?php

namespace App\DTOs;

class AddressDTO
{
    public function __construct(
        public int $contact_id,
        public string $cep,
        public string $street,
        public string $number,
        public string $neighborhood,
        public string $city,
        public string $state
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            contact_id: $data['contact_id'],
            cep: $data['cep'],
            street: $data['street'],
            number: $data['number'],
            neighborhood: $data['neighborhood'],
            city: $data['city'],
            state: $data['state'],
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
