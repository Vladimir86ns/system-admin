<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- end of global level css -->
    <!-- page level css -->
    <link href="{{ asset('assets/css/pages/login2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- styles of the page ends-->
</head>

<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class=" col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Chose Status</h3>
                </div>
                <div class="panel-body">
                    <a href="/login" class="btn btn-primary btn-block btn-lg">Employee</a>
                    <a type="submit" class="btn btn-primary btn-block btn-lg">Owner</a>
                    <a href="/investment/login" class="btn btn-primary btn-block btn-lg">Investitor</a>
                    <a href="/investments-admin/login" class="btn btn-primary btn-block btn-lg">Investment-Admin</a
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js-->
<script src="{{ asset('assets/js/TweenLite.min.js') }}"></script>
<script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/login2.js') }}" type="text/javascript"></script>
<!-- end of page level js-->
</body>
</html>