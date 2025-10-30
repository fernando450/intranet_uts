<div class="modal fade" id="EditRole">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-card">
                <h5 class="modal-title"  >Editar Rol</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
            <form action="" method="post" >
				<div class="modal-body">
					<input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">

                        <div class="form-group col-12 py-2">
                            <label for="name" class="control-label"><strong class="text-danger">* </strong>Nombre:</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre" value="{{ (Session::has('errors')) ? old('name', '') : '' }}" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group col-12 py-2">
                            <label for="permissions" class="control-label"><strong class="text-danger">* </strong>Permisos</label>
                            <select name="permissions[]" multiple class="form-control js-choice-edit {{ $errors->has('permissions') ? 'is-invalid' : ''}}">
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('permissions', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
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
