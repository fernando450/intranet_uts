<div class="modal fade" id="showTeacher">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-card">
                <h5 class="modal-title text-secondary" >Noticia</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
            <div class="modal-body">
                <!-- Dentro del modal -->
                <div class="card shadow-sm">
                    <div class="row g-0">

                        <!-- Columna izquierda: carrusel + noticia principal -->
                        <div class="col-md-6 p-3">
                            <!-- Carousel dinámico -->
                            <div id="carouselNews" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner text-center" id="carousel-inner-news">
                                <!-- Aquí van las imágenes -->
                                </div>
                            </div>
                        </div>

                        <!-- Columna derecha: comentarios -->
                        <div class="col-md-6 border-start p-3">
                            <!-- Contenido principal -->
                            <div class="card-body">
                                <h5 class="card-title" id="news-title"></h5>
                                <h6 class="text-danger mb-2" id="news-subtitle"></h6>
                                <a href="#" id="news-link" target="_blank" class="btn btn-sm btn-primary">Ver más</a>
                            </div>
                        </div>

                        <div class="col-md-12 p-3" style="border-top: 1px solid #ccc">                        
                            <p id="news-description" style="text-align: justify"></p>
                            <h6>Comentarios</h6>
                            <ul class="list-group list-group-flush" id="news-comments">
                                <!-- Aquí se cargan los comentarios -->
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    salir
                </button>
            </div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
