import React from 'react'
import ReactDOM from 'react-dom'
import Invoices from './Invoices'
import Invoice from './Invoice'
import API from './APIController';
import { Route, Link, Routes, BrowserRouter as Router, Navigate } from "react-router-dom"


class InvoiceNavigator extends React.Component{
	constructor(){
		super()

		this.state = {
			projectID: "",
			date__: '',
			saved: 4,
			invoices: [],
			invoiceDetails: [],
			invoiceItems: [],
			companyDetails: [],
			customerProjects: [],
			subTotalCost: '',
			totalCost: '',
			amountPaid_project: 0,
			selectedInvoice: [],
			viewState: "all"
		}

		this.updateStates = this.updateStates.bind(this)
		this.viewAll = this.viewAll.bind(this)

	}

	componentDidMount(){
		new API().fetchInvoices().then(response=>{
                console.log("Response")
                console.log(response.data)


                this.setState({
                	invoices: response.data.invoices,
                	companyDetails: response.data.company_information,
                	customerProjects: response.data.customer_projects,
                })
            })
	}

	updateStates(invoiceID,projectID){
		new API().fetchInvoice(invoiceID).then(response=>{
			console.log("Response")
            console.log(response.data)

            this.setState({
            	invoiceItems: response.data.invoice_items,
            	projectID: projectID,
            	invoiceDetails: response.data.invoice
            },()=>{
            		let subTotalCost_ = 0;
        			let totalCost_ = 0;
        			this.state.invoiceItems ? this.state.invoiceItems.map((item,i)=>{
        		    subTotalCost_ = subTotalCost_ + parseInt(item.cost);

        		    console.log("Customer projects are")
        		    console.log(this.state.customerProjects)
        		    console.log("compared with")
        		    console.log(this.state.projectID)

 					
 					this.state.customerProjects ? this.state.customerProjects
 													.filter(project=>project.customer_project_id == this.state.projectID)
 														.map((project,i)=>{
 												console.log("Amount paid is ")
 												console.log(this.state.amountPaid_project)
 													this.setState({
 														amountPaid_project: project.amount_paid
 													})
 									}) : ''

        		    totalCost_ = totalCost_ + (parseInt(item.VAT) + (parseInt(item.cost) * parseInt(item.quantity)));
        		    console.log("sub total: "+subTotalCost_)
        		    console.log("grand total: "+totalCost_)

        		    this.setState({
        		    	subTotalCost: subTotalCost_,
                		totalCost: totalCost_
        		    })
        		}) : ''
            })
		})

		this.viewAll("one");
	}

	viewAll(state_){
		this.setState({
			viewState: state_
		})
	}




	render(){
		return(<Router>
		{
			this.state.viewState=="one" ?
				<nav aria-label="breadcrumb">
  					<ol class="breadcrumb">
  					  <li class="breadcrumb-item"><Link to="/admin/view-invoices" onClick={()=>this.viewAll("all")}>View Invoices</Link></li>
  					  <li class="breadcrumb-item active" aria-current="page">Invoice</li>
  					</ol>
				</nav>
				:
				''
		}
      	<Routes>
          <Route path="/admin/view-invoices" element={ 
          	<Invoices 
          		invoices={this.state.invoices}
          		updateStates={this.updateStates}
          	/>}/>
          <Route path="/admin/view-invoice" element={ 
          	<Invoice 
                companyDetails={ this.state.companyDetails } 
                date__={ this.state.date__ } 
                customerProjects={ this.state.customerProjects } 
                allItems={this.state.invoiceItems}
                amountPaid_project={this.state.amountPaid_project}
                totalCost={this.state.totalCost}
                saved={this.state.saved}
                subTotalCost={this.state.subTotalCost}
                projectID={this.state.projectID}
                discount={this.state.invoiceDetails ? this.state.invoiceDetails.discount : ''}
                customerName={this.state.invoiceDetails ? this.state.invoiceDetails.customer_name : ''}
                customerNumber={this.state.invoiceDetails ? this.state.invoiceDetails.customer_contact_number : ''}
                customerAddress={this.state.invoiceDetails ? this.state.invoiceDetails.customer_address : ''}
                referenceNumber={this.state.invoiceDetails ? this.state.invoiceDetails.invoice_reference : ''}
                projectName={this.state.invoiceDetails ? this.state.invoiceDetails.project_name : ''}
                VAT={this.state.invoiceDetails ? this.state.invoiceDetails.VAT : ''}
            />}/>
      	</Routes>
  </Router>
			   )
	}

}

export default InvoiceNavigator;

if (document.getElementById('invoices')) {
    ReactDOM.render(<InvoiceNavigator />, document.getElementById('invoices'));
}

