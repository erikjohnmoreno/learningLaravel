
<head>
    <meta charset="UTF-8">
    <title> SignUp</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="container">
    <section class="section-padding">
        <div class="jumbotron text-center">
            <h1>Sign Up</h1>

            {{ Form::open(['url' => '/signup', 'class' => 'form']) }}
            <div class="form-group">
                {{ Form::label('name', 'name:') }}
                {{ Form::text('name', $_SESSION['name'], ['class' => 'form-control']) }}<br/>
                {{ Form::label('email', 'email:') }}
                {{ Form::text('email', $_SESSION['email'], ['class' => 'form-control']) }}<br/>
                {{ Form::label('password', 'password:') }}
                {{ Form::password('password', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Sign Up', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </section>
</div>
