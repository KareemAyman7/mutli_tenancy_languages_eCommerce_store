<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsRequest;
use App\Http\Requests\TagsRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC') -> paginate(PAGINATION_COUNT);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        // validation
        //return $request;
        // update db
        try {
            
            DB::beginTransaction();

            $brand = Tag::create($request->except('_token'));
            $brand->name = $request->name;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.tags')->with(['success' => __('admin\general.success')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => __('admin\general.error')]);

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
        $tag = Tag::find($id);

        if(!$tag){
            return redirect() -> route('admin.tags') -> with(['error' => __('admin\general.error')]);
        }

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, TagsRequest $request)
    {
        // validation

        // update db
        try {

            $tag = Tag::find($id);
            if(! $tag)
                return redirect()->route('admin.tags')->with(['error' => __('admin\general.error')]);

            
            DB::beginTransaction();
            
            $tag->update($request->except('_token', 'id'));
            // save translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();

            return redirect()->route('admin.tags')->with(['success' => __('admin\general.success_edit')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => __('admin\general.error')]);

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

            $tag = Tag::find($id);
            if(! $tag)
                return redirect()->route('admin.tags')->with(['error' => __('admin\general.error')]);
            
            $tag->delete();
            return redirect()->route('admin.tags')->with(['success' => __('admin\general.success_delete')]);

        } catch (\Exception $ex) {
            
            return redirect()->route('admin.tags')->with(['error' => __('admin\general.error')]);

        }
    }
    
}
