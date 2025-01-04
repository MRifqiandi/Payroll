<!DOCTYPE html>
<html lang="en">

<head>
    <title>LUPA PASSWORD | SIMGAJI</title>
    <link href="{{ URL::asset('src/logincss.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
</head>

<body>
    <div id="formWrapper">
        <div id="form">
            <div class="logo" style="margin-bottom: 0 !important;">
                <img src="{{ URL::asset('src/assets/images/logoitk.png') }}" width="200" />
                <br>
                {{-- <img src="{{ URL::asset('src/assets/images/simbanding.png') }}" width="120" /> --}}
                <h3 style="">Lupa Password</h3>
                <br>
            </div>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                @isset($error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endisset
                <div class="form-item">
                    <p class="formLabel">Email</p>
                    <input type="text" name="email" id="email" class="form-style" name="email" required />
                </div>

                <div class="form-item">
                    <a href="{{ route('login') }}">Balik ke login</a>

                    <input type="submit" class="login pull-right" style="width: 150px" value="Reset Password">
                    <div class="clear-fix"></div>
                </div>
                <br>
            </form>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            var formInputs = $('input[type="text"],input[type="password"]');
            formInputs.focus(function() {
                $(this).parent().children('p.formLabel').addClass('formTop');
                $('div#formWrapper').addClass('darken-bg');
                $('div.logo').addClass('logo-active');
            });
            formInputs.focusout(function() {
                if ($.trim($(this).val()).length == 0) {
                    $(this).parent().children('p.formLabel').removeClass('formTop');
                }
                $('div#formWrapper').removeClass('darken-bg');
                $('div.logo').removeClass('logo-active');
            });
            $('p.formLabel').click(function() {
                $(this).parent().children('.form-style').focus();
            });
        });
    </script>
</body>


</html>
