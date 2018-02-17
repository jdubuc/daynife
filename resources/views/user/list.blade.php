@extends('app')

<?php
use App\User;
use App\Account;
use App\Empresa;
//$userjesus = user::find(3);
//dd( Hash::check('12345678', $userjesus->password) );
//dd ( bcrypt('12345678') == $userjesus->password)
//dd($user);
?>
@section ('title') Lista de Usuarios @stop

@section ('content')

  <h1>Lista de usuarios</h1>
  
  <table class="table table-striped" style="width: 100%">
    <tr>
        <th>Email</th>
        <th>nombre</th>
        <th>apellido</th>
        <th>telefono</th>
        <th>Cuenta</th>
         <th>contraseña</th>
        <th>tipo de cuenta</th>
        <th>Creador por</th>
        <th>Opciones</th>



    </tr>
    @foreach ($user as $users)
      
      <tr>
          <td>{{ $users->email }}</td>
          <td>{{ $users->firstName }}</td>
          <td>{{ $users->lastName }}</td>
          <td>{{ $users->phoneNumber }}</td>
          <td>
          @if($users->pOperator != '9000')
            <?php
            $currentAccount = Empresa::find($users->idEmpresa);

            ?>
            {{ $currentAccount->name }} 
          @endif
          </td>
          <td> {{ bcrypt('hello word') }} 

          </td>
          <td>
            @if($users->type == '4500')
              Admin users
            @endif
            @if($users->type == '1')
              usuario
            @endif
            @if($users->type == '2')
              operador
            @endif
          </td>
           <td>
            <?php
            $userc = user::find($users->idPersonCreator);

            ?>
            @if($userc != null)
            {{ $userc->firstName }} {{ $userc->lastName }}
            @endif
          </td>

          <td>
            <a href="{{ route('user.edit', $users->id) }}" class="btn btn-primary">
              Editar
            </a>
          
          </td>
      </tr>
          Eliminar {!! Form::open(array('route' => array('user.destroy', '$userc->id'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
          {!! Form::close() !!}
    @endforeach
  </table>



<?php echo $user->render(); ?>
@stop