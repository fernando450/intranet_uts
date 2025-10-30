$('#newsEdit').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget); // botón que abre el modal
    var id = a.data('id');
    var url = '/news/' + id;
    var modal = $(this);

    $.get(url+'/edit', null, function(data) {
        var data = data.news;

        modal.find('form').attr('action', url);
        modal.find('input[name=title]').val(data.title);
        modal.find('input[name=subtitle]').val(data.subtitle);
        modal.find('textarea[name=description]').val(data.description);
        modal.find('input[name=link]').val(data.link);
        modal.find('input[name=expiration_date]').val(data.expiration_date);
        //profile select
        modal.find('select[name=profile] option[value="'+data.profile+'"]').prop("selected", true);
    });
});