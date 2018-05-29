<div class="col-md-6">
    <h2>OUR PARTNERS</h2>
    <div class="wprt-lines style-1 custom-3">
        <div class="line-1"></div>
        <div class="line-2"></div>
    </div>
    <div class="wprt-spacer" data-desktop="40" data-mobi="40"
         data-smobi="40"></div>
           <div class="wprt-partner-grid has-outline col-3 gutter-10">
        <div class="partner-wrap clearfix">
             @foreach($images->chunk(3) as $chunk)
               <div class="partner-row clearfix">
                 @foreach($chunk as $gal)
                <div class="partner-item">
                 <div class="inner-item">
                 <a target="_blank" href="{{ $gal->external_link}}"><img
                  src="{{ asset('uploads/gallery/'.$gal->image) }}"
                  alt="image"/></a>
                       </div>
                      </div>
                  @endforeach
               <!-- /.partner-item -->
               </div>
          @endforeach
        </div><!-- /.partner-wrap -->
    </div><!-- /.wprt-partner-grid -->

    <div class="wprt-spacer" data-desktop="0" data-mobi="40"
         data-smobi="40"></div>
</div><!-- /.col-md-6 -->



