<?php
namespace App\DTOs;

class ContactDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public int $user_id,
    ) {}

    public static function fromArray(array $data, int $userId): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            user_id: $userId
        );
    }

    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'user_id'  => $this->user_id,
        ];
    }
}
