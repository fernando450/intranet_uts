<div class="modal fade" id="editAvatar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header header-conectVida">
				<h5 class="modal-title" id="exampleModalLabel">Editar Avatar</h5>
				<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">x
				</button>
			</div>
			<form action="{{route('profile.avatar')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body">

                    <div class="input-group input-group-sm">
                        <div class="custom-file ">
                          <input type="file" name="ruta_foto" class="custom-file-input form-control-sm" accept="image/png, image/jpg, image/jpeg" required>
                          <label class="custom-file-label">Avatar</label>
                        </div>
                        @if ($errors->has('ruta_foto'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('ruta_foto') }}</strong>
                            </span>
                        @endif
                    </div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-danger">Guardar</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
