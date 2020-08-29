<?php

use App\Models\setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        setting::setMany([
            'default_locale' => 'ar', 
            'default_timezone' => 'Africa/Cairo', 
            'reviews_enabled' => true, 
            'auto_approve_reviews' => true, 
            'supported_currencies' => ['USD', 'LE', 'SAR'],
            'default_currency' => 'USD', 
            'store_email' => 'admin@ecommerce.test', 
            'search_engine' =>'mysql',
            'local_shipping_cost' => 8, 
            'outer_shipping_cost' => 8, 
            'free_shipping_cost' => 8, 
            'translatable' => [ 
                'store_name' => 'Emamy Store', 
                'free_shipping_label' => 'Free Shipping', 
                'local_label' => 'Local shipping', 
                'outer_label' => 'outer shipping',
            ]
        ]);
        
    }
}
