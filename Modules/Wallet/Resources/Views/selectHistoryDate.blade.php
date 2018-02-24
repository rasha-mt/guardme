@extends('wallet::layouts.app')

@section('title') 
Transactions History
@endsection

@section('content-app')
 <div id="controlPanel" class="panel-body" class="col-md-12 col-lg-12 col-sm-12">

<form method="POST" action="{{url('/account/wallet/list-history')}}" role="form" >
{{ csrf_field() }}
<input type="hidden" name="_method" value="POST">

  <div  class="panel-body" class="col-md-12 col-lg-12 col-sm-12">

	<div class="form-group col-sm-10 col-lg-10">
    <label for=""  class="form-group col-sm-3 col-lg-3 col-md-3" >Select History Start Date: <span class="required">*</span></label>
   			<div class="col-sm-8 col-lg-8">
		<input class="date form-control" type="date"  name="start" required>
 			 </div>
		</div>

		<div class="form-group col-sm-10 col-lg-10">
    <label for=""  class="form-group col-sm-3 col-lg-3 col-md-3" >Select History End Date: <span class="required">*</span></label>
   			<div class="col-sm-8 col-lg-8">
		<input class="date form-control" type="date"  name="end" required>
 			 </div>
		</div>

		</div>

		<div class="form-group col-sm-5 col-lg-5 ">
  <button type="submit"  class="btn btn-primary">Submit</button>
   </div>
    
</form>
</div>
@endsection