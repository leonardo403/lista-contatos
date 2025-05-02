<?php
namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\DTO\ContactDTO;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        return $this->contactService->getContacts($request);
    }

    public function show($id)
    {
        return $this->contactService->getContactById($id);
    }

    public function store(ContactRequest $request)
    {
        $contactDTO = new ContactDTO($request->validated());
        return $this->contactService->createContact($contactDTO);
    }

    public function update(Request $request, $id)
    {
        $contactDTO = new ContactDTO($request->validated());
        return $this->contactService->updateContact($id, $contactDTO);
    }

    public function destroy($id)
    {
        return $this->contactService->deleteContact($id);
    }
}
