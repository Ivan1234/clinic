<!DOCTYPE html>
<html>
<head>
	@include('theme.frontoffice.layout.includes.head')
	@yield('head')
</head>
<body>
	@include('theme.frontoffice.layout.includes.nav')
	<main>
		@yield('content')
	</main>
	@include('theme.frontoffice.layout.includes.footer')
	@include('theme.frontoffice.layout.includes.foot')
	@yield('foot')
</body>
</html>