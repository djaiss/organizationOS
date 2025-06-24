<title>{{ $title ?? config('app.name') }}</title>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />

<!-- Android -->
<link rel="manifest" href="{{ asset('site.webmanifest') }}" />

<!-- iOS -->
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />

<meta name="description" content="{{ config('organizationos.description') }}" />
