<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserInfo;
use Session;
use Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
       
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }
    
     
        $userId = Session::get('user_id');
    
      
        $user = Users::find($userId);
    
      
        $userInfo = UserInfo::where('uid', $userId)->first(); 
    
      
        if ($user && $userInfo) {
            return view('profile', [
                'user' => $user,
                'userInfo' => $userInfo
            ]);
        }
    }
    
    public function edit()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        $userId = Session::get('user_id');

        $user = Users::find($userId);
        $userInfo = UserInfo::where('uid', $userId)->first();

        if (!$user || !$userInfo) {
            return redirect()->route('login');
        }

        return view('edit', compact('user', 'userInfo'));
    }

  
    public function update(Request $request)
    {
        
        if (!Session::has('user_id')) {
            
            return redirect()->route('login');
        }
    
    
        $userId = Session::get('user_id');
    
      
        $user = Users::find($userId);
        $userInfo = UserInfo::where('uid', $userId)->first();
    
      
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:male,female,other',
            'dob' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
    
       
        $userInfo->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);
    
        
        if ($request->hasFile('image')) {
          
            if ($userInfo->image) {
                Storage::delete('public/' . $userInfo->image);
            }
    
          
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $userInfo->update(['image' => $imagePath]);
        }
    
       
        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
    

    
}
