
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
    <meta name="theme-color" content="#1F2937">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>Symtech</title>
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
</head>

<header>
    <a href="{{route("clients.index")}}">
        <img src="{{ asset('img/symtec_logo.svg') }}" alt="" width="200px" height="200px">
    </a>





</header>
<body>
    {{{$slot}}}


</body>
</html>
