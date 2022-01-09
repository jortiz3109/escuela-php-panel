<?php

namespace Database\Seeders;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    private const INSERT_CHUNK_SIZE = 50;

    public function run(): void
    {
        $currencies = collect(
            json_decode(file_get_contents(__DIR__ . '/../../resources/data_sources/currencies.json'), true)
        )->map(function ($item) {
            return $item + ['enabled_at' => Carbon::now()->format('Y-m-d')];
        });

        foreach ($currencies->chunk(self::INSERT_CHUNK_SIZE) as $chunk) {
            Currency::insert($chunk->toArray());
        }
    }
}
