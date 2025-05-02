<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Interfaces\ContactRepositoryInterface;

class ContactService
{
    public function __construct(
        protected ContactRepositoryInterface $repository
    ) {}

    public function list(int $userId)
    {
        return $this->repository->all($userId);
    }

    public function create(ContactDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, ContactDTO $dto)
    {
        return $this->repository->update($id, $dto);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
