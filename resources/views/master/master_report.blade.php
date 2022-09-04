    @include('partial._header')
     @yield('css')



        <div id="page-wrapper" class="gray-bg" style="width: 100%;">
        

            @yield('breadcrumb')

            
            @yield('content')

    @include('partial._footer')

     @yield('js')
