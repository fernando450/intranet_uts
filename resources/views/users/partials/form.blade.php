<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
    <div class="form-group col-md-6 py-2">
        <label for="document_number" class="control-label"><strong class="text-danger">* </strong>Numero documento:</label>
        <input type="text" autocomplete="off" name="document_number" class="form-control {{ $errors->has('document_number') ? 'is-invalid' : ''}}" placeholder="Numero Documento" value="{{ (Session::has('errors')) ? old('document_number', '') : '' }}" required>
        {!! $errors->first('document_number', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="name" class="control-label"><strong class="text-danger">* </strong>Nombre completo:</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Nombre completo" value="{{ (Session::has('errors')) ? old('name', '') : '' }}" required>
        {!! $errors->first('name', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="contact_number" class="control-label"><strong class="text-danger">* </strong>Celular:</label>
        <input type="number" name="contact_number" class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : ''}}" placeholder="Celular" value="{{ (Session::has('errors')) ? old('contact_number', '') : '' }}" required>
        {!! $errors->first('contact_number', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="email" class="control-label"><strong class="text-danger">* </strong>Email:</label>
        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email" name="email" value="{{ old('email') }}" required>
        {!! $errors->first('email', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="password"><strong class="text-danger">* </strong>Contraseña:</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password" name="password">
        {!! $errors->first('password', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="password"><strong class="text-danger">* </strong>Confirmar Contraseña:</label>
        <input type="password" class="form-control {{ $errors->has('confirm-password') ? 'is-invalid' : ''}}" placeholder="Confirmar Contraseña" name="confirm-password">
        {!! $errors->first('confirm-password', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="roles" class="control-label"><strong class="text-danger">* </strong>Role</label>
        <select name="roles" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}"required>
            <option value="">Seleccione un Rol</option>
            @foreach($roles as $dato)
                <option value="{{$dato}}" {{ ($dato == old('roles') ) ? 'selected' : '' }} >{{$dato}}</option>
            @endforeach
        </select>

        @if ($errors->has('roles'))
            <span class="help-block  text-danger">
                <strong>{{ $errors->first('roles') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6 py-2">
    <label for="nit" class="control-label"><strong class="text-danger">* </strong>Estado:</label>
        <select name="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : ''}}" required>
            <option value="">Seleccione una opcion</option>
            @foreach($states as $state)
                <option value="{{ $state }}" {{ ($state == old('state') ) ? 'selected' : '' }} >{{ $state }}</option>
            @endforeach
        </select>
        {!! $errors->first('state', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

</div>
