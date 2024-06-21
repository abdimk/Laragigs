@extends('layout')

@section('content')

@include('partials.__hero')

@include('partials.__search')

@unless(count($listings)==0)

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@foreach($listings as $list) 
<x-listing-card :list="$list"/>

@endforeach

@else
<p>No listings found</p>
@endunless
</div>


@endsection