import React from 'react';
import ReactDOM from 'react-dom';
import API from './APIController'
import CountDown from './CountDown'



class CustomerProjects extends React.Component {
	constructor(){
		super()

		this.state={
			customer_projects: [],
			features: [],
			stages: [],
			serviceid: "",
			projectid: "",
			show: "view",
		}

		this.carouselChange = this.carouselChange.bind(this)
	}

	componentDidMount(){

		new API().getCustomerProjects().then(response=>{
                console.log("Response")
                console.log(response.data)

                this.setState({
                	customer_projects: response.data.projects,
                	features: response.data.service_features,
                	stages: response.data.service_stages
                })

        })
	}

	carouselChange(e,projectid,serviceid){
		console.log("carousel change")
		console.log(serviceid+" : "+projectid)

		this.setState({
			serviceid: serviceid,
			projectid: projectid,
		})
	}



	render(){
		return (<div className="row">
        <div className="col-md-7">
            <div data-aos="fade-right" data-aos-duration="1300" data-aos-once="true" id="projects-carousel" className="carousel slide" data-bs-ride="carousel">
                  <div className="carousel-indicators">
                    {
                    	this.state.customer_projects ? this.state.customer_projects.map((project, i)=>{
                    		return <button key={ i } type="button" data-bs-target="#projects-carousel" data-bs-slide-to={`${ i }`} className={`${ i==0 ? 'active' : '' }`} aria-current="true" aria-label={`Slide ${ i+1 }`}></button>
                    	}) : ""
                    }
                  </div>
                  <div className="carousel-inner" style={{ color:'white' }} >
                    {
                    	this.state.customer_projects ? this.state.customer_projects.map((project, i)=>{
                    		return <div key={ i } className={`carousel-item carouselHolder ${ i==0 ? 'active' : '' }`}>
                          <div className="backDrop"></div>
                        <div className="centerDiv">
                          <h2>{ project.service_name } <small><CountDown date={ project.objective_completion_date }/></small></h2>
                          <p>{ project.service_stage_name }</p>
                          <p>
                            <button data-bs-toggle="collapse" data-bs-target={`#project${ project.customer_project_id }`} aria-expanded="false" aria-controls="collapseExample" type="button" className="btn btn-info mx-1">Update Project</button>
                          	<button type="button" className="btn btn-outline-secondary" onClick={(e)=>this.carouselChange(e,project.customer_project_id,project.service_id)}>View features</button>
                          </p>
                          <div className="collapse" id={`project${ project.customer_project_id }`}>
                            <div className="card card-body">
                            <hr/>
                            	<div className="row">
                            		<div className="col-md-6 col-sm-12">
                              			<p>{ project.comment }</p>
                              			<ul style={{ listStyleType:"none" }}>
                              				{
                              					this.state.stages.filter(stage=>stage.customer_project_id==project.customer_project_id).map((stage,i)=>{
                              						return <li key={i}>&#10004; { stage.service_stage_name }</li>
                              					})
                              				} 			
                              			</ul>
                              		</div>
                              		<div className="col-md-6 col-sm-12">
										<h4>${ project.cost }</h4>

                              			<p>
                              				<label>Pay</label>
                              				<input type="text" className="form-control"/>
                              				<button className="btn btn-link">Submit</button>
                              			</p>
                              		</div>
                              	</div>
                              <br/>
                            </div>
                          </div>
                        </div>
                      </div>
                    	}) : ""
                    }
                    
                  </div>
                  <button className="carousel-control-prev" type="button" data-bs-target="#projects-carousel" data-bs-slide="prev">
                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span className="visually-hidden">Previous</span>
                  </button>
                  <button className="carousel-control-next" type="button" data-bs-target="#projects-carousel" data-bs-slide="next">
                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                    <span className="visually-hidden">Next</span>
                  </button>
                </div>
        </div>

        <div className="col-md-5">
          <div className="extra-features">
          	{
              	this.state.features ? this.state.features.filter(feature=>feature.s_service_id==this.state.serviceid).slice(1).map((feature, i)=>{
              		return <span key={i} className="customer_projects_service_desc">{ feature.service_description }</span>
              	}) : ""
            }
            <h2>Features</h2>
              <ul style={{ listStyleType:"none" }}>
              	{
              		this.state.features ? this.state.features.filter(feature=>feature.service_id==this.state.serviceid).map((feature, i)=>{
              			return <li key={i}>&#10004; { feature.service_feature_name }</li>
              		}) : ""
              	}
              </ul>
          </div>
        </div>
        
      </div>)
	}
}

export default CustomerProjects;

if (document.getElementById('customer_projects')) {
    ReactDOM.render(<CustomerProjects />, document.getElementById('customer_projects'));
}