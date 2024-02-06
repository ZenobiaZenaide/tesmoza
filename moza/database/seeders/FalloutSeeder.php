<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Fallout;

class FalloutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fallout')->insert([
            'order_id' => '131313131',
            'status_message' => 'Provisioning Failed|UIM|IN170673571|1030:No Physical Port available with Name : 1/0/6/8',
            'sto' => 'JKT',
            'tanggal_fallout' => '12/12/20',
            'pic' => 'Ahmad Ibnu',
            'status' => 'PS (Completed)',
            'ket' => '1234',
        ]);
    }
}
