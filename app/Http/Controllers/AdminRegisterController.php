<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service_feature;
use App\Models\Service;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    //

    protected function create()
    {
        $data['services_f'] = Service::where('active',1)->take(5)->get();


        $data['roles'] = Role::all();

        return view('admin.add_staff')->with('data',$data);

    }

    public function store(Request $request)
    {
        // Validate and store the User data...
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_staff' => $request->is_staff,
        ]);


        return redirect()->back()->with('status','User added Successful !');

    }

    public function view_staff(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();


        $data['users'] = User::join('roles','roles.role_id','users.role')
                            ->where('is_staff',1)
                            ->whereNotIn('role',[2])
                            ->get();

        return view('admin.view_staff')->with('data',$data);
    }
}
