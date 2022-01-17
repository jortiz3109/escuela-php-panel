<?php

namespace App\Location;

use App\Exceptions\LocationException;
use Illuminate\Support\Facades\Http;

class Location
{
    private string $route;

    private string $apiKey;

    public function __construct(array $config)
    {
        $this->route = $config['route'];
        $this->apiKey = $config['apiKey'];
    }

    /**
     * @throws LocationException
     */
    public function getLocation(string $ip): array
    {
        $request = $this->route . $ip . '?access_key=' . $this->apiKey;
        $response = Http::get($request);
        $data = json_decode($response->body());

        if (isset($data->error)) {
            throw new LocationException($data->error->info);
        }

        return [
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
        ];
    }
}
