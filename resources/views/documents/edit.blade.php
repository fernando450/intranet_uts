<div class="modal fade" id="documentEdit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-card">
                <h5 class="modal-title" >Editar documento</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="_method" value="put">
                    @include('documents.partials.form')
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"  onclick="spinnerM(event,this,1)">
						<span class="spinner-border spinner-border-sm" id="spinner1" role="status" hidden aria-hidden="true"></span>
						Actualizar
					</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
