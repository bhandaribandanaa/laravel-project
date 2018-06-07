<div class="wprt-toggle style-1">
	 @foreach($content as $c)
 <h3 {{$c -> heading}}</h3>

  <div class="title font-size-10">{!! $c ->description !!}</div>
  @endforeach
          </div>
