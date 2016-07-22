@extends('layouts.app')

@section('categories')
<ul>
	@foreach ($categories as $category)
		<li class="cat-item cat-item-1"><a href="/category/{{$category->slug}}" >{{$category->name}}</a></li>
	@endforeach
				

</ul>
@endsection

@section('content')
     
                    

@endsection
