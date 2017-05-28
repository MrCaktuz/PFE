<?php $validated = 0 ?>
@foreach( Auth::user()->roles as $role )
    @if( $role->title == "AdminAll" )
        <?php $validated = 1 ?>
    @endif
@endforeach

@extends('partials.layoutAdmin')
@section('content')
   {{--  @if( !$validated )
        @include( 'partials.accessDenied' )
    @else --}}
        <div class="box notAllow">
            <p>Bonjour {{ Auth::user()->first_name }}.</p>
            <p>Bienvenu dans l'administration du site du RBC Ciney.</p>
        </div>
    {{-- @endif --}}
@endsection
    
