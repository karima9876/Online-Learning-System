<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function addCategory(){
        if (is_null($this->user) ||  !$this->user->can('addcategory')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        
        return view('category.addcategory');
    }
    //----store data----
    public function storeCategory(Request $request){
        if (is_null($this->user) ||  !$this->user->can('category.store')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'categoryname'=>'required',

        ],[
            'categoryname.required'=>'please input your category name',
            
        ]);
        Category::insert([
            'categoryname'=>$request->categoryname,
        ]);
        // return redirect()->back()->with('success_message','Successfully Data Added');
        
        return redirect()->to('categoryList')->with('success_message','Successfully Data Added');
 
    }
    //-----------category edit------
    public function editCategory($id){
        if (is_null($this->user) ||  !$this->user->can('category.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $category=Category::findOrFail($id);
        return view('category.categoryedit',compact('category'));
    }
    //-----update category-----
    public function updateCategory(Request $request,$id){
        if (is_null($this->user) ||  !$this->user->can('category.update')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        Category::findOrFail($id)->update([
            'categoryname'=>$request->categoryname,

        ]);

        return redirect()->route('categoryList')->with('update','Successfully Data Update');
        
        // return redirect()->to('categoryList')->with('update','Successfully Data Update');
        return redirect()->back()->with('update','Successfully Data Updated');
        

    }

    public function categoryList(){

        $categories =Category::orderBy('id','DESC')->get();  
        return view('category.categorylist',compact('categories'));
    }
    //----category destroy-----
    public function deleteCategory($id){
        if (is_null($this->user) ||  !$this->user->can('category.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }

}
