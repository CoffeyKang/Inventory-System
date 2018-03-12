@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')
    <fieldset>

        
            <h4>Distribution Entry for Invoice ==> {{$invno}}  &nbsp;&nbsp;&nbsp;&nbsp;Total ==> $ {{$puramt}}</h4>
            <h4>Vendor Number / Name ==> {{$vendor->vendno}} &nbsp;/&nbsp; {{$vendor->company}}</h4>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="vendno" class="control-label col-xs-2"> Control Account:</label>
                    <div class='col-xs-4'>
                        <select name="accountType" id="accountType" class='form-control'>
                            @foreach($account as $acc)
                                <option value="{{$acc->glacnt}}">{{$acc->glacnt}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="vendno" class="control-label col-xs-1"> Descrip:</label>
                    <div class='col-xs-5'>
                        <input  id="accountDescription" class='form-control' readonly>
                            
                        
                    </div>
                </div>
                <hr>
            </div>

            <div class="col-xs-6 col-xs-offset-6" style='text-align:right'>
                    <h4><b>Balance Remaining to Destribute: <span id="destBalance"> $ {{$puramt}} </span></b></h4>
                     <hr>
                     <input type="hidden" name='isZero' id='isZero' value=' {{$puramt}} '>       
            </div>
        <?php $i =1; ?>
        
        @if(isset($no_account))
            
            <div class="col-xs-12 alert alert-danger">
    
                {{$no_account}}            

            </div>            

        @endif
            <div class="col-xs-12">
                <table class="table table-striped  col-xs-12" >
                    <thead>
                        <th class='col-xs-1'>Seq</th >
                        <th class='col-xs-3'>Dist Acct</th >
                        <th class='col-xs-3'>Description</th >
                        <th class='col-xs-2'>Dist Amount</th >
                            <th class="col-xs-1"><a href="/Payable/eidtTEMPDIST?invno={{$invno}}" class='btn btn-primary create' style='min-width:140px;'>Edit</a></th>
                    </thead>
                    <tbody>
                        @if(isset($tempAPDIST))
                            
                            @foreach($tempAPDIST as $temp)
                                
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$temp->account}}</td>
                                    <td>{{$temp->description}}</td>
                                    <td>{{$temp->amount}}</td>
                                    
                                </tr>


                            @endforeach

                        @endif
                        
                        <form action="/Payable/toTempAPDIST" method='post'>
                            <input type="hidden" name='invno' value='{{$invno}}'>
                            <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
                            <input type="hidden" name='puramt' value='{{$puramt}}'>
                            
                            <tr>
                                <td>{{$i++}}</td>
                                <td><input type="text" style='background-color:lightblue' id='defacct' name='defacct' class="form-control" value='{{$vendor->defacct}}'></td>
                                <td><input type="text" class="form-control" id='defacct_desc' name='defacct_desc' readonly></td>
                                <td><input type="text" class="form-control" value='{{$puramt}}' id='defacct_amt' name='defacct_amt'></td>
                                <td><input type='submit'  class='btn btn-primary create' style='padding-right:50px; padding-left:50px;' value='Submit'></td>
                            </tr>
                        </form>

                    </tbody>
                </table>
            </div>
        <div class="col-xs-12" style='text-align:right'>

            <form action="/Payable/apdist_finish">
            <input type="hidden" name='invno' value='{{$invno}}'>
            <a href="/Payable/anotherPayable?vendno={{$vendor->vendno}}&invno={{$invno}}" style='min-width:240px' class='btn btn-success create' id='another'>Enter Another Payable</a>
            <a href="#" style='min-width:240px' data-toggle="modal" data-target="#voidapmast" class="btn btn-warning">VOID</a>
            <button style='min-width:240px' class="btn btn-primary create" id='finish'>Finish</button>
        </div>   </form>

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
                        <a href='/Payable/voidPayable?invno={{$invno}}' type="button" class="btn btn-danger create">Void Payable</a>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- void apmast double check modal ends --}} 
    </fieldset>

    <script>
    $('#accountType').val('{{$vendor->ctrlacct}}');
    $('#accountDescription').val('Accounts Payable PURCHASE');
        function accountDescription(){
           $value = $('#accountType').val();
            console.log($value);
            $.ajax({
                type : 'get',
                url :"{{url('/api/accountDescription')}}",
                data:{'glacnt': $value},
                success:function(data){
                    console.log(data.gldesc);
                    
                    $('#accountDescription').val( data.gldesc);
                }
            }); 
        }

        accountDescription();


        $('#accountType').change(function(){
            $value = $(this).val();
            console.log($value);
            $.ajax({
                type : 'get',
                url :"{{url('/api/accountDescription')}}",
                data:{'glacnt': $value},
                success:function(data){
                    console.log(data.gldesc);
                    
                    $('#accountDescription').val( data.gldesc);
                }
            });
        });

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

        var f=0;
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


        var isZero = $('#isZero').val();
        console.log(isZero+'------------------');
        if(isZero==0){
            
        }else{
            $('#finish').click(function(e){
                alert("The total amount is not equal to the Puramt !");
                e.preventDefault();
            });

            $('#another').click(function(e){
                alert("The total amount is not equal to the Puramt !");
                e.preventDefault();
            });

        }

        
        

        
    </script>
@endsection