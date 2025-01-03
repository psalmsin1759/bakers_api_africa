<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function addCategory(Request $request){
        
        $parent = $request->parent;
        $name = $request->name;
        $sortorder = $request->sortorder;

        $category = Category::create([
            "parent_id" => $parent,
            "name" => $name,
            "sort_order" => $sortorder
        ]);

        return redirect ("/category");

    }

    public function editCategory(Request $request){

        $editcategoryid = $request->editcategoryid;
        $name = $request->editcategoryname;
        $editsortorder = $request->editsortorder;

        $category = Category::find($editcategoryid);

        $category->name = $name;
        $category->sort_order = $editsortorder;  

        $category->save();

        return redirect("category");

    }

    public function deleteCategory(Request $request)
    {
        $id = $request->id;

        // Find the category by ID
        $category = Category::find($id);

        if (!$category) {
            return redirect("/category")->with('error', 'Category not found');
        }

        // Recursively delete child categories
        $this->deleteChildren($category);

        // Delete the parent category
        $category->delete();

        return redirect("/category")->with('success', 'Category and its children deleted successfully');
    }

    private function deleteChildren($category)
    {
        $children = Category::where('parent_id', $category->id)->get();

        foreach ($children as $child) {
            $this->deleteChildren($child); // Delete each child recursively
            $child->delete(); // Delete the child after its children are deleted
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy("sort_order", "asc")->get();

        return response()->json([
            'success'   => true,
            'message'   => "success",
            "data" => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return response()->json([
            'success'   => true,
            'message'   => "success",
            "data" => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, String $id)
    {
        $data = $request->validated();

        $category = Category::find($id);
        $category->name = $data["name"];
        $category->sort_order =  $data["sort_order"];
        $category->save();

        return response()->json([
            'success'   => true,
            'message'   => "success",
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return redirect ("/category");
    }
}
