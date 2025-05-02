<?php

namespace App\Http\Controllers;

use App\DTOs\ContactDTO;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $service
    ) {}

    public function index(Request $request)
    {
        return response()->json(
            $this->service->list($request->user()->id)
        );
    }

    public function store(StoreContactRequest $request)
    {
        $dto = ContactDTO::fromArray($request->validated(), $request->user()->id);
        return response()->json($this->service->create($dto), 201);
    }

    public function show($id)
    {
        $contact = $this->service->find($id);
        if (!$contact) return response()->json(['message' => 'Not found'], 404);

        return response()->json($contact);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $dto = ContactDTO::fromArray($request->validated(), $request->user()->id);
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
}
