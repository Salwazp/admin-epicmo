<!DOCTYPE html>
<html lang="en">

@include('layouts.header')
@include('layouts.navbar')

<body>

    <!--###########################################################-->
    <!--Section - Type #2 (with image left)
            =======================
            List & Default Options:
            1. Background Color > default ('.bg-white')
            2. Text Color       > default ('.text-dark')
            3. Title Size       > text-large ('.text-lg')
            4. Link Color       > primary ('.btn-primary')
        -->
    @yield('content')
    @include('layouts.footer')
    @include('layouts.script')
    @yield('script')

</body>
</html>