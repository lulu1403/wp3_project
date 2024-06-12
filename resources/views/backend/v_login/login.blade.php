<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>login</title>
    <link rel="stylesheet" href="{{ asset('backend/styles/style.min.css') }}">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{ asset('backend/plugin/waves/waves.min.css') }}">

</head>

<body>

    <div id="single-wrapper">
        <form action="/login" method="post" class="frm-single">
            @csrf
            
            <div class="inside">
           
                <div class="title"><strong>Ninja</strong>Admin</div>
                <!-- /.title -->
                
                <div class="frm-title">Login</div>
                @if(session()->has('msgError'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{ session('msgError')}} </strong>
                    </div>
                    @endif
                
                <!-- /.frm-title -->
                <div class="frm-input">
                    <input type="text" placeholder="Username" name="email" value="{{ old('email') }}" class="frm-inp form-control-lg @error('email') is-invalid @enderror" placeholder="Masukkan Email""><i class="fa fa-user frm-ico"></i>
                    @error('email')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
        @enderror
            </div>
                
                <!-- /.frm-input -->
                <div class="frm-input">
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" class="frm-inp form-control-lg @error('password') is-invalid @enderror"><i class="fa fa-lock frm-ico"></i>
                    @error('password')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
        @enderror
                </div>
                <!-- /.frm-input -->
                <div class="clearfix margin-bottom-20">
                    <div class="pull-left">
                        <div class="checkbox primary"><input type="checkbox" id="rememberme"><label for="rememberme">Remember me</label></div>
                        <!-- /.checkbox -->
                    </div>
                    <!-- /.pull-left -->
                    <div class="pull-right"><a href="page-recoverpw.html" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
                    <!-- /.pull-right -->
                </div>
                <!-- /.clearfix -->
                <br><br>
                <button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>


                <div class="frm-footer">NinjaAdmin © 2016.</div>
                <!-- /.footer -->
            </div>
            <!-- .inside -->
        </form>
        <!-- /.frm-single -->
    </div><!--/#single-wrapper -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
    <!-- 
	================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('backend/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/scripts/modernizr.min.js') }}"></script>
    <script src="{{asset('backend/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('backend/plugin/nprogress/nprogress.js') }}"></script>
    <script src="{{asset('backend/plugin/waves/waves.min.js') }}"></script>

    <script src="{{asset('backend/scripts/main.min.js') }}"></script>
</body>

</html>