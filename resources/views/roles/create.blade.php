<div class="modal fade" id="createRole">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-card">
				<h5 class="modal-title"  >Crear rol</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form action="{{route('roles.store')}}" method="post">
				<div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">

                        <div class="form-group col-md-6 py-2">
                            <label for="name" class="control-label"><strong class="text-danger">* </strong>Nombre:</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre" value="{{ (Session::has('errors')) ? old('name', '') : '' }}" required>
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="form-group col-md-6 py-2">
                            <label for="permissions" class="control-label"><strong class="text-danger">* </strong>Permisos</label>
                            <select name="permissions[]" multiple class="form-control js-choice">
                                <option value="">Seleccione uns opción</option>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"  onclick="spinner(event,this)">
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
