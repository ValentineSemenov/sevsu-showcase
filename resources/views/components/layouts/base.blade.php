@props(["title" => ""])

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @if ($title != "")
      <title>СевГУ Витрина - {{ $title }}</title>
    @else
      <title>СевГУ Витрина</title>
    @endif

    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body>
    <x-widgets.header />

    <main class="container mx-auto max-h-full min-h-screen px-6 py-8">
      {{ $slot }}
    </main>

    <x-widgets.footer />
  </body>
</html>
