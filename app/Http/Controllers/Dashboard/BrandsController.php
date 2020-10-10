<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandsRequest $request)
    {
        // validation
        //return $request;
        // update db
        try {
            
            DB::beginTransaction();
            
            if(! $request->has('is_active')){
                $request['is_active'] = 0;
            }else{
                $request['is_active'] = 1;
            }

            $fileName = '';
            if($request->has('photo')){
                $fileName = uploadImage('brands', $request -> photo);
            }

            $brand = Brand::create($request->except('_token', 'photo'));
            $brand->photo = $fileName;
            $brand->name = $request->name;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.brands')->with(['success' => __('admin\general.success')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin\general.error')]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);

        if(!$brand){
            return redirect() -> route('admin.brands') -> with(['error' => __('admin\general.error')]);
        }

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, BrandsRequest $request)
    {
        // validation

        // update db
        try {

            if(! $request->has('is_active')){
                $request['is_active'] = 0;
            }else{
                $request['is_active'] = 1;
            }

            $brand = Brand::find($id);
            if(! $brand)
                return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);

            
            DB::beginTransaction();

            if($request->has('photo')){
                $fileName = uploadImage('brands', $request -> photo);

                $photoName = explode('/', $brand->photo);
                Storage::disk('brands') -> delete($photoName);

                Brand::where('id', $id) -> update([
                    'photo' => $fileName
                ]);
            }
            
            $brand->update($request->except('_token', 'photo', 'id'));
            // save translations
            $brand->name = $request->name;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.brands')->with(['success' => __('admin\general.success_edit')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin\general.error')]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $brand = Brand::find($id);
            if(! $brand)
                return redirect()->route('admin.brands')->with(['error' => __('admin\general.error')]);
            
            $brand->delete();
            return redirect()->route('admin.brands')->with(['success' => __('admin\general.success_delete')]);

        } catch (\Exception $ex) {
            
            return redirect()->route('admin.brands')->with(['error' => __('admin\general.error')]);

        }
    }
    
}
