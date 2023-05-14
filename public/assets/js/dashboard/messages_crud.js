

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

function getSelectedMessagesIds(){
    let idsInput = document.querySelectorAll('input[type="checkbox"][name="ids[]"]');
    let ids=[];
    idsInput.forEach(input => {
        if(input.checked){
            ids.push(input.value);
        }
    });
    return ids;
}

$(document).ready(function(){
    //setup ajax to includ the csrf tokes so that we can make post requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button.archive').click(function(e) {
        e.target.textContent ='...';
        e.target.classList.add('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get car id
        let id = e.target.dataset.id;

        $.ajax({
            type: "POST",
            url: '/messages/'+id,
        })
        .done(function(response) {
            //message item
            $(`#message_item_${id}`).fadeOut(300);
            createAlert('success',response)
        })
        .fail(function(error) {
            createAlert('danger',error.responseText)
        })
        .always(function() {
            $(modal_id).modal('hide');
        });
    })

    $('button.restore').click(function(e) {
        e.target.textContent ='...';
        e.target.classList.add('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get car id
        let id = e.target.dataset.id;
        $.ajax({
            type: "POST",
            url: '/messages/'+id+'/restore',
        })
        .done(function(response) {
            //remove message item
            $(`#message_item_${id}`).fadeOut(300);
            createAlert('success',response)
        })
        .fail(function(error) {
            createAlert('danger',error.responseText)
        })
        .always(function() {
            $(modal_id).modal('hide');
        });
    })

    $('button.delete').click(function(e) {
        e.target.textContent ='...';
        e.target.classList.add('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get car id
        let id = e.target.dataset.id;
        $.ajax({
            type: "DELETE",
            url: '/messages/'+id,
        })
        .done(function(response) {
            //message item
            $(`#message_item_${id}`).fadeOut(300);
            createAlert('success',response)
        })
        .fail(function(error) {
            createAlert('danger',error.responseText)
        })
        .always(function() {
            $(modal_id).modal('hide');
        });
        
    })
    
    







    //bulk archive
    $("#bulk_archive").click(function(e){

        //change the button text and disable it
        $("#bulk_archive").text('...');
        $("#bulk_archive").addClass('disabled');
        //get the selected cars ids
        let ids = getSelectedMessagesIds();
        
        //make the post request
        $.post( "/messages/bulk_archive", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#message_item_${id}`).fadeOut(300);
                    });
                    createAlert('success',response)
                }else{
                    createAlert('info',"aucune messages n'a été sélectionnée")
                }
            })
            .fail(function(error) {
                createAlert('danger',error.responseText)
            })
            .always(function() {
                $("#bulk_archive").text('Archiver la sélection')
                $("#bulk_archive").removeClass('disabled');
                $('#bulkArchiveModal').modal('hide');
            });
    });


    //restore archive
    $("#bulk_restore").click(function(e){
        //change the button text and disable it
        $("#bulk_restore").text('...');
        $("#bulk_restore").addClass('disabled');
        //get the selected cars ids
        let ids = getSelectedMessagesIds();
        
        $.post( "/messages/bulk_restore", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#message_item_${id}`).fadeOut(300);
                    });
                    createAlert('success',response)
                }else{
                    createAlert('info',"aucune voiture n'a été sélectionnée")
                }
            })
            .fail(function(error) {
                createAlert('danger',error.responseText)
            })
            .always(function() {
                $("#bulk_restore").text('Archiver la sélection')
                $("#bulk_restore").removeClass('disabled');
                $('#bulkRestoreModal').modal('hide');

            });
    });


    //bulk delete
    $("#bulk_delete").click(function(e){
        //change the button text and disable it
        $("#bulk_delete").text('...');
        $("#bulk_delete").addClass('disabled');
        //get the selected cars ids
        let ids = getSelectedMessagesIds();
        
        //make the post request
        $.post( "/messages/bulk_delete", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#message_item_${id}`).fadeOut(300);
                    });
                    createAlert('success',response)
                }else{
                    createAlert('info',"aucune voiture n'a été sélectionnée")
                }
            })
            .fail(function(error) {
                createAlert('danger',error.responseText)
            })
            .always(function() {
                $("#bulk_delete").text('Rebublier la sélection')
                $("#bulk_delete").removeClass('disabled');
                $('#bulkDeleteModal').modal('hide');
            });
    });

});