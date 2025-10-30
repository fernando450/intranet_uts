$('#showNews').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget); // botón que abre el modal
    var id = a.data('id');
    var url = '/news/' + id;
    var modal = $(this);

    $.get(url, null, function(data) {
        var data = data.news;
        // Llenar título, subtítulo, descripción y link
        modal.find('#news-title').text(data.title);
        modal.find('#news-subtitle').text(data.subtitle);
        modal.find('#news-description').text(data.description);
        modal.find('#news-link').attr('href', data.link);

        // --- Carrusel de imágenes ---
        var carouselInner = modal.find('#carousel-inner-news');
        carouselInner.empty(); // limpiamos primero
        if (data.files && data.files.length > 0) {
            data.files.forEach(function(img, index) {
                var activeClass = index === 0 ? 'active' : '';
                carouselInner.append(`
                  <div class="carousel-item ${activeClass}">
                    <img src="/storage/${img.file_route}" class="d-block mx-auto" style="width:80%; border-radius: 10px" alt="Imagen">
                  </div>
                `);
            });
        }

        // --- Comentarios ---
        var commentsList = modal.find('#news-comments');
        commentsList.empty();
        if (data.comments && data.comments.length > 0) {
            data.comments.forEach(function(c) {
                commentsList.append(`
                  <li class="list-group-item">
                    <strong>${c.user}</strong>: ${c.text}
                  </li>
                `);
            });
        } else {
            commentsList.append('<li class="list-group-item text-muted">No hay comentarios aún</li>');
        }
    });
});
