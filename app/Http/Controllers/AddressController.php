<?php
namespace App\Http\Controllers;

use App\DTOs\AddressDTO;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\AddressService;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $service
    ) {}

    public function store(StoreAddressRequest $request)
    {
        $dto = AddressDTO::fromArray($request->validated());
        return response()->json($this->service->create($dto), 201);
    }

    public function update(UpdateAddressRequest $request, $id)
    {
        $dto = AddressDTO::fromArray($request->validated());
        $updated = $this->service->update($id, $dto);
        if (!$updated) return response()->json(['message' => 'Not found'], 404);

        return response()->json($updated);
    }

    public function destroy($id)
    {
        if (!$this->service->delete($id)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(null, 204);
    }

    public function show($id)
    {
        $address = $this->service->find($id);
        if (!$address) return response()->json(['message' => 'Not found'], 404);

        return response()->json($address);
    }

    public function viaCep(string $cep)
    {
        try {
            return response()->json($this->service->getAddressByCep($cep));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function mapsUrl($id)
    {
        $address = $this->service->find($id);
        if (!$address) return response()->json(['message' => 'Not found'], 404);

        $dto = AddressDTO::fromArray($address->toArray());
        return response()->json(['url' => $this->service->getGoogleMapsUrl($dto)]);
    }
}
