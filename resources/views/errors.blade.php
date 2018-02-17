@extends ('app')
  
@section ('content')
 @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Please dont try to enter this way</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
      @endforeach
      </ul>
    </div>
    <?php
    if (Session::has('backUrl')) {
        Session::keep('backUrl');
      }
     $url = Session::get('backUrl');
               // return Redirect($url);
    ?>
      <a href="{{ $url }}" class="btn btn-info btn-xs">Volver</a>
  @endif
@stop