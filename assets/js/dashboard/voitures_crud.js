

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

function getSelectedCarIds(){
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
            url: '/voitures/'+id,
        })
        .done(function(response) {
            //remove table row
            $(`#table_row_${id}`).fadeOut(300);
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
            url: '/voitures/'+id+'/restore',
        })
        .done(function(response) {
            //remove table row
            $(`#table_row_${id}`).fadeOut(300);
            createAlert('success',response);
        })
        .fail(function(error) {
            createAlert('danger',error.responseText);
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
            url: '/voitures/'+id,
        })
        .done(function(response) {
            //remove table row
            $(`#table_row_${id}`).fadeOut(300);
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
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get the selected cars ids
        let ids = getSelectedCarIds();
        
        //make the post request
        $.post( "/voitures/bulk_archive", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#table_row_${id}`).fadeOut(300);
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
                $("#bulk_archive").text('Archiver la sélection')
                $("#bulk_archive").removeClass('disabled');
                $(modal_id).modal('hide');
            });
    });


    //restore archive
    $("#bulk_restore").click(function(e){
        //change the button text and disable it
        $("#bulk_restore").text('...');
        $("#bulk_restore").addClass('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get the selected cars ids
        let ids = getSelectedCarIds();
        
        $.post( "/voitures/bulk_restore", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#table_row_${id}`).fadeOut(300);
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
                $(modal_id).modal('hide');
            });
    });


    //bulk delete
    $("#bulk_delete").click(function(e){
        //change the button text and disable it
        $("#bulk_delete").text('...');
        $("#bulk_delete").addClass('disabled');
        //get modal id
        let modal_id = e.target.dataset.toggleModal;
        //get the selected cars ids
        let ids = getSelectedCarIds();
        
        //make the post request
        $.post( "/voitures/bulk_delete", { ids: ids})
            .done(function(response) {
                if(response){
                    ids.forEach(id => {
                        $(`#table_row_${id}`).fadeOut(300);
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
                $(modal_id).modal('hide');

            });
    });

});