import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';


function Invoices() {

    const [invoices, setInvoices] = useState(0);
    const [invoiceItems, setInvoiceItems] = useState(0);
    const [count, setCount] = useState(0);

    useEffect(()=>{
        function fetchInvoices(){


            new API().fetchInvoices().then(response=>{
                console.log("Response")
                console.log(response.data)

                setInvoices(response.data.invoices);
                setInvoiceItems(response.data.invoiceItems)
            })
        }

        fetchInvoices();
    },[count])

    return (<div>
            {
                invoices ? invoices.filter(invoice=>invoice.status=='4').map((invoice,i)=>{
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
                    </div>
                }) : ''
            }
        </div>
    );
}

export default Invoices;

if (document.getElementById('invoices')) {
    ReactDOM.render(<Invoices />, document.getElementById('invoices'));
}
