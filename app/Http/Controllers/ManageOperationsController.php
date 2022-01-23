<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer_project;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Log;
use PDF;

class ManageOperationsController extends Controller
{
    //
    public function overview(Request $request){
        $data['services_f'] = Service::where('active',1)->take(5)->get();

        return view('admin.overview')->with('data',$data);
    }

    public function view_invoices(Request $request){
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

        $data['invoices'] = Invoice::orderBy('created_at','desc')->get();
        $data['invoice_items'] = InvoiceItem::all();

        $data['customer_projects'] = Customer_project::join('services','services.service_id','customer_projects.service_id')
            // ->join('service_stages','service_stages.service_stage_id','customer_projects.stage')
                            ->get();

        return $data;
    }

    public function get_invoice(Request $request){
        $invoice_id = $request->invoice_id;

        $data['invoice_items'] = InvoiceItem::where('invoice_id',$invoice_id)->get();

        $data['invoice'] = Invoice::where('invoice_id',$invoice_id)->first();

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
        $data['project_name'] = $request->projectName;
        $data['customer_name'] = $request->customerName;
        $data['customer_address'] = $request->customerAddress;
        $data['customer_contact_number'] = $request->customerNumber;
        $data['discount'] = $request->discount;
        $data['VAT'] = $request->VAT;

        $date = date('Ymd.His');

        Log::debug("Date is ");
        Log::debug($date);


        $insert_data = ['project_name'=>$data['project_name'],'customer_name'=>$data['customer_name'],'customer_address'=>$data['customer_address'],'customer_contact_number'=>$data['customer_contact_number'],'discount'=>$data['discount'],'VAT'=>$data['VAT']];

        $data['invoice_id'] = Invoice::insertGetId($insert_data);

        $data['invoice_reference'] = strval($date).".".strval($data['invoice_id']);

        Invoice::where('invoice_id',$data['invoice_id'])->update(['invoice_reference'=>$data['invoice_reference']]);


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

    public function createPDF(Request $request){
        // retreive all records from db

    $invoice_id = $request->invoice_id;

    $data['invoice_items'] = InvoiceItem::where('invoice_id',$invoice_id)->get();

    $subtotal = 0;
    $total_cost = 0;

    foreach($data['invoice_items'] as $item){
        $subtotal = (int)$item->cost + $subtotal;
        $total_cost = $total_cost + (((int)$item->VAT+(int)$item->cost)*(int)$item->quantity);
    }

    $data['subtotal'] = $subtotal;
    $data['totalcost'] = $total_cost;

    $data['invoice'] = Invoice::where('invoice_id',$invoice_id)->first();

    $data['company_information'] = CompanyInformation::first();

    // share data to view
    $pdf = new PDF();

    view()->share('data',$data);
    $pdf = PDF::setPaper('A4', 'landscape')->loadView('admin.pdf', $data);

    Log::debug("path is ");
    Log::debug($_SERVER['DOCUMENT_ROOT']);

    // PDF::setBasePath(realpath($_SERVER['DOCUMENT_ROOT']));

      // download PDF file with download method
      return $pdf->download('invoice.pdf');
    }
}


