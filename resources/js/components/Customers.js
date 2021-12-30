import React from 'react';
import ReactDOM from 'react-dom';
import API from './APIController'
import ProjectDashboard from './Project_dashboard'


class Customers extends React.Component {
	constructor(){
		super()

		this.state={
			customers: [],
			show: "view",
			customerDetailPage: false,
			viewCustomerID: 0,
		}

		this.showCustomerDetails = this.showCustomerDetails.bind(this)
		this.hideCustomerDetails = this.hideCustomerDetails.bind(this)

	}

	componentDidMount(){

		new API().getCustomers().then(response=>{
                console.log("Response")
                console.log(response.data)

                this.setState({
                	customers: response.data.customers
                })

        })
	}

	showCustomerDetails(customerID,view){
		console.log("Customer ID is ");
		console.log(customerID);
		this.setState({
			customerDetailPage: true,
			viewCustomerID: customerID,
			show: view,
		})
	}

	hideCustomerDetails(customerID,view){
		if(view=="project"){
			
		}
		this.setState({
			customerDetailPage: false,
			viewCustomerID: 0,
			show: view,
		})
	}

	render(){
		return (<div className="row">
					{
						this.state.customerDetailPage ?
							<div className="col-md-1 col-sm-12 back-div" onClick={ ()=>this.hideCustomerDetails(0,"view") }>
							</div>
							: 
							<div className="col-md-4 col-sm-12">
            					<ul className="side-menu">
            						<li><a href="#" className="white-link" onClick={ ()=>this.hideCustomerDetails(0,"view") }>View Customers</a></li>
            						<li><a href="#" className="white-link" onClick={ ()=>this.hideCustomerDetails(0,"project") }>Customer Projects</a></li>
            					</ul>
            				</div>

					}
					{
						this.state.show=="view" ?
							this.state.customerDetailPage ?
							<div className="col-md-8">
            							{
            								this.state.customers ? this.state.customers.filter((customer)=>customer.id==this.state.viewCustomerID).map((customer,i)=>{
            									return <div className="row" key={i}>
            											<div className="col-md-4 col-sm-12">
            												<p>
															  <button className="btn btn-link btn-block" type="button" aria-expanded="false" onClick={ ()=>this.showCustomerDetails(customer.id,"view") }>
															    { customer.name }
															  </button>
															</p>
														</div>
														<div className="col-md-8" id="">
														 <div className="card card-body">
														    <p>
														    	Username: { customer.username }
														    </p>
														    <p>
														    	Email: { customer.email }
														    </p>
														    <p>
														    	Date Registered: { customer.created_at }
														    </p>
														  </div>
														</div>
													</div>
            								}) : ''
            							}
							</div>
            				:
            				<div className="col-md-8 col-sm-12">
            					{
            						this.state.customers ? this.state.customers.map((customer,i)=>{
            							return <div key={i} className="row">
												  <button className="btn btn-link btn-block" type="button" aria-expanded="false" onClick={ ()=>this.showCustomerDetails(customer.id,"view") }>
												    { customer.name }
												  </button>
												
											</div>
            						}) : ''
            					}
            				</div>	
						: this.state.show=="project" ? 
							<div className="col-md-8 col-sm-12">
								<ProjectDashboard customers={ this.state.customers }/>
							</div>
						: <div className="col-md-8"></div> 
            		}
            	</div>)
	}
}

export default Customers;

if (document.getElementById('customers')) {
    ReactDOM.render(<Customers />, document.getElementById('customers'));
}