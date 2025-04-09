
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <title>Symtech</title>
</head>
@props(["user"])
<header>
    <a href="{{route("clients.index")}}">
        <img src="{{ asset('img/symtec_logo.svg') }}" alt="" width="200px" height="200px">
    </a>
    @if ($user == true)
        <p>Utilisateur: {{$user->username}}</p>
    @elseif ($user == null)

    @endif


</header>
<body>
    {{{$slot}}}
</body>
</html>
