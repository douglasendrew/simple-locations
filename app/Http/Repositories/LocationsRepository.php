<?php

namespace App\Http\Repositories;

use Illuminate\Http\JsonResponse;
use App\Http\DTO\LocationsDTO;
use App\Models\Locations;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class LocationsRepository
{
    public function createLocation(LocationsDTO $dto) : Locations
    {
        return Locations::create([
            'name' => $dto->name,
            'slug' => $dto->slug,
            'city' => $dto->city,
            'state' => $dto->state,
        ]);
    }

    public function editLocation(Request $request, int $location_id) : bool
    {
        return Locations::where('id', $location_id)->update($request->all());
    }

    public function deleteLocaiton(int $locaiton_id) : bool
    {
        return Locations::where('id', $locaiton_id)->delete();
    }

    public function getAllLocations() : Collection
    {
        return Locations::get();
    }

    public function serachLocationByTerm(string|int $location_term) : Collection
    {
        return Locations::where('id', "LIKE", "%$location_term%")
            ->orWhere('name', "LIKE", "%$location_term%", 'COLLATE utf8_general_ci')
            ->orWhere('slug', "LIKE", "%$location_term%", 'COLLATE utf8_general_ci')
            ->orWhere('city', "LIKE", "%$location_term%", 'COLLATE utf8_general_ci')
            ->orWhere('state', "LIKE", "%$location_term%", 'COLLATE utf8_general_ci')
            ->get();
    }
}
