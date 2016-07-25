@extends('layouts.app')

@section('categories')
<ul>
	@foreach ($categories as $category)
		<li class="cat-item cat-item-1"><a href="/category/{{$category->slug}}" >{{$category->name}}</a></li>
	@endforeach
				

	

</ul>
@endsection

@section('content')
     
      @foreach ($videos as $video)

		<div class="post" id="post">
                    
        	<a href="#" title="{{$video->title}}"><img width="1" height="1" src="/images/upload_thumbs/{{$video->thumb}}" class="attachment-240x180 wp-post-image" alt="{{$video->title}}" title="" /></a>
                        
                                  
            <div class="link"><a href="#">{{$video->title}}</a></div>
                        
            <span>
				Download: <a download href="/upload_videos/mp4/{{$video->video_file}}">MP4</a>&nbsp&nbsp&nbsp
				@if ($video->converted)
					<a download href="/upload_videos/flv/{!! substr($video->video_file, 0, -4) !!}.flv">FLV</a>
				@endif
			</span>
            
            
            <span></span>
                    
        </div>
	@endforeach              

@endsection
