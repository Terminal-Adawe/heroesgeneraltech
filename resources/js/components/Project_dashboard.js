import React from 'react';
import ReactDOM from 'react-dom';
import '../../../node_modules/react-vis/dist/style.css';
import {XYPlot, LineSeries} from 'react-vis';

function ProjectDashboard(props) {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Overview</div>

                        <div className="card-body">
                            <div className="row">
                                <div className="col-md-4 card-shadow2">
                                </div>
                                <div className="col-md-4 card-shadow2">
                                </div>
                                <div className="col-md-4 card-shadow2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="row">
                {
                    props.customers ? props.customers.map((customer,i)=>{
                        return <div key={i} className="row">
                                  <button className="btn btn-link btn-block" type="button" aria-expanded="false" onClick={ ()=>this.showCustomerDetails(customer.id,"view") }>
                                    { customer.name }
                                  </button>
                            </div>
                    }) : ''
                }
            </div>
        </div>
    );
}

export default ProjectDashboard;

