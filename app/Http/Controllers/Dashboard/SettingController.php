<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function editShippingMethods($type){
        
        if($type === 'free'){
            $shipping_method = Setting::where('key', 'free_shipping_label')->first();
        }
        elseif($type === 'inner'){
            $shipping_method = Setting::where('key', 'local_label')->first();
        }
        elseif($type === 'outer'){
            $shipping_method = Setting::where('key', 'outer_label')->first();
        }
        else{
            $shipping_method = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('admin.settings.shippings.edit', compact('shipping_method'));
    }


    public function updateShippingMethods(Request $request, $id){

    }

}
