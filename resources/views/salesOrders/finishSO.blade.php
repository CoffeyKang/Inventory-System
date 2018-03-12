@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
	<h1>Creating Sales Order {{$sono}} .</h1>

	<script language="JavaScript1.2" type="text/javascript">

		function delayURL(url) {
		var delay = $('#time').val();//取到id="time"的对象，.innerHTML取到对象的值
		//alert(delay);
		if(delay > 0) {
		   delay--;
		   $('#time').val(delay);
		} else {
		   window.location.href = url;//跳转到URL
		    }
		    setTimeout("delayURL('" + url + "')", 1000);    //delayURL() 就是每间隔1000毫秒 调用delayURL(url);
		}
	</script>

	Processing. <input type="hidden" id='time' name='time' value=3>

	<script type="text/javascript">  
		delayURL("/EntireSalesOrder?sono={{$sono}}"); //article.jsp 是N秒后要跳转的页面  
	</script>  
@endsection