@extends('wallet::layouts.app')

@section('title') 
List Transactions History
@endsection

@section('content-app')

                <div id="controlPanel" class="panel-body" class="col-md-12 col-lg-12 col-sm-12">

    @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                   <span style="color:#000"> {!! $message !!}</span>
                </div>
                <?php Session::forget('success');?>
                @endif
                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
   <table id="table" class="display" cellspacing="0" width="100%">
  
        <thead>
            <tr>

  			   <th>Paypal Account</th>
			   <th>Amount</th>
			   <th>Pay</th>
			   </tr>
        </thead>

   @foreach($data as $row)

   <tr>
<td>{{ $row->paypal_email }}</td>
<td>{{ $row->amount }}</td>
<td><a href="approve-withdraw/{{ $row->id }}">Pay Now</a></td>
   </tr>
     @endforeach
          </table>   
      
        </div>


@endsection