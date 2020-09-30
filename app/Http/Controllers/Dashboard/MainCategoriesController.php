<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;


class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::parent() -> get();
        foreach ($categories as $key => $cat) {
            $cat['subcats'] = $cat -> subcats() -> get();
        }
        //return $categories;

        //$categories = Category::parent() -> get(); //-> paginate(PAGINATION_COUNT);
        //$categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function getSubs()
    {
        //$categories = Category::parent() -> get(); //-> paginate(PAGINATION_COUNT);
        $categories = Category::child() -> get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$name = $request->input('name', false);
        $categories = Category::parent() -> get();
        /*$cats_organized = [];
        $all_checked = [];
        foreach ($categories as $key => $value) {
            array_push($cats_organized, $value);
            $cats_organized[$key]['subs'] = [['name' => 'kareem'], ['name' => 'mohamed']];
        }
        return $cats_organized;*/
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoriesRequest $request)
    {
        // validation
        //return $request;
        // update db
        try {

            
            if(! $request->has('is_active')){
                $request['is_active'] = 0;
            }else{
                $request['is_active'] = 1;
            }

            if(! $request->follow == null){
                $request['parent_id'] = $request->follow;
            }
            
            DB::beginTransaction();
            
            $category = Category::create($request->except('_token', 'follow'));
            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('admin.maincategories')->with(['success' => __('admin\general.success')]);

        } catch (\Exception $ex) {
            
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);

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
        $category = Category::find($id);

        if(!$category){
            return redirect() -> route('admin.main_categories') -> with(['error' => __('admin\general.error')]);
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, MainCategoriesRequest $request)
    {
        // validation

        // update db
        try {

            if(! $request->has('is_active')){
                $request['is_active'] = 0;
            }else{
                $request['is_active'] = 1;
            }

            $category = Category::find($id);
            if(! $category)
                return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);

            
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.maincategories')->with(['success' => __('admin\general.success_edit')]);

        } catch (\Exception $ex) {
            
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);

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

            $category = Category::find($id);
            if(! $category)
                return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);
            
            $category->delete();
            return redirect()->route('admin.maincategories')->with(['success' => __('admin\general.success_delete')]);

        } catch (\Exception $ex) {
            
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\general.error')]);

        }
    }
}
