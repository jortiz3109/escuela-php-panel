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
                'code' => 'CC',
                'name' => 'Cédula de Ciudadanía',
            ],
            [
                'code' => 'RUT',
                'name' => 'Registro Único Tributario',
            ],
            [
                'code' => 'RUC',
                'name' => 'Registro Único de Contribuyente',
            ],
            [
                'code' => 'BN',
                'name' => 'Canadian business number',
            ],
            [
                'code' => 'SIN',
                'name' => 'Canadian social insurance number',
            ],
            [
                'code' => 'EIN',
                'name' => 'US Federal tax ID',
            ],
            [
                'code' => 'SSN',
                'name' => 'US social security number',
            ],
            [
                'code' => 'ABN',
                'name' => 'Australian business number',
            ],
            [
                'code' => 'CNPJ',
                'name' => 'Cadastro Nacional da Pessoa Jurídica',
            ],
            [
                'code' => 'CUIT',
                'name' => 'Clave Única de Identificación Tributaria',
            ],
            [
                'code' => 'RFC',
                'name' => 'Registro Federal de Contribuyente',
            ],
            [
                'code' => 'UEN',
                'name' => 'Unique Entity Number',
            ],
            [
                'code' => 'NZBN',
                'name' => 'New Zealand Business Number',
            ],
            [
                'code' => 'HKBR',
                'name' => 'Hong Kong Business Registration',
            ],
            [
                'code' => 'VAT',
                'name' => 'Value Added Tax Registration',
            ],
            [
                'code' => 'NIF',
                'name' => 'Número de Identificación Fiscal',
            ],
        ]);
    }
}
