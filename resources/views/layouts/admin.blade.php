<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>{{ __('messages.project_name')}}</title>
 <meta name="csrf-token" content="{{ csrf_token() }}">    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('public/backend/css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/backend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <link href="{{ asset('public/backend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/css/datatables.min.css') }}" rel="stylesheet">
    <style type="text/css">
        ul.sidebar-menu li.active a{
            background: #fed189;
        }
        ul.sidebar-menu li.active span{
            color: white;
        }
        #sidebar{
            z-index: 999;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- container section start -->
    <section id="container" class="">
        @include('includes.admin.header')      
        <!--header end-->
        <!--sidebar start-->
        <aside>
            @include('includes.admin.sidebar')    
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/jquery-ui-1.10.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('public/backend/js/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/sweetalert.min.js') }}" type="text/javascript"></script>
   
    <script type="text/javascript">
        var table = $('#data-table').DataTable( {
            rowReorder: true
        } );
        var base_url = "{{ url('/') }}";
        var csrf_token = "<?php echo csrf_token();?>";
    </script>
    <script src="{{ asset('public/backend/js/mycustom.js') }}" type="text/javascript"></script>
   
     
    @yield('scripts')
</body>
</html>