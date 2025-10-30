<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">

    <div class="form-group col-md-6 py-2">
        <label for="name" class="control-label"><strong class="text-danger">* </strong>Nombre:</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" placeholder="Name" value="{{ (Session::has('errors')) ? old('name', '') : '' }}" required>
        {!! $errors->first('name', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
    <div class="form-group col-md-6 py-2">
        <label for="guard_name" class="control-label"><strong class="text-danger">* </strong>Guard Name:</label>
        <input type="text" name="guard_name" class="form-control  {{ $errors->has('guard_name') ? 'is-invalid' : ''}}" placeholder="WEB" disabled >
        {!! $errors->first('guard_name', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

</div>
