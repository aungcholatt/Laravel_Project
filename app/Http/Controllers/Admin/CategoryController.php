<?php

namespace App\Http\Controllers\Admin;

use App\Models\user;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
     //Direct Add category page
     public function addCategory(){
        return view('admin.category.addCategory');
    } 
     public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'category_name' => $request->name       
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with(['categorySuccess'=>'Category Added...']);
    }
    //Direct category page
    public function category(){
        $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count'))
                ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                ->groupBy('categories.category_id')
                ->paginate(7);
        return view('admin.category.list')->with(['category'=>$data]);
    } 
    //Delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted!']);
    }
    //Edit category
    public function editCategory($id){
        $data = Category::where('category_id',$id)->first();
        return view('admin.category.update')->with(['category'=>$data]);
    }
    //updateCategory
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
         $updateData = [
            'category_name' => $request->name
         ];
         Category::where('category_id',$request->id)->update($updateData);
         return redirect()->route('admin#category')->with(['updateSuccess'=>'Category Updated!']);
    }
     
    //Search category
    public function searchCategory(Request $request){
        $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count'))
        ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
        ->where('categories.category_name','like','%'.$request->searchData.'%')
        ->groupBy('categories.category_id')
        ->paginate(7);
        
    Session::put('CATEGORY_SEARCH',$request->searchData);
         
        $data->appends($request->all());
         return view('admin.category.list')->with(['category'=>$data]);
    }

    //Category Download
    public function categoryDownload(){
    
     if(Session::has('CATEGORY_SEARCH')){
        //have session download
        $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count'))
              ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
              ->where('categories.category_name','like','%'.Session::get('CATEGORY_SEARCH').'%')
              ->groupBy('categories.category_id')
              ->get();
        }else{
        //no have session download
        $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count')) 
                ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                ->groupBy('categories.category_id')
                ->get();
        }
    
        $csvExporter = new\laracsv\Export();

        $csvExporter->build($category, [  
             'category_id' => 'ID',
             'category_name' => 'Name',
             'count' => 'Product Count',
             'created_at' => 'Created Date',
             'updated_at' => 'Updated Date',
        ]);
        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'categoryList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
   }

}
