<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
   //Direct admin list page
    public function adminList(){

        if(Session::has('ADMIN_SEARCH')){
            Session::forget('ADMIN_SEARCH');
        }

        $userData = User::where('role','admin')->paginate(7);
        return view('admin.user.adminList')->with(['admin'=>$userData]);
    }
    //Direct user list page
    public function userList(){

        if(Session::has('USER_SEARCH')){
            Session::forget('USER_SEARCH');
        }

        $userData = User::where('role','user')->paginate(7);
        return view('admin.user.userList')->with(['user'=>$userData]);
    }
     //Admin account search list
     public function adminSearch(Request $request){
        $key = $request->searchData;
    
        $searchData = User::where('role','admin')
                          ->where(function($query) use ($key){
                           $query->orwhere('name','like','%'.$key.'%')
                          ->orwhere('email','like','%'.$key.'%')
                          ->orwhere('phone','like','%'.$key.'%')
                          ->orwhere('address','like','%'.$key.'%');
                          })
                          ->paginate(7); 
        $searchData->appends($request->all());

        Session::put('ADMIN_SEARCH',$request->searchData);

        return view('admin.user.adminList')->with(['admin'=>$searchData]);
    }
    //User account search list
    public function userSearch(Request $request){
        $key = $request->searchData;

        $searchData = User::where('role','user')
                          ->where(function($query) use ($key){
                           $query->orwhere('name','like','%'.$key.'%')
                          ->orwhere('email','like','%'.$key.'%')
                          ->orwhere('phone','like','%'.$key.'%')
                          ->orwhere('address','like','%'.$key.'%');
                          })
                          ->paginate(7); 

        $searchData->appends($request->all());

        Session::put('USER_SEARCH',$request->searchData);

        return view('admin.user.userList')->with(['user'=>$searchData]);
    }
    //Delete user List
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Deleted']);
    }
     //Download adminList
     public function adminListDownload(Request $request){
          $key = $request->searchData;
          if(Session::has('ADMIN_SEARCH')){
            $admin = User::where('role','admin')
            ->where(function($query) use ($key){
             $query->orwhere('name','like','%'.Session::get('ADMIN_SEARCH').'%')
            ->orwhere('email','like','%'.Session::get('ADMIN_SEARCH').'%')
            ->orwhere('phone','like','%'.Session::get('ADMIN_SEARCH').'%')
            ->orwhere('address','like','%'.Session::get('ADMIN_SEARCH').'%');
            })
            ->get(); 
            }else{
          $admin = User::where('role','admin')->get();
            }

            $csvExporter = new\laracsv\Export();
    
            $csvExporter->build($admin, [  
                 'id' => 'No',
                 'name' => 'Admin Name',
                 'email' => 'Email',
                 'phone' => 'Phone Number',
                 'address' => 'Address',
            ]);
            $csvReader = $csvExporter->getReader();
    
            $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
    
            $filename = 'adminList.csv';
    
            return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
     }
     //Download userList
     public function userListDownload(Request $request){
         $key = $request->searchData;
          if(Session::has('USER_SEARCH')){
             $user= User::where('role','user')
                     ->where(function($query) use ($key){
                      $query->orwhere('name','like','%'.Session::get('USER_SEARCH').'%')
                     ->orwhere('email','like','%'.Session::get('USER_SEARCH').'%')
                     ->orwhere('phone','like','%'.Session::get('USER_SEARCH').'%')
                     ->orwhere('address','like','%'.Session::get('USER_SEARCH').'%');
                     })
                     ->get(); 
            }else{
          $user = User::where('role','user')->get();
            }

            $csvExporter = new\laracsv\Export();
    
            $csvExporter->build($user, [  
                'id' => 'No',
                'name' => 'Admin Name',
                'email' => 'Email',
                'phone' => 'Phone Number',
                'address' => 'Address',
            ]);
            $csvReader = $csvExporter->getReader();
    
            $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
    
            $filename = 'userList.csv';
    
            return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
     }
      
}
