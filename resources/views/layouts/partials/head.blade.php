<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$settings['title']}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    @if ($settings['style'] == 'dark_mode')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dark-styles.css') }}">
    @endif
</head>