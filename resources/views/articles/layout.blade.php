<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog With Laravel</title>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
</head>
<body>
    @extends('layouts.auth')

    @section('content')
    <div class='container'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                        <div class="card-body">
                                    {{ Auth::user()->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>