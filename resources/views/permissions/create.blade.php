<div class="modal fade" id="createPermission">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-card">
				<h5 class="modal-title"  >Crear Permiso</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form action="{{route('permissions.store')}}" method="post">
				<div class="modal-body">
                    @include('permissions.partials.form')
				</div>
				<div class="modal-footer">
					<button type="submit"class="btn btn-primary"  onclick="spinner(event,this)">
						<span class="spinner-border spinner-border-sm" id="spinner" role="status" hidden aria-hidden="true"></span>
						Crear
					</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
