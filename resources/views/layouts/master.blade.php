<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdminLTE 3 | Starter</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

@include('layouts.partials.navBar')

@include('layouts.partials.mainSideBar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('layouts.partials.breadCrumb')
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.partials.controlSidebar')

    @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->
<script>
    let active_user = '{{auth()->user()}}';
</script>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>