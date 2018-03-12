@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection
@section('content')

    <fieldset>

        <legend>Edit Sales Order {{$sono}}</legend>

        <div class="col-xs-12" style='text-align:center; padding: 100px 0;'>
            {{-- from =1 means come from edit entire order --}}

            <a href="/SO/EntireSO_add_new_item?sono={{$sono}}&&custno={{$custno}}" class="btn btn-default create" style='min-width:200px;'>Add New Item</a>
            
            <a href="/SO/UpdateSODetails_edit?sono={{$sono}}&&custno={{$custno}}" class="btn btn-warning create" style='min-width:200px;'>Edit Details</a>

            <a href="/SO/UpdateSODetails_Finish?sono={{$sono}}&&custno={{$custno}}" class="btn btn-success create" style='min-width:200px;'>Finish Edit</a>
        </div>
    </fieldset>

    <script>
    var f =0;
    $('.create').click(function(event){
    //event.preventDefault();
    
    f =1;
    console.log(123);
    console.log(f+' this is f');

  });
  
    console.log(f+'this is anthoer f')
    $(window).bind('beforeunload', function(){
      console.log('this is initial f ' + f);
      if(f==0){
        console.log('this is called');
        return 'Are you sure you want to leave? Item will lose without saving.';
      }}
    );
</script>

@endsection


