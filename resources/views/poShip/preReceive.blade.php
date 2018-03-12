@extends('layouts.app')
@section('navigation')
  @include('navigation.nav_purchaseOrder')
@endsection
@section('content')
@if(session()->has('container_array'))
  <table class="table table-striped table-bordered text-center">
    <thead class='text-center'>
      <th class='text-center'>Item</th>
      <th class='text-center'>Shipped QTY </th>
      <th class='text-center'>Receive QTY </th>
    </thead>
    <tbody>
      @foreach(session()->get('container_array') as $key=>$item)
        
        <tr @if($item[0]!=$item[1]) class='danger' @endif>
          <td>{{$key}}</td>
          <td>{{$item[0]}}</td>
          <td>{{$item[1]}}</td>
        </tr>

      @endforeach
    </tbody>

  </table>
  <div class="container-fuild text-right">
      <button class="btn btn-default" style='min-width: 200px' onclick="goBack()">BACK</button>
      <a href='container_receive' class="btn btn-success" style='min-width: 200px' id='receive'>Receive</a>
  </div>
<script>
  function goBack() {
    window.history.back();
}

$('#receive').click(function(){
  $(this).attr("disabled", "disabled");
});
</script>

@endif
@endsection