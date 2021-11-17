<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('document_types')->insert([
            [
                'code' => 'ni',
                'name' => 'número de identificación tributaria (NIT)',
            ],
            [
                'code' => 'cc',
                'name' => 'cédula de ciudadanía',
            ],
            [
                'code' => 'ce',
                'name' => 'cédula de extranjería',
            ],
            [
                'code' => 'pa',
                'name' => 'pasaporte',
            ],
        ]);
    }
}
