function createAlert(type,message){
    let alerts_container = document.querySelector("#alerts_container");
    let alert_success = document.createElement('div');
    alert_success.classList.add('alert');
    alert_success.classList.add('alert-'+type); //alert-success or  alert-danger
    alert_success.classList.add('fade');
    alert_success.classList.add('in');
    alert_success.textContent = message;
    let ancorTag = document.createElement('a');
    ancorTag.classList.add('close');
    
    ancorTag.setAttribute('data-dismiss', "alert") ;
    ancorTag.innerHTML = "&times;"

    alert_success.append(ancorTag)
    alerts_container.append(alert_success)
}


$(document).ready(function(){
    //setup ajax to includ the csrf tokes so that we can make post requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button.delete').click(function(e) {
        e.target.textContent ='...';
        e.target.classList.add('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get admin id
        let id = e.target.dataset.id;

        $.ajax({
            type: "DELETE",
            url: '/admins/'+id,
        })
        .done(function(response) {
            //remove table row
            $(`#table_row_${id}`).remove();
            createAlert('success',response)
        })
        .fail(function(error) {
            createAlert('danger',error.responseText)
        })
        .always(function() {
            $(modal_id).hide(500);
        });
    })

    $('button.super').click(function(e) {
        e.target.textContent ='...';
        e.target.classList.add('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get admin id
        let id = e.target.dataset.id;

        $.ajax({
            type: "POST",
            url: '/admins/make_super_admin/'+id,
        })
        .done(function(response) {
            //remove table row
            $(`#table_row_${id}`).remove();
            createAlert('success',response)
        })
        .fail(function(error) {
            createAlert('danger',error.responseText)
        })
        .always(function() {
            $(modal_id).hide(500);
        });
    })

})