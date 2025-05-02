<?php
namespace App\Services;

use App\Repositories\ContactRepository;
use App\DTO\ContactDTO;
use Illuminate\Support\Facades\Http;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function createContact(ContactDTO $contactDTO)
    {
        // Validar CPF, endereço, e geocodificar o endereço
        $address = $this->geocodeAddress($contactDTO->address);

        $contactDTO->latitude = $address['results'][0]['geometry']['location']['lat'];
        $contactDTO->longitude = $address['results'][0]['geometry']['location']['lng'];

        return $this->contactRepository->create($contactDTO);
    }

    public function getContacts($request)
    {
        return $this->contactRepository->getAll($request);
    }

    public function getContactById($id)
    {
        return $this->contactRepository->find($id);
    }

    public function updateContact($id, ContactDTO $contactDTO)
    {
        $address = $this->geocodeAddress($contactDTO->address);

        $contactDTO->latitude = $address['results'][0]['geometry']['location']['lat'];
        $contactDTO->longitude = $address['results'][0]['geometry']['location']['lng'];

        return $this->contactRepository->update($id, $contactDTO);
    }

    public function deleteContact($id)
    {
        return $this->contactRepository->delete($id);
    }

    public function geocodeAddress($address)
    {
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $address,
            'key' => $googleMapsApiKey
        ]);
        return $response->json();
    }
}
