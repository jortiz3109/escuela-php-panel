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
                'validator_pattern' => '/^[1-9][0-9]{4,9}$/',
            ],
            [
                'code' => 'RUT',
                'name' => 'Registro Único Tributario',
                'validator_pattern' => '/^[1-9][0-9]{4,8}(\-[0-9])?$/',
            ],
            [
                'code' => 'RUC',
                'name' => 'Registro Único de Contribuyente',
                'validator_pattern' => '/^\d{13,14}$/',
            ],
            [
                'code' => 'BN',
                'name' => 'Canadian business number',
                'validator_pattern' => '/^\d{9}\w{5}$/',
            ],
            [
                'code' => 'SIN',
                'name' => 'Canadian social insurance number',
                'validator_pattern' => '/^\d{9}$/',
            ],
            [
                'code' => 'EIN',
                'name' => 'US Federal tax ID',
                'validator_pattern' => '/^\d{9}$/',
            ],
            [
                'code' => 'SSN',
                'name' => 'US social security number',
                'validator_pattern' => '/^\d{9}$/',
            ],
            [
                'code' => 'ABN',
                'name' => 'Australian business number',
                'validator_pattern' => '/^\d{11}$/',
            ],
            [
                'code' => 'CNPJ',
                'name' => 'Cadastro Nacional da Pessoa Jurídica',
                'validator_pattern' => '/^\w{14}$/',
            ],
            [
                'code' => 'CUIT',
                'name' => 'Clave Única de Identificación Tributaria',
                'validator_pattern' => '/^\d{11}$/',
            ],
            [
                'code' => 'RFC',
                'name' => 'Registro Federal de Contribuyente',
                'validator_pattern' => '/^\w{12,13}$/',
            ],
            [
                'code' => 'UEN',
                'name' => 'Unique Entity Number',
                'validator_pattern' => '/^\w{9,10}$/',
            ],
            [
                'code' => 'NZBN',
                'name' => 'New Zealand Business Number',
                'validator_pattern' => '/^\d{13}$/',
            ],
            [
                'code' => 'HKBR',
                'name' => 'Hong Kong Business Registration',
                'validator_pattern' => '/^\d{11}$/',
            ],
            [
                'code' => 'VAT',
                'name' => 'Value Added Tax Registration',
                'validator_pattern' => '/^\d{10}$/',
            ],
            [
                'code' => 'NIF',
                'name' => 'Número de Identificación Fiscal',
                'validator_pattern' => '/^(\d{7,8})([A-HJ-NP-TV-Z])$/',
            ],
        ]);
    }
}
