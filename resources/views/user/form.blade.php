<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center">{{ isset($user)?'User Update Form':'User Registration Form' }}</h1>
                @if(isset($user))
                <form action="{{ route('user.update',@$user->id) }}" method="POST" class="form">
                    @method('PUT')
                @else
                    <form action="{{ route('user.store') }}" method="POST" class="form">
                @endif
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" value="{{ @$user->name }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Email</label>
                        <div class="col-sm-7">
                            <input type="email" name="email" value="{{ @$user->email }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password" value="{{ @$user->password }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                    
                        <div class="col-sm-7">
                            <input type="submit"  class="btn btn-success">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
</body>
</html>