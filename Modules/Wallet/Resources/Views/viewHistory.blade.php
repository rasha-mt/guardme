@extends('wallet::layouts.app')

@section('title') 
List Transactions History
@endsection

@section('content-app')

                <div id="controlPanel" class="panel-body" class="col-md-12 col-lg-12 col-sm-12">

   <table id="table" class="display" cellspacing="0" width="100%">
   <tarea class="pull-right" style="margin-bottom:10px"></tarea>
        <thead>
            <tr>
            <th>#</th>
                <th>Email</th>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Amount</th>
               <th>creation time</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            <th>&nbsp</th>
                <th>Email</th>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Amount</th>
                <th>creation time</th>
            </tr>
        </tfoot>
        <tbody>
   
   @for($i=0;$i<$rows;$i++) 
   <td>{{ $i+1 }}</td>   
  <td>{{ $data['L_EMAIL'.$i] }}</td>
  <td>{{ $data['L_NAME'.$i] }}</td>
  <td>{{ $data['L_TYPE'.$i] }}</td>
  <td>{{ $data['L_STATUS'.$i] }}</td>
  <td>{{ $data['L_AMT'.$i] }}</td>
   <td> {{ Carbon\Carbon::parse($data['L_TIMESTAMP'.$i])->format('Y/m/d ') }}</td>

   </tr>       
     @endfor
            
           
        </tbody>
    </table>
        </div>


@endsection


