import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';


function Invoice(props){

	return (<div className="container-fluid">
			<div className="row my-4">
                <div className="col-md-4">
                    <div className="invoice-logo">
                        <img src="/images/logo.png" width="100%" height="100%"/>
                    </div>
                </div>
                <div className="col-md-4">
                	<div className="row">
                        PROJECT
                    </div>
                    <div className="row">
                        {
                            (props.saved==0 || props.saved==2) ? 
                            	
                             <input type="text" className="form-control" onChange={(e)=>props.inputChange(e,"projectName")} />
                            : <div className="mx-auto">
                                        <span style={{ fontSize: '20px' }}>
                                            {props.projectName}
										</span>
                                    </div> 


                        }
                    </div>
                </div>
                <div className="col-md-4">
                    <h2>Invoice</h2>
                </div>
            </div>
            <div className="row my-2">
                <div className="col-md-4">
                    { props.companyDetails ? props.companyDetails.name : '' }
                    <br/>
                    { props.companyDetails ? props.companyDetails.address_1 : '' }
                    <br/>
                    { props.companyDetails ? props.companyDetails.contact_1 : '' }
                </div>
                <div className="col-md-4">
                	{
                		props.saved==0 || props.saved==2 ? 
                			<div className="row">
                				<div className="col-12">
                					<label>Enter Customer Name</label>
                					<input type="" className="form-control" onChange={ (e)=>props.inputChange(e,"customerName") }/>
                				</div>

                				<div className="col-12">
                					<label>Enter Customer Address</label>
                					<input type="" className="form-control" onChange={ (e)=>props.inputChange(e,"customerAddress") }/>
                				</div>
                			</div>
                			: props.saved==1 || props.saved==4 ?
                			<div className="row">
                				<div className="col-12">
                					{ props.customerName }
                				</div>
                				<div className="col-12">
                					{ props.customerAddress }
                				</div>
                				<div className="col-12">
                					{ props.customerNumber }
                				</div>
                			</div>
                			:
                			<></>
                	}
                </div>
                <div className="col-md-4">
                	<p><b>Invoice ID:</b> {props.referenceNumber ? props.referenceNumber : ''}</p>
                    <p><b>Date: </b>{ props.date__ ? props.date__ : '' }</p>
                </div>
            </div>
            <div className="row mb-4">
                <table className="table">
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
                        {
                            props.allItems ? props.allItems.map((item, i)=>{
                                return <tr key={ i } className={ i%2==1 ? "table-info" : "table-light" }>
                                    <td>{i+1}</td>
                                    <td>{ item.item }</td>
                                    <td>{ item.quantity }</td>
                                    <td>₵{ item.cost }</td>
                                    <td><b>₵{ parseInt(item.cost) * parseInt(item.quantity) }</b></td>
                                    </tr>
                            }) : <tr></tr>
                        }
                        <tr>
                            <td colSpan='3'></td>
                            <td><b>SubTotal</b></td>
                            { /*<td>₵{ props.subTotalCost==0 || props.subTotalCost=="" ? '0.00' : props.subTotalCost }</td> */}
                            <td className="table-info"><b>₵{ props.totalCost==0 || props.totalCost=="" ? '0.00' : props.totalCost }</b></td>
                        </tr>
                        <tr>
                            <td colSpan='3'></td>
                            <td><b>Grand Total</b></td>
                            <td className="table-light"><b>₵{ props.totalCost==0 || props.totalCost=="" ? '0.00' : props.totalCost }</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Discount</b></td>
                            <td className="table-info">{ 
                            	props.saved==0 || props.saved==2 ?
                            	<input type="number" defaultValue='0' className="form-control" onChange={ (e)=>props.inputChange(e,"discount") } />
                            	:
                            	props.discount==0 || props.discount=="" ? 
                            	'0' : 
                            	props.discount+"%" }</td>
                            <td><b>Discounted Total</b></td>
                            <td className="table-info">₵{ props.totalCost - (props.discount/100*props.totalCost) }</td>
                        </tr>
                        <tr>
                            <td colSpan='3'></td>
                            <td><b>VAT</b></td>
                            <td className="table-light">₵ { 
                            	props.saved==0 || props.saved==2 ?
                            	<input defaultValue='0' type="number" className="form-control" onChange={ (e)=>props.inputChange(e,"VAT") } />
                            	:
                            	props.VAT==0 || props.VAT=="" ? 
                            	'0.00' : 
                            	props.discount }</td>
                        </tr>
                        <tr>
                            <td colSpan='3'></td>
                            <td><b>Initial Payment</b></td>
                            <td className="table-info"><b>₵{ props.amountPaid_project==0 || props.amountPaid_project=="" ? '0.00' : props.amountPaid_project }</b></td>
                        </tr>
                        <tr>
                            <td colSpan='3'></td>
                            <td><h2>Amount due</h2></td>
                            <td><h2>₵{ (props.totalCost - (props.discount/100*props.totalCost)) - props.amountPaid_project }</h2></td>
                        </tr>
                        <tr>
                            <td colSpan='5' style={{ textAlign: 'center' }}><i>6 Months Warranty</i></td>
                        </tr>
                        <tr>
                            <td colSpan='5' style={{ textAlign: 'center' }}><b>WE ARE GLAD TO DO BUSINESS WITH YOU</b></td>
                        </tr>
                        <tr>
                            <td colSpan='5' style={{ textAlign: 'center' }}>
                                <div className='row mb-1'>
                                    <div className="col-6">
                                        <div className='row mb-1'>
                                            <div className="col-12">
                                                Manager's Signature
                                            </div>
                                        </div>
                                        <div className='row'>
                                            <div className="col-12">
                                                <textarea className="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-6">
                                        <div className='row mb-1'>
                                            <div className="col-12">
                                                Client's Signature
                                            </div>
                                        </div>
                                        <div className='row'>
                                            <div className="col-12">
                                                <textarea className="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {
                            props.allItems.length > 0 ? 
                            <tr>
                                <td colSpan='6' style={{ textAlign: 'center' }}>
                                    {
                                        props.saved==0 ? 
                                            <button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ props.saveInvoice }>Save Invoice</button>
                                        : props.saved==1 ? <div className='row'><div className='col-6'><button className="btn btn-outline-secondary btn-sm my-4 mx-4" type="button" onClick={ ()=>props.editInvoice('edit') }>Edit Invoice</button></div><div className='col-6'><button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ props.confirmSaveInvoice }>Confirm Save</button></div></div>
                                        : props.saved == 2 ? <button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ ()=>props.editInvoice('save') }>Save Edit</button>
                                        : props.saved == 4 ? <a className="btn btn-danger btn-sm my-4" href={`/invoice/pdf/${props.invoiceID ? props.invoiceID : ''}`} >Print</a>
                                        : ''
                                    }       
                                </td>
                            </tr>
                            : <tr></tr>
                        }
                    </tbody>
                </table>
            </div>
		</div>)
}

export default Invoice