<?php
namespace App\Services;

use App\DTOs\AddressDTO;
use App\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Facades\Http;

class AddressService
{
    public function __construct(
        protected AddressRepositoryInterface $repository
    ) {}

    public function create(AddressDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, AddressDTO $dto)
    {
        return $this->repository->update($id, $dto);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function getAddressByCep(string $cep): array
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            throw new \Exception('CEP não encontrado');
        }

        return [
            'street' => $response['logradouro'] ?? '',
            'neighborhood' => $response['bairro'] ?? '',
            'city' => $response['localidade'] ?? '',
            'state' => $response['uf'] ?? '',
        ];
    }

    public function getGoogleMapsUrl(AddressDTO $dto): string
    {
        $address = urlencode("{$dto->street}, {$dto->number}, {$dto->city}, {$dto->state}");
        return "https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_API_KEY&q={$address}";
    }
}
