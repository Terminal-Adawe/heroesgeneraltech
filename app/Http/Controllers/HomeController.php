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
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Log;

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

        $data['services'] = Service::where('active',1)->get();

        $data['customer_count'] = DB::table('users')
                            ->where('is_staff','!=','1')
                            ->select(DB::raw('COUNT(users.id) as number_of_users'))
                            ->first();

        $data['projects_count'] = DB::table('customer_projects')
                            ->select(DB::raw('COUNT(customer_projects.customer_project_id) as number_of_projects'))
                            ->first();

        $data['pending_projects_count'] = DB::table('customer_projects')
                            ->where('stage','!=','pending')
                            ->select(DB::raw('COUNT(customer_projects.customer_project_id) as number_of_projects'))
                            ->first();

        $data['customer_projects'] = Customer_project::join('users','customer_projects.created_by','=','users.id')
            ->join('services','services.service_id','customer_projects.service_id')
            ->join('service_stages','service_stages.service_stage_id','customer_projects.stage')
                                ->where('is_staff',0)->get();

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

        $stage = 1;

        $date = new DateTime();
        $date->add(new DateInterval('P3D'));

        $data = ['service_id'=>$service_id, 'customer_comments'=>$customer_comment,'created_by'=>Auth::user()->id,'objective_completion_date'=>$date];

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

    public function view_project($project_id){
        $data['services_f'] = Service::where('active',1)->take(3)->get();

        $data['project_details'] = Customer_project::join('services','services.service_id','customer_projects.service_id')
                                    ->select('*','customer_projects.service_id as p_service_id')
                                    ->join('service_stages','service_stages.service_stage_id','customer_projects.stage')
                                    ->where('customer_project_id',$project_id)
                                    ->get();
        $service_id = $data['project_details'][0]->p_service_id;

        Log::debug("service ID is ");
        Log::debug($service_id);

        $where = [['service_id',$service_id],['active',1]];
        $data['service_details'] = Service::where($where)->first();

        $data['features'] = Service_feature::where('service_id',$service_id)->get();

        $data['stages'] = Service_stage::where('service_id',$service_id)
                            ->orWhere('service_id',0)
                            ->whereNotIn('service_stage_id',[3])
                            ->orderBy('position','ASC')->get();

        $data['length'] = count($data['stages']);

        $count = 0;

        foreach($data['stages'] as $stage){
            if($stage->position<=$data['project_details'][0]->position){
                $count=$count+1;
            }
        }

        Log::debug("length is ");
        Log::debug($data['length']);

        Log::debug("Count is ");
        Log::debug($count);

        $data['progress'] = ($count/$data['length'])*100;

        Log::debug("Progress is ");
        Log::debug($data['progress']);

        $data['action'] = 'view';

        return view('admin.project_details')->with('data',$data);
    }

    public function update_project(Request $request){
        $project_id = $request->project_id;
        $stage = $request->service_stage_id;
        $comment = $request->comment;
        $cost = $request->cost;
        $due_date = $request->due_date;

        Log::debug("due date is ");
        Log::debug($due_date);

        $update=['comment'=>$comment,'stage'=>$stage,'objective_completion_date'=>$due_date,'cost'=>$cost];

        if(trim($due_date)==""){
            $update=['comment'=>$comment,'stage'=>$stage,'cost'=>$cost];
        }

        Customer_project::where('customer_project_id',$project_id)
            ->update($update);

        return redirect('/view-project/'.$project_id);
    }

    public function close_project(Request $request){
        $project_id = $request->project_id;
        $stage = $request->service_stage_id;
        $comment = $request->comment;

        $date = new DateTime();

        Log::debug("closure date is ");
        // Log::debug($date);

        $update=['comment'=>$comment,'stage'=>$stage,'completion_date'=>$date];


        Customer_project::where('customer_project_id',$project_id)
            ->update($update);

        return redirect('/view-project/'.$project_id);
    }

    public function get_features(Request $request){
        $data['features'] = Service_feature::all();

        return $data;
    }

    public function get_customers(Request $request){

        $data['customers'] = User::where('is_staff',0)->get();

        return $data;
    }

    public function get_customer_projects(Request $request){
        // $data['customers'] = User::leftJoin('customer_projects','customer_projects.created_by','=','users.id')
        //                         ->where('is_staff',0)->get();

        // $data['customer_projects'] = User::leftJoin('customer_projects','customer_projects.created_by','=','users.id')
        //                         ->where('is_staff',0)->get();

        $data['service_features'] = Service::LeftJoin('service_features','service_features.service_id','services.service_id')
                                        ->select('*','services.service_id as s_service_id')
                                        ->where('service_features.active',1)->get();

        $data['service_stages'] = Service_stage::join('customer_projects','customer_projects.service_id','service_stages.service_id')
                                ->where('customer_projects.created_by',Auth::user()->id)
                                ->orWhere('service_stages.service_id',0)
                                ->get();

        $data['projects'] = Customer_project::join('services','services.service_id','customer_projects.service_id')
                            ->join('service_stages','customer_projects.stage','service_stages.service_stage_id')
                            ->select('*','customer_projects.service_id as serviceid')
                            ->where('created_by',Auth::user()->id)->get();

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
