$('#userEdit').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget) // Button that triggered the modal
    var id = a.data('id');
    var url = '/users/'+id;
    var modal = $(this);

    $.get(url +'/edit'  ,null, function(data){
        modal.find('form').attr('action', url);
        modal.find('input[name=document_number]').val(data.user['document_number']);
        modal.find('input[name=name]').val(data.user['name']);
        modal.find('input[name=contact_number]').val(data.user['contact_number']);
        modal.find('input[name=email]').val(data.user['email']);
        modal.find('select[name=roles] option[value="'+data.roleUser+'"]').prop("selected", true);
        modal.find('select[name=state] option[value="'+data.user['state']+'"]').prop("selected", true);
    });
});
