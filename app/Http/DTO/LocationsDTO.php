<?php
namespace App\Http\DTO;

use Spatie\LaravelData\Data;

class LocationsDTO extends Data {

    public function __construct(
        public string $name,
        public string $slug,
        public string $city,
        public string $state
    ) {
    }
    
}
