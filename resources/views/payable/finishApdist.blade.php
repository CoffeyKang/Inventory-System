@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	 <fieldset>
	 <legend>New Payable.</legend>

	<div style='padding-bottom:200px; padding-top:100px; text-align:center'>
		<div class="row">
			<a style='min-width:150px' href="/Payable/newPayable1" class="btn btn-success" >Enter other Payable</a>
			<a style='min-width:150px' href="/showPayableReport?begin={{date('Y-m-d')}}&end={{date('Y-m-d')}}" class="btn btn-danger">Finish and Report</a>
		</div>
	</div>
	<div class="col-xs-4" style='text-alignL:left'></div>


	</fieldset>

	<script language="JavaScript1.2" type="text/javascript">

	// 	function delayURL(url) {
	// 	var delay = $('#time').val();//取到id="time"的对象，.innerHTML取到对象的值
	// 	//alert(delay);
	// 	if(delay > 0) {
	// 	   delay--;
	// 	   $('#time').val(delay);
	// 	} else {
	// 	   window.location.href = url;//跳转到URL
	// 	    }
	// 	    setTimeout("delayURL('" + url + "')", 1000);    //delayURL() 就是每间隔1000毫秒 调用delayURL(url);
	// 	}
	// </script>

	{{-- Processing. <input type="hidden" id='time' name='time' value=3> --}}

	<script type="text/javascript">  
	// 	delayURL("/Receive/home"); // 是N秒后要跳转的页面  
	// </script>  
@endsection