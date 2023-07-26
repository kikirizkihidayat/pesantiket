<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\units;
use App\Models\categories;
use App\Models\customers;
use App\Models\products;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // customers::factory(15)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // units::create([
        //     'code_unit' => 'm',
        //     'unit' => 'meter'
        // ]);
        // units::create([
        //     'code_unit' => 'pkt',
        //     'unit' => 'paket'
        // ]);
        // units::create([
        //     'code_unit' => 'unt',
        //     'unit' => 'unit'
        // ]);
        // units::create([
        //     'code_unit' => 'pcs',
        //     'unit' => 'picis'
        // ]);

        // categories::create([
        //     'code_category' => 'jl',
        //     'category' => 'jasa/layanan'
        // ]);
        // categories::create([
        //     'code_category' => 'net',
        //     'category' => 'networking'
        // ]);
        // products::create([
        //     'category_id' => '1',
        //     'unit_id' => '2',
        //     'code_product' => 'Wifi-60',
        //     'product' => 'Wifi 60 Mbps 30 hari',
        //     'stock' => 'Ready',
        //     'price' => '350000'
        // ]);
        // products::create([
        //     'category_id' => '2',
        //     'unit_id' => '3',
        //     'code_product' => 'RH-01',
        //     'product' => 'Router Huawei',
        //     'stock' => '5',
        //     'price' => '375000'
        // ]);
        // products::create([
        //     'category_id' => '2',
        //     'unit_id' => '3',
        //     'code_product' => 'AC-PL-01',
        //     'product' => 'Access Point TP-Link',
        //     'stock' => '8',
        //     'price' => '325000'
        // ]);
        // products::create([
        //     'category_id' => '2',
        //     'unit_id' => '4',
        //     'code_product' => 'RJ45-C6-B',
        //     'product' => 'RJ45 CATS6 BELDEN',
        //     'stock' => '48',
        //     'price' => '5000'
        // ]);
        products::create([
            'category_id' => '2',
            'unit_id' => '1',
            'code_product' => 'LAN-C6-B',
            'product' => 'KABEL LAN CAT6 BELDEN',
            'stock' => '48',
            'price' => '5000'
        ]);
    }
}
