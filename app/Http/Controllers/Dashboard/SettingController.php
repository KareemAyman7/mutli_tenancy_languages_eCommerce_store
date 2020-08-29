<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\shippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;

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


    public function updateShippingMethods(shippingsRequest $request, $id){
        
        // validation

        // update db
        try {

            $shipping_method = Setting::find($id);
        
            DB::beginTransaction();
            $shipping_method->update(["plain_value" => $request->plain_value]);

            // save translation
            //$shipping_method->translation('en')->value = $request->value;
            $shipping_method->value = $request->value;
            $shipping_method->save();
            
            DB::commit();
            return redirect()->back()->with(['success' => __('admin\general.success')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin\general.error')]);

        }


    }

}
