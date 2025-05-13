<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function tampil(Request $request){
        $user = User::where('role', '!=', 'admin')->get();
        $allUser = User::where('role', 'user')->count();
        $pageTitle = 'Users'; 

        $search = $request->input('search');

        $sortColumn = $request->input('sortColumn', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');

        $userQuery = User::where('role', '!=', 'admin');

        if($search){
            $userQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like' ,'%' . $search . '%');
            });
        }

        $userQuery->orderBy($sortColumn, $sortDirection);

        $user = $userQuery->paginate(5);

        return view('admin.users.tampil',  compact('user', 'pageTitle', 'allUser', 'sortDirection', 'sortColumn'));
    }

    function tambah(){
        $pageTitle = 'Users';
        return view('admin.users.tambah', compact('pageTitle'));
    }

    function submit(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:5', 
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = ''; 
    
        
        $user-> save();

        return redirect()->route('admin.users.tampil');
    }

    function edit($id){
        $user = User::find($id);
        $pageTitle = 'Users';
        return view('admin.users.edit', compact('user', 'pageTitle'));
    }

    function update(Request $request, $id){
        $user = User::find($id);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = $request->has('is_active'); // Menggunakan has() untuk memeriksa checkbox
         
        $user-> update();

        return redirect()->route('admin.users.tampil');
    }

    function hapus($id){
        $user = User::find($id);
        $user -> delete();
        return redirect()->route('admin.users.tampil');
    }
}
