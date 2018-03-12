<div class="panel-heading col-xs-12" style='text-align:center'>
   @if(Auth::user()->userType==1)
   <div class="col-xs-3">
      <a href="{{url('/Payable/home')}}"><b>Account Payable</b></a>
   </div>

   <div class="col-xs-3">
      <a href="{{url('/Receive/home')}}"><b>Account Receivable</b></a>       
   </div>
                        
    
   <div class="col-xs-3">
      <a href="{{url('/PO/home')}}"><b>Purchase Orders</b></a>                
   </div>

   <div class="col-xs-3">
      <a href="{{url('/SO/home')}}"><b>Sales Orders</b></a>                 
   </div>
   @else


      <div class="col-xs-6 text-center" >
         <a href="{{url('/Receive/home')}}"><b>Account Receivable</b></a>       
      </div>
                           
       
      

      <div class="col-xs-6 text-center" >
         <a href="{{url('/SO/home')}}"><b>Sales Orders</b></a>                 
      </div>
   @endif


   
</div>
<div class="col-xs-12">
   <h4>Location: HOME PAGE</h4>
</div>