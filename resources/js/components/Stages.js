import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController'


function Stages() {

    const [stages, setStages] = useState(0);
    const [stageName, setStageName] = useState(0);
    const [stageDescription, setStageDescription] = useState(0);
    const [serviceID, setServiceID] = useState(0);
    const [position, setPosition] = useState(0);
    const [message, setMessage] = useState(0);
    const [showMessage, setShowMessage] = useState(0);
    const [count, setCount] = useState(0);

    useEffect(() => {    
        function fetchStages(){

            const serviceID_ = document.getElementById("service_id");

            setServiceID(serviceID_.value)
            setStageName("");
            setStageDescription("");
            setPosition("");
            setMessage("");
            setShowMessage('0');

            new API().getStages().then(response=>{
                console.log("Response")
                console.log(response.data.stages)

                setStages(response.data.stages);
            })
        }

        fetchStages();
    },[count]);

    function addStage(e){
        console.log("add feature clicked")

        new API().addStage(serviceID, stageName,stageDescription, position).then(response=>{
                console.log("Response")
                console.log(response.data.stages)

                setStages(response.data.stages);
                setMessage(response.data.message);
                setShowMessage("1");
            })

        setTimeout(function (){
            setShowMessage("0");
        },2000);

        setStageName("");
        setStageDescription("");
        setPosition("");
    }

    function stageFeatures(e,featureType){
        console.log('stages')
        console.log(e.target.value)

        if(featureType=='stage_name'){
            setStageName(e.target.value)
        }

        if(featureType=='stage_description'){
            setStageDescription(e.target.value)
        }

        if(featureType=='position'){
            setPosition(e.target.value)
        }
    }

    function delete_stage(e,id_){
        console.log("delete")
        var html_name = document.getElementsByClassName("anym")
        var type = document.getElementById("seType")
        var i_id = document.getElementById("id_")
        var sid = document.getElementById("sid")

        for (var i = 0; i < html_name.length; i++) {
            // y[i].style.backgroundColor = "red";
            html_name[i].innerHTML = "Stage"
        } 

        type.value = "stage";
        i_id.value = id_;
        sid.value = serviceID;

        console.log(i_id.value)
    }

    return (
        <ul className="list-group">
            {
                stages ? stages.filter((stage)=>stage.service_id == serviceID).map((stage,i)=>{
                    return <li key={i} className="list-group-item d-flex justify-content-between align-items-start">
                                <div className="">{ stage.position }</div>
                             <div className="ms-2 me-auto">
                               <div className="fw-bold">{ stage.service_stage_name }</div>
                               { stage.service_stage_description=='0' ? ' ' : stage.service_stage_description }
                             </div>
                             <span className="badge bg-danger rounded-pill" style={{ color:"white" }}><a href='#' className="white-link"  data-bs-toggle="modal" data-bs-target="#delete_modal" onClick={ (e)=>delete_stage(e,stage.service_stage_id) }>delete</a></span>
                            </li>
                })
                : ""
            }

  <li className="list-group-item d-flex justify-content-between align-items-start">
        <div className="ms-2 me-auto">
            <div className="fw-bold">Stage name</div>
            <input type="text" value={ stageName } className="form-control" name="service_feature_name" onChange={ (e)=>stageFeatures(e,'stage_name') }/>
        </div>   
        <div className="ms-2 me-auto">
          <div className="fw-bold">Stage description</div>
          <input type="text" value={ stageDescription } className="form-control" name="service_stage_description" onChange={ (e)=>stageFeatures(e,'stage_description') }/>
        </div>
        <div className="ms-2 me-auto">
          <div className="fw-bold">Stage position</div>
          <input type="text" value={ position } className="form-control" name="position" onChange={ (e)=>stageFeatures(e,'position') }/>
        </div>
  </li>
  {
            showMessage=='1' ? <li >{ message }</li>: ''
    }
  <li className="list-group-item d-flex justify-content-between align-items-start">
    <button className="btn btn-outline-danger" onClick={ ()=>addStage() }>Add stage</button>
  </li>

</ul>
    );
}

export default Stages;

if (document.getElementById('stages')) {
    ReactDOM.render(<Stages />, document.getElementById('stages'));
}
