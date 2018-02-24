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
                <div class="panel-heading"><h4>Paywith Paypal</h4></div>
                <br>
                <div class="panel-body" class="col-md-12 col-lg-12 col-sm-12">
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }} input-group-lg" >
                            <label for="amount" class="col-md-4 control-label">Amount(Min 20GBP):</label>
                         
                                <input id="amount" type="number" class="form-control input-lg" name="amount" value="{{ old('amount') }}" required autofocus >
                                @if ($errors->has('amount'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Paywith Paypal
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


