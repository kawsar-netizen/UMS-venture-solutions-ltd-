    @include('partial._header')
     @yield('css')

    @include('partial._sidebar')

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('partial._topbar')
        </div>

            @yield('breadcrumb')

            
            @yield('content')

    @include('partial._footer')

     @yield('js')
