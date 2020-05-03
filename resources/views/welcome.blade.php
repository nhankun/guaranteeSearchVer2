<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <div class="form-inline">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm theo số cmnd hoặc mã bảo hành">
                        <button class="btn btn-info" id="btnsearch">Tìm kiếm</button>
                    </div>
                </div>
                <div class="table-responsive" id="pannel">
                    <div id="pagination" style="padding-right: 0px">
                        {!! (isset($links)) ? $links : '' !!}
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="{{asset('js/back.js')}}"></script>
    <script>
        var users = (function () {

            var url = '/search'
            var title = "Do you want delete"
            var cancelButtonText ="Cancel"
            var confirmButtonText = "yes"
            var errorAjax = "Error"
                {{--var errorDelete = "{{trans('members.error_delete')}}"--}}

            var onReady = function () {
                    $('#pagination').on('click', 'ul.pagination a', function (event) {
                        back.pagination(event, $(this), errorAjax)
                    })
                    // $('#pannel').on('change', function () {
                    // })
                    //     .on('click','.simpleConfirm', function (event) {
                    //         // back.destroy(event, $(this), url, title, confirmButtonText, cancelButtonText, errorDelete)
                    //     })
                    $('th span').click(function () {
                        back.ordering(url, $(this), errorAjax)
                    })
                    $('#btnsearch').click(function () {
                        back.filters(url, errorAjax)
                    })
                    $('#search').keypress(function(event){
                        var keycode = (event.keyCode ? event.keyCode : event.which);
                        if(keycode == '13'){
                            event.preventDefault();
                            $('#btnsearch').focus().click();
                        }
                    })
                }

            return {
                onReady: onReady
            }

        })()

        $(document).ready(users.onReady)
    </script>
</html>
