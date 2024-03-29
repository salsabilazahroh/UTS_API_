<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(CreateAddressRequest $request, $idContact): JsonResponse // Create new address
    {
        $data = $request->validated();
        $data['contact_id'] = $idContact; // Associate address with contact
        $address = Address::create($data);
        return (new AddressResource($address))->response()->setStatusCode(201);
    }

    public function getList(Request $request, $idContact): JsonResponse // Get list addresses
    {
        $addresses = Address::where('contact_id', $idContact)->get();
        return AddressResource::collection($addresses)->response()->setStatusCode(200);
    }

    public function get($idContact, $idAddress): JsonResponse // Get address
    {
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        return (new AddressResource($address))->response()->setStatusCode(200);
    }

    public function update(UpdateAddressRequest $request, $idContact, $idAddress): JsonResponse // Update address
    {
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        $data = $request->validated();
        $address->update($data);
        return (new AddressResource($address))->response()->setStatusCode(200);
    }

    public function delete($idContact, $idAddress): JsonResponse // Delete address
    {
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        $address->delete();
        return response()->json(["data" => true])->setStatusCode(200);
    }
}
