<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request=request();
        // $query=Category::query();// this return query builder

        // if($name=$request->query('name')){
        //     $query->where('name','LIKE',"%{$name}%");
        // }


        // if($status=$request->query('status')){
        //     $query->where('status',"$status");
        // }

        // if($status=$request->query('status')){
        //     $query->whereStatus($status);
        // }


        // $categories=Category::paginate(1);// Return Collection object
        // $categories=$query->paginate(1);// Return Collection object

        $categories=Category::leftjoin('categories as parents','parents.id','=','categories.parent_id')
                ->select([
                    'categories.*',
                    'parents.name as parent_name',
                ])
                // ->selectRaw('(select count(*) from products where category_id=categories.id) as products_count')
                // ->withCount('products as products_count')// optional alias
                ->withCount(['products as products_count'=>function($query){
                    $query->where('status','active');
                }])
            ->orderby('categories.name')
            ->Filter($request->all())->paginate(2);
       return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Category::all();
        $category=new Category();
       return view('admin.categories.create',compact(['parents','category']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->input('name');// get value from get or post
        // $request->post('name'); // get value only from post
        // $request->query('name'); // get value only from get
        // $request->get('name'); // get value only from get
        // $request->name; // get value only from get
        // $request['name'];
        // $request->all();// get all data
        // $request->only(['name','parent_id']);// get only this
        // $request->except(['image']);// get excebt this
        // $category =new Category();
        // $category->name=$request->post('name');
        // $category->parent_id=$request->post('parent_id');

        // $category =new Category([
            //     'name'=>$request->name,
            //     'parent_id'=>$request->parent_id,
            // ]);
        // $category =new Category($request->all());
        //  $category->save();


        $request->validate([
            'name'=>['required','string','min:4','max:10',
            // 'Unique:categories,name,$id'
            Rule::unique('categories','name')// ->ignore($id)// id for update
            ],
            'parent_id'=>['nullable','int','exists:categories,id'],
            'image'=>['image','max:1048576'],//,'dimensions:width=1000,height=1000'
            'status'=>'required|in:active,inactive'
        ],[
            'required'=>'this filed (:attribute) is required',// this for all fields
            'status.required'=>'this filed (:attribute) is required' // this for only this field
        ]);
        // Request merge to add another field not the request to the request
          $request->merge(['slug'=>Str::slug($request->post('name'))]);

        $data=$request->except('image');
        $data['image'] = $this->uploadFile($request);


        // Mass assignment
         $category=Category::create($data);

         //---You Have TO Do [PRG]  Means Post Redirect Get
        //  return Redirect::route('categories.index');
         return redirect()->route('admin.categories.index')
                        ->with('success','Category Created');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrfail($id);
        $parents=Category::where('id','<>',$id)
                            ->where(function($query)use ($id){
                                $query->whereNull('parent_id')
                                    ->orWhere('parent_id','<>',$id);
                            })->get();
        // dd($parents);
        return view('admin.categories.edit',compact(['category','parents']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category=Category::findOrFail($id);

        $request->merge(['slug'=>Str::slug($request->post('name'))]);

        $oldImage=$category->image;
        $data=$request->except('image');
        $new_image = $this->uploadFile($request);
        if ($new_image) {
            $data['image']=$new_image;
        }

        $category->update($data);
        // $category::fill($request->all())->save();
        if($oldImage && $new_image){
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('admin.categories.index')
                        ->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $category=Category::findOrFail($id);
        // $category->delete();
        Category::destroy($id);

        return redirect()->route('admin.categories.index')
        ->with('success','Category Deleted');
    }


    public function trash()
    {
        $categories=Category::onlyTrashed()->paginate();
        return view('admin.categories.trash',compact('categories'));
    }



    public function restor($id)
    {
        $categorie=Category::onlyTrashed()->findOrFail($id);
        $categorie->restor();
        return redirect()->route('admin.categories.trash')
        ->with('success','Category Restores');
    }


    public function forceDelete($id)
    {
        $categorie=Category::onlyTrashed()->findOrFail($id);
        $categorie->forceDelete();
        if($categorie){
            Storage::disk('public')->delete($categorie->oldImage);
        }
        return redirect()->route('admin.categories.trash')
        ->with('success','Category Deleted Permenantly');
    }



    public function uploadFile($request)
    {
        if (!$request->hasFile('image')) {
         return ;
        }

        $file= $request->file('image');
        $path = $file->store('uploads',['disk'=>'public']);
        return $path;
    }
}
