<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct list page
    public function listPage(){
        $categories = Category::when(request('search'),function($query){
                        $query->where('name','like','%'.request('search').'%');
                        })
                        ->orderBy('id','desc')
                        -> paginate(3);
        // $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    // direct home page //
    public function homePage(){
        return view('user.home');
    }

    // direct category create page //
    public function createPage(){
        return view('admin.category.create');
    }

    //create category //
    public function createCategory (Request $request){
        $this -> categoryValidationCheck($request);
        $data = $this -> requestCategoryData($request);
        Category::create($data);
        return redirect() -> route('category#listPage') -> with(['success' => 'Category create success.']);
    }

    // delete category //
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['success' => 'Category delete success..']);
    }

    // direct update Page //
    public function updatePage($id){
        $data = Category::where('id',$id)->first();
        return view('admin.category.update',compact('data'));
    }

    // update Category //
    public function updateCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this -> requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#listPage');
    }

    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required | unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
