@extends('wallet::layouts.app')

@section('title') 
Escrow Balance
@endsection

@section('content-app')

  <div id="controlPanel" class="panel-body" class="col-md-12 col-lg-12 col-sm-12">

<h3>Your Wallet balance is: {{ $balance }}</h3>
  </div>
@endsection