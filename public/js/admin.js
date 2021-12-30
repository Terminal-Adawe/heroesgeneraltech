 $(document).ready(function(){
    $('.delete_service').off('click').on('click',function(){
        console.log("delete")
        var html_name = document.getElementsByClassName("anym")
        var type = document.getElementById("seType")
        var i_id = document.getElementById("id_")
        var sid = document.getElementById("sid")
        const serviceID_ = document.getElementById("service_id");

        for (var i = 0; i < html_name.length; i++) {
            // y[i].style.backgroundColor = "red";
            html_name[i].innerHTML = "Service"
        } 

        type.value = "service";
        i_id.value = serviceID_.value;
        sid.value = serviceID_.value;

        console.log(i_id.value)
    })
 })