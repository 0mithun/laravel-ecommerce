<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * @var array
     */

     protected $settings = [
        [
            'key'                  =>  'site_name',
            'value'                =>  'E-commerce Application'
        ],
        [
            'key'                  =>  'site_title',
            'value'                =>  'E-Commerce'
        ],
        [
            'key'                  =>  'default_email_address',
            'value'                =>  'admin@admin.com'
        ],
        
        [
            'key'                  =>  'currency_code',
            'value'                =>  'USD'
        ],
        [
            'key'                  =>  'currency_symbol',
            'value'                =>  '$'
        ],
        [
            'key'                  =>  'site_logo',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'site_favicon',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'footer_copyright_text',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'seo_meta_title',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'seo_meta_description',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'social_facebook',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'social_twitter',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'social_instagram',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'social_linkedin',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'google_analytics',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'facebook_pixels',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'stripe_payment_method',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'stripe_key',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'stripe_secret_key',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'paypal_payment_method',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'paypal_client_id',
            'value'                =>  ''
        ],
        [
            'key'                  =>  'paypal_client_secret',
            'value'                =>  ''
        ],
        
     ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->settings as $key => $setting){
            $result = Setting::create($setting);

            if(!$result){
                $this->command->info("Insert failed at record {$key}");
                return;
            }
        }

        $this->command->info("Inserted ".count($this->settings)." records");
    }
}
