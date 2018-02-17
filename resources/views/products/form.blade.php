@extends('app')

<?php
use App\user;
//use App\Account;
//use App\Session;

    if ($user->exists):
        $form_data = array('route' => array('user.update', $user->id), 'method' => 'PATCH');
        $action    = 'Edit';
    else:
        $form_data = array('route' => 'user.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>
@section ('content')

<h1>{!! $action !!} Usuario</h1>

{!! Form::model($user, $form_data, array('role' => 'form')) !!}

  @include ('user/errors', array('errors' => $errors))

  <div class="row">
  <div class="form-group col-md-4">
      {!! Form::label('firstName', 'FistName') !!}
      {!! Form::text('firstName', null, array('placeholder' => 'FirstName', 'class' => 'form-control')) !!}        
    </div>
    <div class="form-group col-md-4">
      {!! Form::label('lastName', 'LastName') !!}
      {!! Form::text('lastName', null, array('placeholder' => 'lastName', 'class' => 'form-control')) !!}        
    </div>
    <div class="form-group col-md-4">
      {!! Form::label('email', 'Email') !!}
      {!! Form::text('email', null, array('placeholder' => 'Email', 'class' => 'form-control')) !!}
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-4">
      {!! Form::label('password', 'password') !!}
      {!! Form::password('password', array('class' => 'form-control')) !!}
    </div>
    <div class="form-group col-md-4">
      {!! Form::label('password_confirmation', 'Password Confirmation') !!}
      {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
    </div>
  </div>


  <div class=" col s6 ">
  <?php
   //$currentUser= Auth::user(); 
    $empresa = Empresa::all();
   ?>
    <select multiple="multiple" name="idEmpresa">
      <option value="" disabled selected>Click para seleccionar los cuenta</option>
        @foreach ($empresa as $empresa)
          <option value="{{ $empresa->id }}"> {{$empresa->name}} </option>
        @endforeach
     </select>
  </div>
  
  {!! Form::button('Aceptar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}    
  
{!! Form::close() !!}

@stop