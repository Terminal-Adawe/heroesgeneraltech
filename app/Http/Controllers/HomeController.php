<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Service_feature;
use App\Models\Service_stage;
use App\Models\User;
use App\Models\Customer_project;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin_index()
    {
        $data['services_f'] = Service::where('active',1)->take(3)->get();

        $data['count'] = DB::table('users')
                            ->where('is_staff','!=','1')
                            ->select(DB::raw('COUNT(users.id) as number_of_users'))
                            ->first();

        return view('admin.index')->with('data',$data);
    }

    public function add_service(Request $request){
        $service_name = $request->service_name;
        $service_description = $request->service_description;

        $data = ['service_name'=>$service_name, 'service_description'=>$service_description];

        Service::insert($data);

        return redirect('/services');
    }

    public function request_service(Request $request){
        $service_id = $request->service_id;
        $customer_comment = $request->comment;

        $stage = 'pending';

        $data = ['service_id'=>$service_id, 'customer_comments'=>$customer_comment,'created_by'=>Auth::user()->id];

        Customer_project::insert($data);

        return redirect('/customer');
    }

    public function edit_service($service_id){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        $where = [['service_id',$service_id],['active',1]];
        $data['service_details'] = Service::where($where)->first();

        $data['action'] = 'edit';

        return view('admin.service_details_page')->with('data',$data);
    }

    public function view_service($service_id){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        $where = [['service_id',$service_id],['active',1]];
        $data['service_details'] = Service::where($where)->first();

        $data['features'] = Service_feature::where('service_id',$service_id)->get();

        $data['stages'] = Service_stage::where('service_id',$service_id)->get();

        $data['action'] = 'view';

        return view('admin.service_details_page')->with('data',$data);
    }



    public function get_features(Request $request){
        $data['features'] = Service_feature::all();

        return $data;
    }

    public function get_customers(Request $request){

        $data['customers'] = User::leftJoin('customer_projects','customer_projects.created_by','=','users.id')
                                ->where('is_staff',0)->get();

        return $data;
    }

    public function get_customer_projects(Request $request){
        $data['customers'] = User::leftJoin('customer_projects','customer_projects.created_by','=','users.id')
                                ->where('is_staff',0)->get();

        return $data;
    }

    public function add_feature(Request $request){
        $featureName = $request->featureName;
        $featureDescription = $request->featureDescription;
        $serviceID = $request->serviceID;

        $insertData = ['service_ID'=>$serviceID, 'service_feature_name'=>$featureName, 'service_feature_description'=>$featureDescription];

        $insert = Service_feature::insert($insertData);

        $data['features'] = Service_feature::all();

        return $data;
    }

    public function delete_service(Request $request){
        $id = $request->id_;
        $type = $request->type;
        $service_id = $request->sid;
        $view = '/services';

        if($type=='service'){
            Service::where('service_id',$service_id)->delete();
            $view = '/services';
        } else if ($type=='feature'){
            Service_feature::where([['service_id',$service_id],['service_feature_id',$id]])->delete();
            
            $view = '/edit-service/'.$service_id;
        } else if ($type=='stage'){
            Service_stage::where([['service_id',$service_id],['service_stage_id',$id]])->delete();
            
            $view = '/edit-service/'.$service_id;
        }

        return redirect($view);
    }


    // Stages
    public function get_stages(Request $request){
        $data['stages'] = Service_stage::all();

        return $data;
    }

    public function add_stage(Request $request){
        $stageName = $request->stageName;
        $stageDescription = $request->stageDescription;
        $position = $request->position;
        $serviceID = $request->serviceID;

        if(Service_stage::where([['service_id',$serviceID],['position',$position]])->exists()){
            $data['message'] = "This position has been taken";
        } else {
            $insertData = ['service_ID'=>$serviceID, 'service_stage_name'=>$stageName, 'service_stage_description'=>$stageDescription,'position'=>$position];

            $insert = Service_stage::insert($insertData);

            $data['message'] = "Stage added successfully";
        }

        $data['stages'] = Service_stage::all();

        return $data;
    }

    public function save_service(Request $request){
        $service_id = $request->service_id;
        $service_name = $request->service_name;
        $service_description = $request->service_description;

        $data = ['service_name'=>$service_name, 'service_description'=>$service_description];

        Service::where('service_id',$service_id)->update($data);

        return redirect('/edit-service/'.$service_id);
    }

    public function delete_stage(Request $request){
        $data['features'] = Service_feature::all();

        return $data;
    }
}
