<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer_project;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\CompanyInformation;


class ManageOperationsController extends Controller
{
    //
    public function overview(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        return view('admin.overview')->with('data',$data);
    }

    public function view_invoice(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        return view('admin.view_invoice')->with('data',$data);
    }

    public function create_invoice(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        return view('admin.create_invoice')->with('data',$data);
    }

    public function view_projects(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        return view('admin.view_projects')->with('data',$data);
    }

    public function get_invoices(Request $request){

        $data['company_information'] = CompanyInformation::first();

        $data['invoices'] = Invoice::all();
        $data['invoice_items'] = InvoiceItem::all();

        $data['customer_projects'] = Customer_project::join('services','services.service_id','customer_projects.service_id')
            // ->join('service_stages','service_stages.service_stage_id','customer_projects.stage')
                            ->get();

        return $data;
    }

    public function get_invoice_details(Request $request){

        $data['company_information'] = CompanyInformation::first();

        $data['customer_projects'] = Customer_project::join('services','services.service_id','customer_projects.service_id')
            // ->join('service_stages','service_stages.service_stage_id','customer_projects.stage')
                            ->get();

        return $data;
    }

    public function add_invoice(Request $request){
        $data['project_id'] = $request->project_id;
        $data['reference_number'] = $data['project_id'];

        $insert_data = ['project_id'=>$data['project_id'],'invoice_reference'=>$data['reference_number']];

        $data['invoice_id'] = Invoice::insertGetId($insert_data);


        return $data;
    }

    public function save_invoice_item(Request $request){
        $itemname = $request->item;
        $quantity = $request->quantity;
        $cost = $request->cost;
        $vat = $request->vat;
        $invoice_id = $request->invoice_id;

        $data = ['item'=>$itemname, 'quantity'=>$quantity, 'cost'=>$cost, 'VAT'=>$vat, 'invoice_id'=>$invoice_id];

        $invoice_item_id = InvoiceItem::insertGetId($data);

        return $invoice_item_id;
    }

    public function confirm_invoice_save(Request $request){
        $invoice_id = $request->invoice_id;
        $status = $request->status;

        if($status=='confirm'){
            $status = 4;
        }

        $data = ['status'=>$status,'modified_by'=>Auth::user()->id];

        Invoice::where('invoice_id',$invoice_id)->update($data);

        return $invoice_id;


    }
}


