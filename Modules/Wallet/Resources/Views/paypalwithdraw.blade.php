@extends('wallet::layouts.app')

@section('title') 
Add Funds to Wallet
@endsection

@section('content-app')


    <section>
      
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
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
            
                <div class="panel-heading"><h4> Withdraw Money</h4></div>
                <br>
                <div class="panel-body" class="col-md-12 col-lg-12 col-sm-12">
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal.postadaptivePay') !!}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }} input-group-lg" >
                            <label for="withdraw_amount" class="col-md-4 control-label">Amount:</label>
                         
                                <input id="withdraw_amount" type="number" class="form-control input-lg" name="withdraw_amount" value="{{ old('withdraw_amount') }}" required autofocus >
                                @if ($errors->has('amount'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    withdraw
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div></section>

@endsection


