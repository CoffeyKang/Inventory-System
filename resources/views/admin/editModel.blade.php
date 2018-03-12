@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    <legend>Edit Item Model</legend>
    <form action="/admin/updateModel" method='get' class='form-horizontal'>
        <div class="col-xs-12">
            <div class="col-xs-8">
                <div class="form-group">
                    <label for="shipby" class='control-label col-xs-4'>Item Number</label>
                    <div class="col-xs-8">
                        <input type='text' class='form-control' name='item' id='item' >
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary" style='min-width:200px'>Edit Model</button>
            </div>
            
        </div>
    <hr>
    </form>
    

    <table class="table table-striped" id='searchResultTable' style='font-size:14px'>

        <thead>
          <tr>
            
            <th class='col-xs-6 '>Description</th>
            <th class='col-xs-2 '>Item No.</th>
            <th class='col-xs-2 '>Price</th>
            <th class='col-xs-1 '>OnHand</th>
            <th class='col-xs-1 '>TTD</th>
            
          </tr>
        </thead>
        <tbody >
            

        </tbody>

    </table>
    </fieldset>
<script>

        $('thead').hide();

        $("#item").on('keyup',function(){

            $value = $("#item").val();
            console.log($value);
            if ($value.length>=1) {
                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/searchItemByNo_model')}}",
                    data:{'item':$value},
                    success:function(data){
                   // console.log(data);
                    if (data.length>=1) {

                        $('thead').show();
                    }else{
                        $('thead').hide();
                    };

                    $('tbody').html(data);
                    


                    }
                });
                }else{
                    $('tbody').hide();
                    $('thead').hide();
                }
        });

        





    
        
    </script>
  
    


@endsection
