<?php

use App\Model\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => "Site",
            'country' => 'Brasil, Bahia',
            'address' => 'Rua Qualquer',
            'contact_number' => '71 9999999999',
            'contact_email' => 'admin@admin.com.br',
            'disponible' => 'Seg-Sáb 6-21',
            'logo' => 'img/logo.png',
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' => 'instagram',
            'youtube' => 'youtube'
        ]);

    }
}
