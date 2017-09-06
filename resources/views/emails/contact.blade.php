<html>
    <head>
        <title>Form submission!</title>
    </head>
    <body>
        <h1>{{ $request->name }} sent you a message!</h1>
        <p>
            <hr>
            {{ $request->message }}
            <hr>
            To answer this message, email: {{ $request->email }}
        </p>
    </body>
</html>
