
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Librairies -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="img/icons/symtech_icon_192x192.png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <title>Symtech</title>

    <!-- Service Worker -->
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
<style>
  button, a, input, textarea, label {
    touch-action: manipulation;
  }
</style>


<header class="bg-white-100">
    <a href="{{route("clients.index")}}">
        <img src="{{ asset('img/symtec_logo.svg') }}" alt="" width="200px" height="200px">
    </a>
</header>

<body class=" bg-gray-100">
    {{{$slot}}}


</body>
</html>
