<div class="col-md-6">
    <h2>Company Documents</h2>
    <div class="wprt-lines style-1 custom-3">
        <div class="line-1"></div>
        <div class="line-2"></div>
    </div>
    <div class="wprt-spacer" data-desktop="40" data-mobi="40"
         data-smobi="40"></div>
           <div class="wprt-partner-grid has-outline col-3 gutter-10">
        <div class="partner-wrap clearfix">
             @foreach($data as $gal)
               <div class="partner-row clearfix">
                 
                <div class="partner-item">
                 <div class="inner-item">
                 <a target="_blank" href="{{ $gal->external_link}}"><img
                  src="{{ asset('uploads/companydocument/'.$gal->image) }}"
                  alt="image"/></a>
                       </div>
                      </div>
                 
               <!-- /.partner-item -->
               </div>
          @endforeach
        </div><!-- /.partner-wrap -->
    </div><!-- /.wprt-partner-grid -->

    <div class="wprt-spacer" data-desktop="0" data-mobi="40"
         data-smobi="40"></div>
</div><!-- /.col-md-6 -->



