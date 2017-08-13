    {{-- Scripts --}}
        {{-- jQuery --}}
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
        {{-- Masonry --}}
    @if($bodyClass == 'page-albums')
        <script type="text/javascript" src="{{ URL::asset('js/masonry.min.js') }}"></script>
    @endif
        {{-- Lightbox --}}
    @if($bodyClass == 'page-albums' || $bodyClass == 'page-complexe')
        <script type="text/javascript" src="{{ URL::asset('js/lightbox.min.js') }}"></script>
    @endif
        {{-- Slick --}}
    @if($bodyClass == 'page-complexe' || $bodyClass == NULL)
        <script type="text/javascript" src="{{ URL::asset('js/slick.min.js') }}"></script>
    @endif
        {{-- Waypoint --}}
    @if($bodyClass == 'page-regles')
        <script type="text/javascript" src="{{ URL::asset('js/waypoint.min.js') }}"></script>
    @endif
        {{-- Google Map API --}}
    @if($bodyClass == 'page-complexe' || $bodyClass == 'page-contact')
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbilrse-oRJzOiAfr4enUru0D6l9XBnM4"></script>
    @endif
        {{-- Accessible Mega Menu --}}
    <script type="text/javascript" src="{{ URL::asset('js/jquery-accessibleMegaMenu.js') }}"></script>
        {{-- Personal --}}
    <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
        {{-- Other --}}
    {{-- <script type="text/javascript" src="{{ asset('scripts/bootstrap.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('scripts/app.js') }}"></script> --}}
</body>
</html>