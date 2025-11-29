$('#documentEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // botón que abre el modal
    var id = button.data('id');
    var url = '/documents/' + id;
    var modal = $(this);

    $.get(url + '/edit', function (data) {
        var doc = data.document;
        //Quitar el atributo require al campo de archivo
        modal.find('input[name=file_route]').removeAttr('required');
        modal.find('form').attr('action', url); // actualiza la acción del formulario
        modal.find('input[name=code]').val(doc.code);
        modal.find('input[name=title]').val(doc.title);
        modal.find('textarea[name=description]').val(doc.description);
        modal.find('input[name=issue_date]').val(doc.issue_date);
        modal.find('input[name=expiration_date]').val(doc.expiration_date);
        modal.find('input[name=version]').val(doc.version);
        modal.find('select[name=profile] option[value="' + doc.profile + '"]').prop("selected", true);
        modal.find('select[name=state] option[value="' + doc.state + '"]').prop("selected", true);

        // Limpiar el campo de archivo (opcional)
        modal.find('input[name=file_route]').val('');
    });
});
