import axios from 'axios'

class Api {

	async getStories () {
		let response = await axios.get('/api/stories')

        return response.data.stories
       
	}

	async getStory (storyid, pageNo, type, optionid) {
		console.log("sending story ID "+storyid+" with type "+type+" and page number "+pageNo)
		
		try {
		const config = {
        method: 'get',
        url: '/api/story/',
        params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
    }


    let response = await axios(config)

        return response.data
       
		} catch (err) {
      // throw new Error
      return {err};
    	}
	} 

	async getFeatures(){
            console.log("calling get features")

            const config = {
        		method: 'get',
        		url: '/api/get-features',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Add feature
    async addFeature(serviceID,featureName,featureDescription){
            console.log("calling add features")
            console.log(featureName)
            console.log(featureDescription)

            const config = {
        		method: 'post',
        		url: '/api/add-feature',
        		params:{ serviceID: serviceID, featureName: featureName, featureDescription: featureDescription },
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Get stages
    async getStages(){
            console.log("calling get stages")

            const config = {
        		method: 'get',
        		url: '/api/get-stages',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Add stage
    async addStage(serviceID,stageName,stageDescription, position){
            console.log("calling add features")
            console.log(stageName)
            console.log(stageDescription)

            const config = {
        		method: 'post',
        		url: '/api/add-stage',
        		params:{ serviceID: serviceID, stageName: stageName, stageDescription: stageDescription, position: position },
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Get customers
    async getCustomers(){
            console.log("calling get customers")

            const config = {
        		method: 'get',
        		url: '/api/get-customers',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }
}

export default Api