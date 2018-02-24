@extends('mailmessenger::emails.layout')

@section('content')
    <h2 class="flow-text uk-text-center">
        Confirmation <span class="fg-site-blue">Guard</span><span class="fg-site-green">Me Process</span>
    </h2>

    <p>
        Hello, we have successfully added Money ( {{ $transDetails->amount }} ) GBP for your Paypal account : {{$transDetails->paypal_email}}
    </p>
@endsection