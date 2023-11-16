<!doctype html>
<html lang="de">

<head>
  <title>#madewithtwill website</title>
  @vite('resources/css/app.css')
</head>

<body>
  <div>
    @yield('content')
  </div>
  @vite(['resources/js/app.js'])
</body>

</html>
