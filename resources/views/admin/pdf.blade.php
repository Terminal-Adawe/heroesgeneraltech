<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <link rel="stylesheet" href="{{public_path('css/admin.css')}}">
    <link rel="stylesheet" href="{{public_path('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
</head>

<body>
<div class="container-fluid">
			<div class="row_ my-4">
                <div class="column">
                    <div class="invoice-logo">
                        <img src="{{public_path('images/logo.png')}}" width="100%" height="100%"/>
                    </div>
                </div>
                <div class="column">
                </div>
                <div class="column">
                </div>
                <div class="column">
                    <span style="font-size: 28px;">Invoice</span>
                </div>
            </div>
            <div class="row_ my-2">
                <div class="column">
                    {{ $data['company_information']->name }}
                    <br/>
                    {{ $data['company_information']->address_1 }}
                    <br/>
                    {{ $data['company_information']->contact_1 }}
                </div>
                <div class="column">
                </div>
                <div class="column">
                </div>
                <div class="column">
                	<p>{{ $data['invoice']->invoice_reference }}</p>
                    <p>{{ $data['invoice']->created_at }}</p>
                </div>
            </div>
            <div class="row_">
                <div class="column my-4">
                	<div class="row_">
                		<div class="col-12">
                			{{ $data['invoice']->customer_name }}
                		</div>
                		<div class="col-12">
                			{{ $data['invoice']->customer_address }}
                		</div>
                		<div class="col-12">
                			{{ $data['invoice']->customer_contact_number }}
                		</div>
                	</div>
                </div>
                <div class="column my-4">
                </div>
                <div class="column my-4">
                </div>
                <div class="column my-4">
                    <div class="row_">
                        <div class="col-12">
                            PROJECT
                        </div>
                        <div class="col-12">
                            <span style="font-size: 25px">{{ $data['invoice']->project_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row_ mb-4">
                <div class="col-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Total Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($data['invoice_items'] as $i=>$item)
                            @if($i%2==1)
                                <tr class="table-info" style="background-color: #ebf5fb;">
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $item->cost }}</td>
                                    <td><b><span style="font-family: DejaVu Sans;">&#8373;</span>{{ (int)$item->cost * (int)$item->quantity }}</b></td>
                                </tr>
                            @else
                                <tr class="table-light" style="background-color: #f8f9f9;">
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $item->cost }}</td>
                                    <td><b><span style="font-family: DejaVu Sans;">&#8373;</span>{{ (int)$item->cost * (int)$item->quantity }}</b></td>
                                </tr>
                            @endif
                        @endforeach
                        <tr style="background-color: #f8f9f9;">
                            <td colSpan='2'></td>
                            <td><b>SubTotal</b></td>
                            <td><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $data['subtotal'] }}</td>
                            <td class="table-info" style="background-color: #d6eaf8;"><b><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $data['totalcost'] }}</b></td>
                        </tr>
                        <tr style="background-color: #ebf5fb;">
                            <td colSpan='2'></td>
                            <td colSpan='2'><b>Grand Total</b></td>
                            <td class="table-light"><b><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $data['totalcost'] }}</b></td>
                        </tr>
                        <tr style="background-color: #f8f9f9;">
                            <td colSpan='2'></td>
                            <td colSpan='2'><b>Discount</b></td>
                            <td class="table-info" style="background-color: #d6eaf8;">{{ $data['invoice']->discount }}%</td>
                        </tr>
                        <tr style="background-color: #ebf5fb;">
                            <td colSpan='2'></td>
                            <td colSpan='2'><b>VAT</b></td>
                            <td class="table-light"><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $data['invoice']->VAT }}</td>
                        </tr>
                        <tr style="background-color: #f8f9f9;">
                            <td colSpan='2'></td>
                            <td colSpan='2'><b>Initial Payment</b></td>
                            <td class="table-info" style="background-color: #d6eaf8;"><b><span style="font-family: DejaVu Sans;">&#8373;</span>{{ $data['invoice']->payment }}</b></td>
                        </tr>
                        <tr style="background-color: #ebf5fb;">
                            <td colSpan='2'></td>
                            <td colSpan='2'>Discounted Total</td>
                            <td><span style="font-family: DejaVu Sans;">&#8373;</span>{{ (int)$data['totalcost'] - (((int)$data['invoice']->discount/100)*(int)$data['totalcost']) }}</td>
                        </tr>
                        <tr>
                            <td colSpan='2'></td>
                            <td colSpan='2'><span style="font-size: 34px">Amount due</span></td>
                            <td><span style="font-size: 34px"><span style="font-family: DejaVu Sans;">&#8373;</span>{{ ((int)$data['totalcost'] - (((int)$data['invoice']->discount/100)*(int)$data['totalcost']))-(int)$data['invoice']->payment }}</span></td>
                        </tr>
                        <tr style="padding-top: 40px;">
                            <td colSpan='5' style="text-align: center;"><i>6 Months Warranty</i></td>
                        </tr>
                        <tr style="padding-top: 40px;">
                            <td colSpan='5' style="text-align: center;"><b>WE ARE GLAD TO DO BUSINESS WITH YOU</b></td>
                        </tr>
                        <tr>
                            <td colSpan='5' style="text-align: center; padding-top: 20px;">
                                <div class='row_ mb-1'>

                                    <div class="column_s">
                                    </div>

                                    <div class="column_s">
                                        <div class='row_ mb-1'>
                                            <div class="column_full">
                                                Manager's Signature
                                            </div>
                                        </div>
                                        <div class='row_'>
                                            <div class="column_full">
                                                <textarea class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column_ss">
                                    </div>
                                    
                                    <div class="column_s">
                                        <div class='row_ mb-1'>
                                            <div class="column_full">
                                                Client's Signature
                                            </div>
                                        </div>
                                        <div class='row_'>
                                            <div class="column_full">
                                                <textarea class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
		</div>
    </body>
</html>