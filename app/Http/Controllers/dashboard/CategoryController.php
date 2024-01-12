<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function __construct(){
    //     $this->middleware('admin');
    // }
    protected $categoyemodel;

    public function __construct(Category $cate)
    {
        // $this->middleware('auth:admin');
        $this->categoyemodel = $cate;
    }

    public function index(){
        $category = Category::with(['supcategories'])->select('id','name', 'descr', 'slug', 'parent_id')->latest()->get();

        return view('backend.categories.index', compact('category'));
    }

    public function create(){
        $category = Category::where('parent_id',Null)->get();
        $this->authorize('create', Category::class);
        // dd($category);
        return view('backend.categories.create', compact('category'));
    }

    public function store(CategoryRequest $request) {
        Category::create([
            'name'      => $request->input('name'),
            'slug'      => strtolower(str_replace(' ', '-',$request->name)),
            'descr'     => $request->input('descr'),
            'parent_id' => $request->input('category'),
        ]);

        return redirect()->route('categories.main')
            ->with('success' , 'Successfuly added data');
    }

    public function edit($id){
        $this->authorize('update', Category::class);
        $categoryId = Category::findOrFail($id);
        $category = Category::select('id', 'name','parent_id')->where('parent_id', Null)->get();
        $categories = Category::with(['supcategories' , 'parent'])->where('parent_id','=',null)->get();
        // dd($categories);
        return view('backend.categories.edit', compact('category', 'categoryId', 'categories'));
    }
    public function update(CategoryRequest $request, $id) {
        $this->authorize('update', Category::class);
        $categoryId = Category::findOrFail($id);
        if($categoryId->parent_id){
            DB::table('categories')->where('id' , $id)->update([
                'parent_id' => $request->category,
            ]);
        }
        $categoryId->update([
            'name'      => $request->input('name'),
            'slug'      => strtolower(str_replace(' ', '-',$request->name)),
            'descr'     => $request->input('descr'),
        ]);

        return redirect()->route('categories.main')
            ->with('success' , 'Successfuly updated data');
    }

    public function destroy($id) {
        $this->authorize('update', Category::class);
        $categoryId = Category::findOrFail($id);
        $categoryId->delete();

        return redirect()->route('categories.main')
            ->with('success' , 'Successfuly updated data');
    }

    public function getSubCateAjax(Request $request){
        $cate_id = $request->cat_id;
        $getSubcategory = Category::with('supcategories')->where('parent_id',$cate_id)->get();
        // dd($getSubcategory);

        return $getSubcategory;
        // return response()->json([
        //     'getSubcategory' => $getSubcategory
        // ]);

    }

}
