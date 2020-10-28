<!DOCTYPE html>
<html lang="en">
  <!--================================================================================
  title
  head
  content
  foot
  ================================================================================ -->
  <head>
     <title>@yield('title')</title>
     @include('theme.backoffice.layout.includes.head')
     @yield('head')
  </head>

  <body>    
     @include('theme.backoffice.layout.includes.loader')

     @include('theme.backoffice.layout.includes.header')
    
    <div id="main">      
      <div class="wrapper">
        @include('theme.backoffice.layout.includes.left-sidebar')
        <section id="content">
          @include('theme.backoffice.layout.includes.breadcrums')          
          <div class="container">
            @yield('content')
          </div>
        </section>         
      </div>
    </div>

    @include('theme.backoffice.layout.includes.footer')
    
    @include('theme.backoffice.layout.includes.foot')     
    @yield('foot')
  </body>
</html>