<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(){
        $admin = Admin::find(auth('admin')->user()->id);
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(ProfileRequest $request){
        
        // validation

        // update db
        try {

            $admin = Admin::find(auth('admin')->user()->id);
            $admin->update($request->only(['name', 'email']));
        
            return redirect()->back()->with(['success' => __('admin\general.success')]);

        } catch (\Exception $ex) {
            
            return redirect()->back()->with(['error' => __('admin\general.error')]);

        }

    }
    
    public function updatePassword(ProfilePasswordRequest $request){
        
        // validation

        // update db
        try {

            $admin = Admin::find(auth('admin')->user()->id);
            
            $admin->password = bcrypt($request->new_pass_input);
            $admin->save();
            return redirect()->back()->with(['success' => __('admin\general.success')]);
        

        } catch (\Exception $ex) {
            
            return redirect()->back()->with(['error' => __('admin\general.error')]);

        }

    }


}
