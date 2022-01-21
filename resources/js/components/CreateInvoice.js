import React, { useState, useRef, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';
import Invoice from './Invoice';


function CreateInvoice(props) {

    const [invoiceDetails, setInvoiceDetails] = useState(0);
    const [companyDetails, setCompanyDetails] = useState(0);
    const [customerProjects, setCustomerProjects] = useState(0);
    const [itemName, setItemName] = useState(0);
    const [itemQuantity, setItemQuantity] = useState(0);
    const [itemCost, setItemCost] = useState(0);
    const [VAT, setVAT] = useState(0);
    const [allItems, setAllItems] = useState(0);
    const [subTotalCost, setSubTotalCost] = useState(0);
    const [totalCost, setTotalCost] = useState(0);
    const [projectID, setProjectID] = useState(0);
    const [projectName, setProjectName] = useState(0);
    const [customerName, setCustomerName] = useState(0);
    const [customerAddress, setCustomerAddress] = useState(0);
    const [customerNumber, setCustomerNumber] = useState(0);
    const [referenceNumber, setReferenceNumber] = useState(0);
    const [discount, setDiscount] = useState(0);
    const [count, setCount] = useState(0);
    const [date__, setDate__] = useState(0);
    const [amountPaid_project, setAmountPaid_project] = useState(0);
    const [saved, setSaved] = useState(0);

    const itemNameInput = useRef(null);
    const itemCostInput = useRef(null);
    const itemQuantityInput = useRef(null);
    // const itemVatInput = useRef(null);

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

        setVAT(0);

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
            totalCost_ = totalCost_ + (parseInt(item.VAT) + (parseInt(item.cost) * parseInt(item.quantity)));
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
            const itemArray = {"item":itemName,"quantity":itemQuantity,"cost":itemCost,"VAT":0};

            let allItemsArray = allItems;

            allItemsArray = [...allItemsArray, itemArray];

            setAllItems(allItemsArray);

            itemNameInput.current.value = "";
            itemCostInput.current.value = "";
            itemQuantityInput.current.value = "1";
            // itemVatInput.current.value = "0";

            setItemQuantity(1);

            setVAT(0);


            console.log(allItemsArray);
        }

        if(field=="itemName"){
            setItemName(e.target.value)
        }

        if(field=="projectName"){
            setProjectName(e.target.value)
        }

        if(field=="customerName"){
            setCustomerName(e.target.value)
        }

        if(field=="customerNumber"){
            setCustomerNumber(e.target.value)
        }

        if(field=="customerAddress"){
            setCustomerAddress(e.target.value)
        }

        if(field=="itemCost"){
            setItemCost(e.target.value)
        }

        if(field=="discount"){
            setDiscount(e.target.value)
        }

        if(field=="itemQuantity"){
            setItemQuantity(e.target.value)
        }

        if(field=="VAT"){
            setVAT(e.target.value)
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

        new API().saveInvoiceDetails(projectName,customerName,customerAddress,customerNumber,discount,VAT).then(response=>{
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
            <Invoice 
                projectChange={ projectChange } 
                companyDetails={ companyDetails } 
                date__={ date__ } 
                customerProjects={ customerProjects } 
                allItems={allItems}
                amountPaid_project={amountPaid_project}
                totalCost={totalCost}
                saveInvoice={saveInvoice}
                saved={saved}
                editInvoice={editInvoice}
                confirmSaveInvoice={confirmSaveInvoice}
                subTotalCost={subTotalCost}
                projectID={projectID}
                inputChange={inputChange}
                customerName={customerName}
                customerAddress={customerAddress}
                discount={discount}
                projectName={projectName}
                referenceNumber={invoiceDetails.invoice_reference}
                VAT={invoiceDetails.VAT}
    
            />
            {
                saved==4 ? ''
                : <div className='container'>
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
                            <div className="col-md-3 col-sm-12 mt-4">
                                <button className="btn btn-outline-info btn-sm" type="button" onClick={ (e)=>inputChange(e,"addItem") }>Submit</button>
                            </div>
                        </div>
                    </div>
            }
        </div>);
}

export default CreateInvoice;

if (document.getElementById('createInvoice')) {
    ReactDOM.render(<CreateInvoice />, document.getElementById('createInvoice'));
}
