@extends('app')
@section('content')

<div class="container">
    <div class="row">
      <h2></h2><br>
      <h2>Nombre - Tipo - Fecha </h2>
       
    </div>
</div>
<script type="text/javascript">
    $('.helper').tooltip({'placement': 'bottom'})
</script>
 <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
@endsection