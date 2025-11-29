<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
    <div class="form-group col-md-6 py-2">
        <label for="code" class="control-label"><strong class="text-danger">* </strong>Código:</label>
        <input type="text" autocomplete="off" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}" placeholder="Código del documento" value="{{ (Session::has('errors')) ? old('code', '') : '' }}" required>
        {!! $errors->first('code', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="title" class="control-label"><strong class="text-danger">* </strong>Título:</label>
        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" placeholder="Título del documento" value="{{ (Session::has('errors')) ? old('title', '') : '' }}" required>
        {!! $errors->first('title', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="file_route" class="control-label"><strong class="text-danger">* </strong>Archivo:</label>
        <input type="file" name="file_route" class="form-control {{ $errors->has('file_route') ? 'is-invalid' : ''}}">
        {!! $errors->first('file_route', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="version" class="control-label"><strong class="text-danger">* </strong>Versión:</label>
        <input type="text" autocomplete="off" name="version" class="form-control {{ $errors->has('version') ? 'is-invalid' : ''}}" placeholder="Ej: v1.0" value="{{ (Session::has('errors')) ? old('version', '') : '' }}" required>
        {!! $errors->first('version', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-12 py-2">
        <label for="description" class="control-label">Descripción:</label>
        <textarea name="description" rows="2" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" placeholder="Descripción del documento">{{ (Session::has('errors')) ? old('description', '') : '' }}</textarea>
        {!! $errors->first('description', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="issue_date" class="control-label"><strong class="text-danger">* </strong>Fecha de emisión:</label>
        <input type="date" name="issue_date" class="form-control {{ $errors->has('issue_date') ? 'is-invalid' : ''}}" value="{{ (Session::has('errors')) ? old('issue_date', '') : '' }}" required>
        {!! $errors->first('issue_date', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="expiration_date" class="control-label">Fecha de expiración:</label>
        <input type="date" name="expiration_date" class="form-control {{ $errors->has('expiration_date') ? 'is-invalid' : ''}}" value="{{ (Session::has('errors')) ? old('expiration_date', '') : '' }}">
        {!! $errors->first('expiration_date', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="profile" class="control-label">Perfil:</label>
        <select name="profile" class="form-control {{ $errors->has('profile') ? 'is-invalid' : ''}}">
            <option value="">Seleccione un perfil</option>
            @foreach($profiles as $profile)
                <option value="{{ $profile }}" {{ ($profile == old('profile') ) ? 'selected' : '' }}>{{ $profile }}</option>
            @endforeach
        </select>
        {!! $errors->first('profile', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="state" class="control-label"><strong class="text-danger">* </strong>Estado:</label>
        <select name="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : ''}}" required>
            <option value="">Seleccione un estado</option>
            @foreach($states as $state)
                <option value="{{ $state }}" {{ ($state == old('state') ) ? 'selected' : '' }}>{{ $state }}</option>
            @endforeach
        </select>
        {!! $errors->first('state', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

</div>