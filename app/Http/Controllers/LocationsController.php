<?php
namespace App\Http\Controllers;

use App\Http\DTO\LocationsDTO;
use App\Http\Services\LocationsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationsController extends Controller
{
    public function __construct(
        public LocationsService $locationsService
    ) {
    }


    /**
     * Edit Location
     *
     * Edit a location based on informations of request
     * @param Request $request
     * @param int $location_id
     * @return JsonResponse
     *
     * @urlParam location_id integer required ID do local que deseja editar. Example: 3
     * @bodyParam name string required Nome do local desejado. Example: Bairro da Cidade
     * @bodyParam slug string required Slug que deseja atribuir a esse local. Example: praca-da-cidade
     * @bodyParam city string required Cidade em que o local está. Example: São Paulo
     * @bodyParam state string required Estado em que o local está localizado. Example: São Paulo
     */
    public function editLocation(Request $request, int $location_id) : JsonResponse
    {
        try {
            return $this->locationsService->editALocation($request, $location_id);
        } catch ( Exception $e ) {
            return new JsonResponse(['errors' => $e->getMessage()], 500);
        }
    }


    /**
     * Create Location
     *
     * Create a new location based on informations of request
     * @param Request $request
     * @return JsonResponse
     *
     * @bodyParam name string required Nome do local desejado. Example: Praça da Cidade
     * @bodyParam slug string required Slug que deseja atribuir a esse local. Example: praca-da-cidade
     * @bodyParam city string required Cidade em que o local está. Example: Biriui
     * @bodyParam state string required Estado em que o local está localizado. Example: São Paulo
     */
    public function createLocation(Request $request) : JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:locations',
                'city' => 'required',
                'state' => 'required'
            ]);

            $dto = LocationsDTO::from([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'city' => $request->city,
                'state' => $request->state
            ]);

            return $this->locationsService->createANewLocation($dto);

        } catch ( Exception $e ) {
            return new JsonResponse(['errors' => $e->getMessage()], 500);
        }
    }


    /**
     * Delete Location
     *
     * Delete a specific location information on param
     *
     * @param int $location_id
     * @return JsonResponse
     *
     * @urlParam location_id int required ID do local que deseja deletar. Example: 1
     */
    public function deleteLocation(int $location_id) : JsonResponse
    {
        try {
            return $this->locationsService->deleteALocation($location_id);
        } catch ( Exception $e ) {
            return new JsonResponse(['errors' => $e->getMessage()], 500);
        }
    }


    /**
     * Get All locations
     * @param int $location_id
     * @return JsonResponse
     */
    public function allLocations() : JsonResponse
    {
        try {
            return $this->locationsService->getAllLocations();
        } catch ( Exception $e ) {
            return new JsonResponse(['errors' => $e->getMessage()], 500);
        }
    }


    /**
     * Search Location
     *
     * Get locations based on serach term informed on param
     * @param string|int $location_term
     * @return JsonResponse
     *
     * @urlParam location_term string required Termo que deseja pesquisa dentre todos locais cadastrados. Example: Praça
     */
    public function searchLocation(string|int $location_term) : JsonResponse
    {
        try {
            return $this->locationsService->searchLocationByTerm($location_term);
        } catch ( Exception $e ) {
            return new JsonResponse(['errors' => $e->getMessage()], 500);
        }
    }
}
