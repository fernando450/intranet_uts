@if(! $errors->isEmpty())
    <div class="alert alert-danger alert-dismissible mx-4" role="alert">
        <span class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
        <ul>
			@foreach($errors->getMessages() as $key => $error)
				<li>{{$key}} - {{$error[0]}}</li>
			@endforeach
		</ul>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
