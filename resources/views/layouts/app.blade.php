<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name='author' content='Visual Elements Images Studio Inc. www.velements.com'>
    
{{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
{{-- angular --}}
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>


    <title>{{ config('app.name', 'GLA Inventory System') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <link href="/css/main.css" rel="stylesheet">
    <script src='{{asset("/js/main.js")}}'></script>


    <style>
    *{
        text-transform: uppercase !important;
        font-family: Arial,Helvetica,sans-serif !important;
    }
    button{
        text-transform: uppercase;
    }
    select option{
        text-transform: uppercase;
    }
    input{
        text-transform: uppercase;
    }
    input[type='date']{
        font-size: 75%;
    }
    html {
  overflow-y: scroll;
  text-transform: uppercase;
}
    .bigger{
        font-size: 18px;
    }
    @media screen {
      div.divFooter {
        display: none;
      }


      div.divHeader{
        display:none;
      }
    }
@media print {
    .print_hide{
        display: none;
      }

    div.divFooter {
        display: block;
        /*position: fixed;*/
        bottom: 0;
        width:100%;
        text-align: center;
        font-size: 18px;
        font-weight: 900;
    }
    div.divHeader {
        display: block;
        /*position: fixed;*/
        top: 0;
        width:100%;
        text-align: center;
        font-size: 18px;
        font-weight: 900;
    }

    .noprint div.editbutton{
        display:none;
    }
    a{
        display:none !important;
    }
    @page{
        size: auto;   /* auto is the initial value */
        margin: auto;
        margin-top: 0;
        margin-bottom:0;
        text-align: center;
    }
    #footer {
        display:none;
    }

    .panel{
        border: none;
        margin: auto;
    }

}
    
    a{
        cursor: pointer;
    }
    /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;

}

.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
   /* Vertically center the text there */
  background-color: white;
}
fieldset{padding:.35em .625em .75em;margin:0 2px;border:1px solid silver}
legend{padding:.5em;border:0;width:auto}


</style>





    
<body>
   
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style='min-width:1080px'>
            <div class="container" >
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                   {{--  <a class="navbar-brand" href="{{ url('/home') }}"> --}}
                        {{-- {{ config('app.logo', 'GLA Inventory System') }} --}}
                        <a href="/home"><img src="{{url('images/gla-logo.png')}}" style='height:50px; vertical-algin:text-top;' alt=""></a>
                    {{-- </a> --}}
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())

                             <script>
                            //     window.location.href = "{{url('/login')}}";
                            // </script>
                            
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            {{--  --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                
                                </ul>

                            </li>
                            @if(Auth::user()->userType==1)
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Admin <span class="caret"></span>
                                        </a>

                                         <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('/newUser') }}">New User</a></li>
                                            <li><a href="{{ url('/allUser') }}">All Users</a></li>
                                            <li><a href="{{ url('/admin/massCost') }}">Mass Cost</a></li>
                                            <li><a href="{{ url('/admin/massPrice') }}">Mass Price</a></li>
                                            <li><a href="{{ url('/admin/exchangeRate') }}">Change Exchange Rate</a></li>
                                            <li><a href="{{ url('/admin/setOrderPnt') }}">Set Order Pnt</a></li>
                                            <li><a href="{{ url('/admin/adjustInventory') }}">Adjust Inventory</a></li>
                                            <li><a href="{{ url('/admin/adjustHis_link') }}">Adjust History</a></li>
                                            <li><a href="{{ url('/admin/adjustHis_link_byDate') }}">Adjust History By date</a></li>
                                            <li><a href="{{ url('/admin/emailInvoice') }}">Email Invoice</a></li>
                                            <li><a href="{{ url('/admin/editModel') }}">Edit Item Model </a></li>
                                            <li><a href="{{ url('/admin/recall') }}">Item Recall </a></li>
                                            <li><a href="{{ url('/admin/PriceCodeCustomer') }}">Price Code Customer </a></li>
                                            <li><a href="{{ url('/admin/inventoryExcel') }}">Inventory Excel Report </a></li>
                                            <li><a href="{{ url('/admin/allocatedReport') }}">Allocated Report</a></li>
                                            <li><a href="{{ url('/admin/GLAAddress') }}">Ship To ADDRESS</a></li>
                                            <li><a href="{{ url('/admin/SalesTax') }}">Sale Tax By territory</a></li>
                                            {{-- <li><a href="{{ url('/admin/cupt') }}">Set Cu Ft and Duty Rate</a></li> --}}
                                        </ul>
                                    <li>        
                                   
                                @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style='min-width:1366px; min-height:768px;'>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default" style='margin-bottom:80px;'>
                        {{-- include navigation bar --}}
                        @yield('navigation')

                        <div class="panel-body" >
                            @yield('content')
                        </div>

                        <div ng-view></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer print_hide " style='min-width:1000px'>
      <div class="container ">
        <span class="text-muted"><b>©Golden Leaf Automotive Inc.. All rights reserved.<br>
            All data listed here are confidential. Do not Share the information without consent. Developed by </b><b style='color:#FFBA00'>Visual Elements Image Studio Inc.</b></span>
      </div>
    </footer>

    


    <!-- Scripts -->
    <script src="/js/app.js"></script>
    {{-- Scripts angular LiveSearch --}}
  
</body>
</html>
