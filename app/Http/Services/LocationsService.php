<?php

namespace App\Http\Services;

use App\Http\Repositories\LocationsRepository;
use App\Http\DTO\LocationsDTO;
use App\Models\Locations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationsService
{
    public function __construct(
        public LocationsRepository $locationsRepository
    ) {

    }

    public function createANewLocation(LocationsDTO $dto) : JsonResponse
    {
        if(!$this->locationsRepository->createLocation($dto)) {
            throw new \Exception('Error creating a location, try again.');
        }

        return new JsonResponse(['success' => 'Location created successfully']);
    }


    public function editALocation(Request $request, int $location_id) : JsonResponse
    {
        if(!$this->locationsRepository->editLocation($request, $location_id)) {
            throw new \Exception('Error editing this location, try again.');
        }

        return new JsonResponse(['success' => 'Location edited successfully']);
    }


    public function deleteALocation(int $location_id) : JsonResponse
    {
        if(!$this->locationsRepository->deleteLocaiton($location_id)) {
            throw new \Exception('Error deleting requested location, try again.');
        }

        return new JsonResponse(['success' => 'Location deleted successfully']);
    }


    public function getAllLocations() : JsonResponse
    {
        if(!$locations = $this->locationsRepository->getAllLocations()) {
            throw new \Exception('Error getting all locations, try again.');
        }

        return new JsonResponse(['success' => 'Locations getted successfully', 'total' => $locations->count(), 'data' => $locations]);
    }


    public function searchLocationByTerm(string|int $location_term) : JsonResponse
    {
        if(!$locations = $this->locationsRepository->serachLocationByTerm($location_term)) {
            throw new \Exception('Error getting locations based on your search, try again.');
        }

        return new JsonResponse(['success' => 'Locations getted successfully', 'total' => $locations->count(), 'data' => $locations]);
    }
}
