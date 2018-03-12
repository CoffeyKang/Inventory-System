@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<fieldset>
  		<legend>Inventory Item Recall</legend>
  		<div class="col-xs-12">
  			@if(session('status'))

				<div class="alert alert-success">
					{{session()->get('status')}}
				</div>

  			@endif
  		</div>
  		<table class="table table-striped text-center">
  			<thead>
  				<th  class='text-center'>
  					Item Number
  				</th>
  				<th  class='text-center'>
  					Recall
  				</th>
          <th class="text-center">
            DELETE
          </th>
  			</thead>
  			<tbody>
  				@foreach($items as $item)
					<tr>
						<form action="/admin/itemRcall">
							<td>{{$item->item}} <input type="hidden" name='item' value='{{$item->item}}'></td>
							<td><button class="btn btn-success">
								recall
							</button></td>
              <td><a href="/admin/itemDeleted?item={{$item->item}}" class="btn btn-danger">Delete</a></td>
						</form>
					</tr>
					

  				@endforeach
  			</tbody>
  		</table>
      
	</fieldset>


@endsection
