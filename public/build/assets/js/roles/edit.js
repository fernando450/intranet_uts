const element= document.querySelector('.js-choice-edit');
const example = new Choices(element, {
    searchEnabled: false,
    removeItemButton: true,
    duplicateItemsAllowed: false,
});



$('#EditRole').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget) // Button that triggered the modal
    var id = a.data('id');
    var url = '/roles/'+id;
    var modal = $(this);

    example.removeActiveItems();


    $.get(url +'/edit'  ,null, function(data){

        modal.find('form').attr('action', url);
        modal.find('input[name=name]').val(data.rol['name']);
        console.log(data);
        example.setChoiceByValue(data.permissions);

    });
});
