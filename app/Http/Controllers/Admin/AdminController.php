<?php

namespace App\Http\Controllers\Admin;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
     //Direct admin profile
     public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }
    //Direct login page
    public function login(){
        return view('auth.login');
    }
    //Update profile
    public function updateProfile($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData = $this->requestUserData($request);
        User::where('id',$id)->update($updateData);
        return back()->with(['updateSuccess'=>'User Information Updated!']);
    }
    // Change password
    public function changePassword($id,Request $request){
     //validation
     $validator = Validator::make($request->all(), [
        'oldPassword' => 'required',
        'newPassword' => 'required',
        'confirmPassword' => 'required',
    ]);
    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
   }
     $data = User::where('id',$id)->first();

     $oldPassword = $request->oldPassword ;
     $newPassword = $request->newPassword ;
     $confirmPassword = $request->confirmPassword ;
     $hashedPassword = $data['password'];

     if (Hash::check($oldPassword,$hashedPassword)){ //db same password
        if($newPassword != $confirmPassword){        //new password != confirm password
            return back()->with(['notSameError'=>'Confimation Password Not Match! Try Again..']);
        }else{
            if(strlen($newPassword) <=6 || strlen($confirmPassword) <=6){ // if less than & equal 6
                return back()->with(['lengthError'=>'Password must be greater than 6..']);
            }else{
                $hash = Hash::make($newPassword);  //convert password
                User::where('id',$id)->update([    //update password to database
                    'password' => $hash
                ]);
                return redirect()->route('admin#login')->with(['success'=>'Your Password has changed Success!..']);
                //return back()->with(['success'=>'Password Change Success!..']);
            }
        }
     }else{
        return back()->with(['notMatchError'=>'Password Do Not Match! Try Again..']);
        }
  }
    // Change password Page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }
    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}
