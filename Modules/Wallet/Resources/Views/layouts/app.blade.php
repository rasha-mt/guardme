@extends('app::layouts.pages.others')
 
@section('page')
<div class="col-lg-12  col-md-12 col-sm-12">


 @include('app::partials.app.sidebar') 

  
  
  <div  class="col-lg-10 col-md-10 col-sm-10 pull-right">
    <section>
        <div class="block curve no-padding">
            <div data-velocity="-.2" style="background: url(/assets/img/security_lady_man.jpg) 50% 50% transparent;"
                 class="layer blackish parallax scrolly-invisible no-parallax uk-background-center-center uk-background-cover">
            </div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <span class="white"><span class="fg-site-blue">Guard</span><span class="fg-site-green">Me</span></span>
                            <h2>@yield('title')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <section>
        <div class="block">
            <div class="container">
                @yield('content-app')
            </div>
        </div>
    </section>
</div>
</div>
    @include('app::partials.splashscreen')
@endsection

@push('styles')

    <link rel="stylesheet" href="/build/css/app.vendors.bundle.css">
    <link rel="stylesheet" href="/build/css/app.bundle.css">

    <link rel="stylesheet" type="text/css" href="/bower_components/datatables.net/css/jquery.dataTables.min.css"/>
   <link href="/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/bower_components/perfect-scrollbar//css/buttons.dataTables.min.css">
    <link href="/bower_components/dragula.js/dist/dragula.min.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">


    <style>
        tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    </style>
@endpush

@push('scripts')
<script src="/build/js/app.vendors.bundle.js"></script>
    <script src="/build/js/app.min.js"></script>
<script src="/build/js/jquery.validate.js"></script>
<script src="/build/js/jquery.form.js"></script>

<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net/js/dataTables.bootstrap.min.js"></script>
<script src="/bower_components/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="/bower_components/datatables.net/js/buttons.flash.min.js"></script>
<script src="/bower_components/datatables.net/js/jszip.min.js"></script>
<script src="/bower_components/datatables.net/js/buttons.html5.min.js"></script>
<script src="/bower_components/datatables.net/js/vfs_fonts.js"></script>
<script src="/bower_components/datatables.net/js/buttons.print.min.js"></script>
<script src="/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

$('#payment-form').validate({
    rules: {
        amount: {
            min: 20,
            required: true
        },
      
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('success').addClass('error').css('color', 'red');
    }
});
 /***************Setup - add a text input to each footer cell***************************/
      
  var table = $('#table').DataTable( {
    buttons: ['csv','print']
} );
 
table.buttons().container().appendTo( 'tarea' );

    /***DataTable****/
 


    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
   
        /*** Apply the search***/
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
/*******************************************/
/***var data = table.buttons.exportData();**/

});
</script>


@endpush
