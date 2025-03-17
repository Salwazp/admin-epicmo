<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'      => 'Development',
            'email'     => 'admin@development.com',
            'password'  => bcrypt('admin123')
        ]);

    }
}
