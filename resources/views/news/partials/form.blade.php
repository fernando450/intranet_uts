<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
    <div class="form-group col-md-6 py-2">
        <label for="title" class="control-label"><strong class="text-danger">* </strong>Titulo :</label>
        <input type="text" autocomplete="off" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" placeholder="Titulo de la noticia" value="{{ (Session::has('errors')) ? old('title', '') : '' }}" required>
        {!! $errors->first('title', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="subtitle" class="control-label">Subtitulo :</label>
        <input type="text" name="subtitle" class="form-control {{ $errors->has('subtitle') ? 'is-invalid' : ''}}" placeholder="Subtitulo de la noticia" value="{{ (Session::has('errors')) ? old('subtitle', '') : '' }}">
        {!! $errors->first('subtitle', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-12 py-2">
        <label for="description" class="control-label"><strong class="text-danger">* </strong>Descripción :</label>
        <textarea name="description" cols="30" rows="7" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" placeholder="Descripción de la noticia" value="{{ (Session::has('errors')) ? old('description', '') : '' }}" required></textarea>
        {!! $errors->first('description', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-12 py-2">
        <label for="link" class="control-label">Link (Opcional):</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-link p-1"></i></span>
            </div>
            <input type="url" class="form-control {{ $errors->has('link') ? 'is-invalid' : ''}}" placeholder="Redireccione por medio de un enlace" name="link" value="{{ old('link') }}">
        </div>
        {!! $errors->first('link', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="expiration_date"><strong class="text-danger">* </strong>Fecha de expiración:</label>
        <input type="date" class="form-control {{ $errors->has('expiration_date') ? 'is-invalid' : ''}}" placeholder="Fecha de expiración" id="expiration_date" name="expiration_date" required>
        {!! $errors->first('expiration_date', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <div class="form-group col-md-6 py-2">
        <label for="profile" class="control-label"><strong class="text-danger">* </strong>Perfil:</label>
        <select name="profile" class="form-control {{ $errors->has('profile') ? 'is-invalid' : ''}}" required>
            <option value="">Seleccione una opcion</option>
            <option value="" {{ ($profile == old('profile') ) ? 'selected' : '' }} >Todos"></option>
            @foreach($profiles as $profile)
                <option value="{{ $profile }}" {{ ($profile == old('profile') ) ? 'selected' : '' }} >{{ $profile }}</option>
            @endforeach
        </select>
        {!! $errors->first('profile', '<p class="help-block  text-danger">:message</p>') !!}
    </div>

    <!-- Selector de imágenes -->
    <div class="form-group col-md-12 py-2">
      <label for="imagenes" class="form-label">Selecciona hasta 4 imágenes</label>
      <input class="form-control imagenes" type="file" id="imagenes" accept="image/*" multiple>
    </div>

    <!-- Collage -->
    <div id="preview" class="d-flex flex-wrap preview"></div>

    <!-- Input oculto que llevará los archivos reales -->
    <input type="file" id="imagenesFinales" class="imagenesFinales" name="imagenes[]" multiple hidden>
</div>
