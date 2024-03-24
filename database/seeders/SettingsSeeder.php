<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Models\Settings;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = Settings::where('label', 'main_label')->exists();
        if ($exists) return;
        $settings = 
            [
                'label' => 'main_label',
                'title' => 'Portfolio',
                'style' => 'normal',
                'font' => 'arial',
                'about' => 'About me....',
                'quote' => 'Some inspirational quote',
                'contact_address' => 'addres..',
                'contact_phone' => 'phone....',
                'contact_email' => 'email...',
                'contact_name' => 'name...'
            ];

        Settings::create($settings);
    }
}