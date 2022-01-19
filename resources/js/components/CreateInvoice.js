import React, { useState, useRef, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';


function CreateInvoice(props) {

    const [invoiceDetails, setInvoiceDetails] = useState(0);
    const [companyDetails, setCompanyDetails] = useState(0);
    const [customerProjects, setCustomerProjects] = useState(0);
    const [itemName, setItemName] = useState(0);
    const [itemQuantity, setItemQuantity] = useState(0);
    const [itemCost, setItemCost] = useState(0);
    const [vat, setVat] = useState(0);
    const [allItems, setAllItems] = useState(0);
    const [subTotalCost, setSubTotalCost] = useState(0);
    const [totalCost, setTotalCost] = useState(0);
    const [projectID, setProjectID] = useState(0);
    const [projectName, setProjectName] = useState(0);
    const [count, setCount] = useState(0);
    const [date__, setDate__] = useState(0);
    const [amountPaid_project, setAmountPaid_project] = useState(0);
    const [saved, setSaved] = useState(0);

    const itemNameInput = useRef(null);
    const itemCostInput = useRef(null);
    const itemQuantityInput = useRef(null);
    const itemVatInput = useRef(null);

    useEffect(() => {    
        function fetchInvoiceDetails(){


            new API().getInvoiceDetails().then(response=>{
                console.log("Response")
                console.log(response.data)

                setCompanyDetails(response.data.company_information);
                setCustomerProjects(response.data.customer_projects);
            })
        }

        setAllItems([]);

        setItemQuantity(1);

        setVat(0);

        setSubTotalCost(0.00);
        setTotalCost(0.00);
        setAmountPaid_project(0.00);

        /* 
            Saved determines if the record is being initiated, saved or being edited
            0 state means it has not been saved yet
            1 state means the record has been saved
            2 state means the record has been selected for editing.
            4 state means fully saved

        */
        setSaved(0);

        const today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        setDate__(mm + '-' + dd + '-' + yyyy);

        fetchInvoiceDetails();
    },[count]);

    useEffect(()=>{
        let subTotalCost_ = 0;
        let totalCost_ = 0;
        allItems ? allItems.map((item,i)=>{
            subTotalCost_ = subTotalCost_ + parseInt(item.cost);
            totalCost_ = totalCost_ + (parseInt(item.vat) + (parseInt(item.cost) * parseInt(item.quantity)));
            console.log("sub total: "+subTotalCost_)
            console.log("grand total: "+totalCost_)
        }) : ''
        setSubTotalCost(subTotalCost_);
        setTotalCost(totalCost_);
    },[allItems])

    useEffect(()=>{
        allItems ? allItems.map((item, i)=>{
            new API().saveInvoiceItems(invoiceDetails, item).then(response=>{
                console.log("Response")
                console.log(response.data)
            })
        }) : ''
    },[invoiceDetails])

    function inputChange(e,field){
        console.log("value entered for "+field+" is: "+e.target.value)

        console.log(allItems);

        if(field=="addItem"){
            const itemArray = {"item":itemName,"quantity":itemQuantity,"cost":itemCost,"vat":vat};

            let allItemsArray = allItems;

            allItemsArray = [...allItemsArray, itemArray];

            setAllItems(allItemsArray);

            itemNameInput.current.value = "";
            itemCostInput.current.value = "";
            itemQuantityInput.current.value = "1";
            itemVatInput.current.value = "0";


            console.log(allItemsArray);
        }

        if(field=="itemName"){
            setItemName(e.target.value)
        }

        if(field=="itemCost"){
            setItemCost(e.target.value)
        }

        if(field=="itemQuantity"){
            setItemQuantity(e.target.value)
        }
    }

    function projectChange(e){
        console.log("Change occurred");
        console.log(e.target.html)
        customerProjects ? customerProjects.map((project,i)=>{
            e.target.value == project.customer_project_id ? setAmountPaid_project(project.amount_paid) : ''
        }) : ''

        setProjectID(e.target.value)
    }

    function saveInvoice(){
        console.log("Add invoice has been called");

        new API().saveInvoiceDetails(projectID).then(response=>{
                console.log("Response")
                console.log(response.data)

                setInvoiceDetails(response.data);
            })

        // This record is now saved in the DB (invoices table)
        setSaved(1);
    }

    function editInvoice(action){
        if(action=='edit'){
            setSaved(2);
        } else if (action=='save'){
            setSaved(1);
        }
    }

    function confirmSaveInvoice(){
        new API().confirmSaveInvoice(invoiceDetails, 'confirm').then(response=>{
                console.log("Response")
                console.log(response.data)


            })
        // Fully saved
            setSaved(4);
    }
 
    return (<div className="container-fluid">
            <div className="row my-4">
                <div className="col-md-4">
                    <div className="invoice-logo">
                        <img src="/images/logo.png" width="100%" height="100%"/>
                    </div>
                </div>
                <div className="col-md-4">
                </div>
                <div className="col-md-4">
                    <h2>Invoice</h2>
                </div>
            </div>
            <div className="row my-2">
                <div className="col-md-4">
                    { companyDetails.name }
                    <br/>
                    { companyDetails.address_1 }
                    <br/>
                    { companyDetails.contact_1 }
                </div>
                <div className="col-md-4">
                </div>
                <div className="col-md-4">
                    <p>{ date__ }</p>
                </div>
                <div className="col-md-8 my-4">
                </div>
                <div className="col-md-4 my-4">
                    <div className="row">
                        PROJECT
                    </div>
                    <div className="row">
                        {
                            saved==0 || saved==2 ? 
                             <select className="form-select" onChange={(e)=>projectChange(e)}>
                                <option value="">Choose Project</option>
                                {
                                    customerProjects ? customerProjects.map((project,i)=>{
                                        return <option key={i} value={project.customer_project_id}>{ project.service_name }</option>
                                    }) : ''
                                }
                                    </select>
                            : <div className="mx-auto">
                                        {
                                            customerProjects ? customerProjects.map((project,i)=>{
                                                return <span style={{ fontSize: '20px' }} key={i}>
                                                        {
                                                            projectID == project.customer_project_id ? project.service_name  : ''
                                                        }
                                                        </span>
                                            }) : ''
                                        }
                                    </div>


                        }
                    </div>
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
                        <th scope="col">VAT</th>
                        <th scope="col">Total Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                        {
                            allItems ? allItems.map((item, i)=>{
                                return <tr key={ i } className={ i%2==1 ? "table-info" : "table-light" }>
                                    <td>{i+1}</td>
                                    <td>{ item.item }</td>
                                    <td>{ item.quantity }</td>
                                    <td>₵ { item.cost }</td>
                                    <td>{ item.vat }</td>
                                    <td>₵ { parseInt(vat)+(parseInt(item.cost) * parseInt(item.quantity)) }</td>
                                    </tr>
                            }) : ''
                        }
                        <tr>
                            <td colSpan='2'></td>
                            <td>SubTotal</td>
                            <td>₵ { subTotalCost==0 ? '0.00' : subTotalCost }</td>
                            <td></td>
                            <td className="table-info">₵ { totalCost==0 ? '0.00' : totalCost }</td>
                        </tr>
                        <tr>
                            <td colSpan='2'></td>
                            <td>Initial Payment</td>
                            <td></td>
                            <td></td>
                            <td className="table-light">₵ { amountPaid_project==0 ? '0.00' : amountPaid_project }</td>
                        </tr>
                        <tr>
                            <td colSpan='4'></td>
                            <td><h2>Total</h2></td>
                            <td><h2>₵ { totalCost - amountPaid_project }</h2></td>
                        </tr>
                        <tr>
                            <td colSpan='6' style={{ textAlign: 'center' }}><i>6 Months Warranty</i></td>
                        </tr>
                        <tr>
                            <td colSpan='6' style={{ textAlign: 'center' }}><b>WE ARE GLAD TO DO BUSINESS WITH YOU</b></td>
                        </tr>
                        <tr>
                            <td colSpan='6' style={{ textAlign: 'center' }}>
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
                            allItems.length > 0 ? 
                            <tr>
                                <td colSpan='6' style={{ textAlign: 'center' }}>
                                    {
                                        saved==0 ? 
                                            <button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ saveInvoice }>Save Invoice</button>
                                        : saved==1 ? <div className='row'><div className='col-6'><button className="btn btn-outline-secondary btn-sm my-4 mx-4" type="button" onClick={ ()=>editInvoice('edit') }>Edit Invoice</button></div><div className='col-6'><button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ confirmSaveInvoice }>Confirm Save</button></div></div>
                                        : saved == 2 ? <button className="btn btn-outline-secondary btn-sm my-4" type="button" onClick={ ()=>editInvoice('save') }>Save Edit</button>
                                        : ''
                                    }       
                                </td>
                            </tr>
                            : ''
                        }
                    </tbody>
                </table>
            </div>
            <div className="row my-3">
                <div className="mx-auto"><h2>Add Item</h2></div>
            </div>
            <div className="row my-1">
                <div className="col-md-3 col-sm-6">
                    <label htmlFor="item" className="form-label">Item name</label>
                    <input ref={ itemNameInput } type="text" className="form-control" id="item" onChange={ (e)=>inputChange(e,"itemName") }/>
                </div>
                <div className="col-md-3 col-sm-6">
                    <label htmlFor="cost" className="form-label">Cost</label>
                    <input ref={ itemCostInput } type="text" className="form-control" id="cost" onChange={ (e)=>inputChange(e,"itemCost") }/>
                </div>
                <div className="col-md-3 col-sm-6">
                    <label htmlFor="quantity" className="form-label">Quantity</label>
                    <input ref={ itemQuantityInput } type="text" className="form-control" id="quantity" defaultValue="1" onChange={ (e)=>inputChange(e,"itemQuantity") }/>
                </div>
                <div className="col-md-3 col-sm-6">
                    <label htmlFor="vat" className="form-label">VAT</label>
                    <input ref={ itemVatInput } type="text" className="form-control" id="vat" defaultValue="0" onChange={ (e)=>inputChange(e,"VATCost") }/>
                </div>
                <div className="col-md-3 col-sm-12 mt-4">
                    <button className="btn btn-outline-info btn-sm" type="button" onClick={ (e)=>inputChange(e,"addItem") }>Submit</button>
                </div>
            </div>
        </div>);
}

export default CreateInvoice;

if (document.getElementById('createInvoice')) {
    ReactDOM.render(<CreateInvoice />, document.getElementById('createInvoice'));
}
