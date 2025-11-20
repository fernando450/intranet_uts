<div class="modal fade" id="editAvatar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-card">
				<h5 class="modal-title">Editar Avatar</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form action="{{route('profile.avatar')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="mb-3">
						<label for="avatar_route" class="form-label fw-semibold">Avatar</label>
						<div class="input-group">
						<input 
							class="form-control" 
							type="file" 
							id="avatar_route" 
							name="avatar_route" 
							accept="image/png, image/jpg, image/jpeg" 
							required
						>
						</div>
						@error('avatar_route')
							<div class="invalid-feedback d-block">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary" onclick="spinnerM(event,this,4)">
						<span class="spinner-border spinner-border-sm" id="spinner4" role="status" hidden aria-hidden="true"></span>
						Guardar
					</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
