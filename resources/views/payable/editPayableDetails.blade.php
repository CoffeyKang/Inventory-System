@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')
    <fieldset>
        <legend>Apmast Total</legend>
            <table class="table table-striped table-bordered" >
                <thead>
                    <th>invoice #</th >
                    <th>duedate</th >
                    <th>vendor</th >
                    <th>company</th >
                    <th>puramt</th>
                </thead>
                <tbody>
                    <td>{{$payable->invno}}</td>
                    <td>{{$payable->duedate}}</td>
                    <td>{{$payable->vendno}}</td>
                    <td>{{$payable->vendor['company']}}</td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input name='puramt' value='{{$payable->puramt}}' type='text' readonly>
                        </div></td>
                </tbody>
            </table>
    </fieldset>

    <fieldset>
        <legend>Apmast Details</legend>
        <?php $i =1; ?>
            <div class="col-xs-12">
                <table class="table table-striped  col-xs-12" >
                    <thead>
                        <th>Seq</th >
                        <th>Dist Acct</th >
                        <th>Description</th >
                        <th>Dist Amount</th >
                        <th></th>
                    </thead>
                    <tbody>
                        @if(isset($apdist))
                            
                            @foreach($apdist as $temp)
                                
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$temp->account}}</td>
                                    <td>{{$temp->glacnt['gldesc']}}</td>
                                    <td>{{$temp->amount}}</td>
                                    <th class="col-xs-1"><a href="#" data-toggle="modal" data-target="#{{$i}}" class='btn btn-warning create' style='min-width:155px;'>Edit</a></th>
                                </tr>


                                {{-- model --}}


<div class="modal fade" id="{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            


            <div class="modal-body">
                <fieldset><legend>Edit Payable Details</legend>
                    <form action="/Payable/update_apdist" method='get'>
                        <input type="hidden" name='vendno' value='{{$temp->vendno}}'>
                        <input type="hidden" name='invno' value='{{$temp->invno}}'>
                        <input type="hidden" name='pstdate' value='{{$temp->pstdate}}'>
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" class="form-control" id="account" name='account' value='{{$temp->account}}' readonly>
                        </div>

                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control" id="Description" name='Description' value='{{$temp->glacnt["gldesc"]}}' readonly>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name='amount' value='{{$temp->amount}}' >
                        </div>

                        <div class="form-group" style='text-align:right'>
                            <button class='btn btn-default' type='reset' data-dismiss="modal">Cancel</button>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </div>
                    </form>
                </fieldset>
            </div>

        </div>
    </div>
</div>


                            @endforeach

                        @endif
                        
                        <form action="/Payable/toAPDIST" method='get'>
                            <input type="hidden" name='invno' value='{{$payable->invno}}'>
                            <input type="hidden" name='vendno' value='{{$payable->vendno}}'>
                            
                            <tr>
                                <td>{{$i++}}</td>
                                <td><input type="text" style='background-color:lightblue' id='defacct' name='defacct' class="form-control" value='{{$payable->vendor["defacct"]}}'></td>
                                <td><input type="text" class="form-control" id='defacct_desc' name='defacct_desc' readonly></td>
                                <td><input type="text" class="form-control" value='' id='defacct_amt' name='defacct_amt'></td>
                                <td><input type='submit'  class='btn btn-primary create' style='padding-right:50px; padding-left:50px;' value='Submit'></td>
                            </tr>
                        </form>

                    </tbody>
                </table>
            </div>
        <div class="col-xs-12" style='text-align:right'>

                <input type="hidden" name='invno' value='{{$invno}}'>
                <a href="" style='min-width:240px' data-toggle="modal" data-target="#voidapmast" class="btn btn-warning">VOID</a>
                <a href='searchPayable' style='min-width:240px' class="btn btn-primary create" id='finish'>Finish</a>
        </div>   


           
    </fieldset>

    {{-- void apmast double check modal --}}
    <div class="modal fade" id="voidapmast" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Void Apmast</h4>
          </div>
          <div class="modal-body">
            <h5>Are you sure to void the payable?</h5> <h5>If you void the payable, the payable details will also be delete.</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <a href='/Payable/voidPayable?invno={{$payable->invno}}' type="button" class="btn btn-danger">Void Payable</a>
          </div>
        </div>
      </div>
    </div>

    {{-- void apmast double check modal ends --}}
        

            
    <script>
        $('#defacct').blur(function(){
            $value = $(this).val();
            console.log($value);
            $.ajax({
                type : 'get',
                url :"{{url('/api/accountDescription')}}",
                data:{'glacnt': $value},
                success:function(data){
                    console.log(data.gldesc);
                    
                    $('#defacct_desc').val( data.gldesc);
                }
            });
        });
    </script>
    
@endsection