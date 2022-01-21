import axios from 'axios'

class Api {

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


    // Get customer projects
    async getCustomerProjects(){
            console.log("calling get customer projects")

            const config = {
        		method: 'get',
        		url: '/api/get-customer-projects',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Get Invoices
    async fetchInvoices(){
            console.log("calling get invoices")

            const config = {
        		method: 'get',
        		url: '/api/get-invoices',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }

    // Get Invoices
    async fetchInvoice(invoice_id){
            console.log("calling get invoice")

            const config = {
        		method: 'get',
        		url: '/api/get-invoice',
        		params:{ invoice_id: invoice_id }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }

    // Get Invoice Details
    async getInvoiceDetails(){
            console.log("calling get invoice details")

            const config = {
        		method: 'get',
        		url: '/api/get-invoice-details',
        		// params:{ storyid: storyid, pageno: pageNo, type: type, optionid: optionid }
        		// headers: {
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Save Invoice Details
    async saveInvoiceDetails(projectName,customerName,customerAddress,customerNumber,discount,VAT){
            console.log("calling add invoice details")

            const config = {	
        		method: 'post',
        		url: '/api/add-invoice-details',
        		params:{ projectName: projectName, customerName: customerName, customerAddress: customerAddress, customerNumber: customerNumber, discount: discount, VAT: VAT }
        		// headers: { 
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }

    // Save Invoice Details
    async saveInvoiceItems(invoice_details,item){
            console.log("calling add invoice item")

            item.VAT = 0;

            const config = {	
        		method: 'post',
        		url: '/api/save-invoice-items',
        		params:{ invoice_id: invoice_details.invoice_id, item: item.item, quantity: item.quantity, cost: item.cost, vat: item.VAT }
        		// headers: { 
          //            'X-CSRFTOKEN': $('meta[name="csrf-token"]').attr('content'),
          //            "Authorization": 'Bearer '+ $('meta[name="csrf-token"]').attr('content'),
          //        }
    		}

            const res = await axios(config);
   
            return await res;
    }


    // Confirm Invoice Save
    async confirmSaveInvoice(invoice_details, status){
            console.log("calling confirm invoice save")

            const config = {	
        		method: 'post',
        		url: '/api/confirm-invoice-save',
        		params:{ invoice_id: invoice_details.invoice_id, status: status }
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