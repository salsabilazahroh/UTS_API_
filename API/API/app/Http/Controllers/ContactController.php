<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(CreateContactRequest $request): JsonResponse // Create new contact
    {
        $data = $request->validated();
        $contact = Contact::create($data);
        return (new ContactResource($contact))->response()->setStatusCode(201);
    }

    public function search(Request $request): JsonResponse // Search contacts
    {
        $query = Contact::query();

        // Filter by name
        if ($request->has('name')) {
            $query->where('first_name', 'like', '%' . $request->input('name') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
        }

        // Filter by phone
        if ($request->has('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }

        // Filter by email
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        // Paginate results
        $contacts = $query->paginate($request->input('size', 10));

        return ContactResource::collection($contacts)->response()->setStatusCode(200);
    }

    public function update(UpdateContactRequest $request, $id): JsonResponse // Update contact
    {
        $contact = Contact::findOrFail($id);
        $data = $request->validated();
        $contact->update($data);
        return (new ContactResource($contact))->response()->setStatusCode(200);
    }

    public function get($id): JsonResponse // Get contact
    {
        $contact = Contact::findOrFail($id);
        return (new ContactResource($contact))->response()->setStatusCode(200);
    }

    public function delete($id): JsonResponse // Remove contact
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(["data" => true])->setStatusCode(200);
    }
}
