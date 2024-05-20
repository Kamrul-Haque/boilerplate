<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'Buyonia Limited',
            'email' => 'info@buyoniasoft.com',
            'phone' => '+8809610001012',
            'mobile' => '+442085913534',
            'whatsapp' => '+447958079069',
            'copyright_text' => 'Copyright © Buyonia Limited. All Rights Reserved.',
            'description' => 'Buyonia Limited is a UK based software company owned and managed by a team of IT professionals and technocrats, who have local and global experience in business process exploration, automation and consultancy for ICT products measuring the present market demand. The team has the unique skills that assure outstanding performance through consistency, accuracy, reliability, punctuality and honesty. Buyonia Bangladesh Limited is a concern of Buyonia Limited.',
            'logo' => 'https://productimage.s3.eu-west-2.amazonaws.com/images/EW2A88JexFMTp3bs9qHrhsFKQQxWt4WkQNibvVw7.png',
            'favicon' => 'https://productimage.s3.eu-west-2.amazonaws.com/images/LeCagNaQmfHvGlGavdVsdLYsH0KYNs5w9Ztgug6a.png',
            'portal_logo' => 'https://productimage.s3.eu-west-2.amazonaws.com/images/LeCagNaQmfHvGlGavdVsdLYsH0KYNs5w9Ztgug6a.png',
            'primary_color' => '#111827',
            'secondary_color' => '#1f2937',
            'accent_color' => '#0033CC',
            'background_color' => '#F3F4F6',
            'table_stripe_color' => '#EAECF1',
        ]);
    }
}
