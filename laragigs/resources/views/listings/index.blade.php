<x-layout>
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
<div class="mt-6 p-4 bg-white-200">
    {{$listings->links()}}
</div>
</x-layout>

