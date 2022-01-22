<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Service_feature;
use App\Models\Service;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

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

        // $user = User::create([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => $request->role,
        //     'is_staff' => $request->is_staff,
        //     'dob' => $request->dob,
        //     'location' => $request->location,
        //     'position' => $request->position
        // ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_staff' => $request->is_staff,
            'dob' => $request->dob,
            'location' => $request->location,
            'position' => $request->position
        ];

        $user = User::insertGetId($data);


        return redirect()->back()->with('status','User added Successful !');

    }

    public function change_password(Request $request){

        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        $message = 'Password changed';

        return redirect('/admin/profile')->with('message',$message);

    }

    public function view_staff(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();


        $data['users'] = User::join('roles','roles.role_id','users.role')
                            ->where('is_staff',1)
                            ->whereNotIn('role',[2])
                            ->get();

        return view('admin.view_staff')->with('data',$data);
    }

    public function view_staff_user(Request $request){
        $user_id = $request->id;

        $data['services_f'] = Service::where('active',1)->take(5)->get();

        $data["user"] = User::where('id',$user_id)->first();

        return view('admin.staff_details')->with('data',$data);
    }

    public function profile(Request $request){

        $data['services_f'] = Service::where('active',1)->take(5)->get();

        $data["user"] = User::where('id',Auth::user()->id)->first();

        return view('admin.profile_page')->with('data',$data);
    }

    public function edit_profile(Request $request){

        $data['services_f'] = Service::where('active',1)->take(5)->get();

        $data["user"] = User::where('id',Auth::user()->id)->first();

        return view('admin.edit_profile')->with('data',$data);
    }
}
