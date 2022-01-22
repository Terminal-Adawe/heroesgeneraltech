import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import API from './APIController';


function Features() {

    const [features, setFeatures] = useState(0);
    const [featureName, setFeatureName] = useState(0);
    const [featureDescription, setFeatureDescription] = useState(0);
    const [serviceID, setServiceID] = useState(0);
    const [count, setCount] = useState(0);

    useEffect(() => {    
        function fetchFeatures(){

            const serviceID_ = document.getElementById("service_id");

            setServiceID(serviceID_.value)
            setFeatureName("");
            setFeatureDescription("");

            new API().getFeatures().then(response=>{
                console.log("Response")
                console.log(response.data.features)

                setFeatures(response.data.features);
            })
        }

        fetchFeatures();
    },[count]);

    function addFeature(e){
        console.log("add feature clicked")

        new API().addFeature(serviceID, featureName,featureDescription).then(response=>{
                console.log("Response")
                console.log(response.data.features)

                setFeatures(response.data.features);
            })

        setFeatureName("");
        setFeatureDescription("");
    }

    function featureFeatures(e,featureType){
        console.log('features')
        console.log(e.target.value)

        if(featureType=='feature_name'){
            setFeatureName(e.target.value)
        }

        if(featureType=='feature_description'){
            setFeatureDescription(e.target.value)
        }
    }

    function delete_feature(e,id_){
        console.log("delete")
        var html_name = document.getElementsByClassName("anym")
        var type = document.getElementById("seType")
        var i_id = document.getElementById("id_")
        var sid = document.getElementById("sid")


        for (var i = 0; i < html_name.length; i++) {
            // y[i].style.backgroundColor = "red";
            html_name[i].innerHTML = "Feature"
        } 

        type.value = "feature";
        i_id.value = id_;
        sid.value = serviceID;

        console.log(i_id.value)
    }

    return (
        <ul className="list-group">
            {
                features ? features.filter((feature)=>feature.service_id == serviceID).map((feature,i)=>{
                    return <li key={i} className="list-group-item d-flex justify-content-between align-items-start">
                             <div className="ms-2 me-auto">
                               <div className="fw-bold">{ feature.service_feature_name }</div>
                               { feature.service_feature_description=='0' ? ' ' : feature.service_feature_description }
                             </div>
                             <span className="badge bg-danger rounded-pill" style={{ color:"white" }}><a href='#' className="white-link" data-bs-toggle="modal" data-bs-target="#delete_modal" onClick={ (e)=>delete_feature(e,feature.service_feature_id) }>delete</a></span>
                            </li>
                })
                : ""
            }

  <li className="list-group-item d-flex justify-content-between align-items-start">
        <div className="ms-2 me-auto">
            <div className="fw-bold">Feature name</div>
            <input type="text" value={ featureName } className="form-control" name="service_feature_name" onChange={ (e)=>featureFeatures(e,'feature_name') }/>
        </div>   
        <div className="ms-2 me-auto">
          <div className="fw-bold">Feature description</div>
          <input type="text" value={ featureDescription } className="form-control" name="service_feature_description" onChange={ (e)=>featureFeatures(e,'feature_description') }/>
        </div>
  </li>
  <li className="list-group-item d-flex justify-content-between align-items-start">
    <button className="btn btn-outline-danger" onClick={ ()=>addFeature() }>Add feature</button>
  </li>

</ul>
    );
}

export default Features;

if (document.getElementById('features')) {
    ReactDOM.render(<Features />, document.getElementById('features'));
}
