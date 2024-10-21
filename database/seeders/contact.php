<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class contact extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::create([
           'phone'   => '085546294372',
           'address' => 'Madiun',
           'email'   => 'katongalih6@gmail.com'
        ]);
    }



}
