

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Librairies -->
    <script src="h
    <title>Symtech</title>

    <!-- PWA Meta -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="shortcut icon" href="/apple-touch-icon.png">
    <meta name="theme-color" content="#1F2937">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- CSS & JS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Service Worker Registration -->
    <script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function () {
                navigator.serviceWorker.register("/service-worker.js").then(
                    function (registration) {
                        console.log("ServiceWorker registration successful");
                    },
                    function (err) {
                        console.log("ServiceWorker registration failed: ", err);
                    }
                );
            });
        }

    </script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C6KWCH7R0M"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C6KWCH7R0M');
</script>
</head>


<header class="bg-white-100">
    <a href="{{route("clients.index")}}">
        <img src="{{ asset('img/symtec_logo.svg') }}" alt="" width="200px" height="200px">
    </a>
</header>

<body class=" bg-gray-100">
    {{{$slot}}}


</body>
</html>
