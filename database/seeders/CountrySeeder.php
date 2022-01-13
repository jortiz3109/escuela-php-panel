<?php

namespace Database\Seeders;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    private const INSERT_CHUNK_SIZE = 50;

    public function run(): void
    {
        $countries = collect(
            json_decode(file_get_contents(__DIR__ . '/../../resources/data_sources/countries.json'), true)
        )->map(function ($item) {
            return $item + ['enabled_at' => Carbon::now()->format('Y-m-d')];
        });

        foreach ($countries->chunk(self::INSERT_CHUNK_SIZE) as $chunk) {
            Country::insert($chunk->toArray());
        }
    }
}
