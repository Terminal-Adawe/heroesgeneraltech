import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';
import { Link } from 'react-router-dom'


function Invoices(props) {

    const [invoices, setInvoices] = useState(0);
    const [invoiceItems, setInvoiceItems] = useState(0);
    const [companyDetails, setCompanyDetails] = useState(0);
    const [customerProjects, setCustomerProjects] = useState(0);
    const [count, setCount] = useState(0);

    // useEffect(()=>{
    //     function fetchInvoices(){


    //         new API().fetchInvoices().then(response=>{
    //             console.log("Response")
    //             console.log(response.data)

    //             setInvoices(response.data.invoices);
    //             setInvoiceItems(response.data.invoiceItems)
    //             setCompanyDetails(response.data.company_information);
    //             setCustomerProjects(response.data.customer_projects);
    //         })
    //     }

    //     fetchInvoices();
    // },[count])

    return (<div>
            {
                props.invoices ? props.invoices.filter(invoice=>invoice.status=='4').map((invoice,i)=>{
                    const today = new Date(invoice.created_at);
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    var date__ = mm + '-' + dd + '-' + yyyy;

                    return <div key={i} className="invoice-list shadow1">
                            <div className="d-flex mb-3">
                              <div className="me-auto p-2"><b className="text-muted">Invoice:</b> { invoice.invoice_reference }</div>
                              <div className="p-2">{ date__ }</div>
                              {
                                invoiceItems ? invoiceItems.filter(item=>item.invoice_id==invoice.invoice_id).map((item,r)=>{
                                    totalAmount = totalAmount + parseInt(item.cost);
                                }) : ''

                              }
                            </div>
                            <Link to="/admin/view-invoice" className="item-link" onClick={()=>props.updateStates(invoice.invoice_id,invoice.project_id)}></Link>
                    </div>
                }) : ''
            }
        </div>
    );
}

export default Invoices;
