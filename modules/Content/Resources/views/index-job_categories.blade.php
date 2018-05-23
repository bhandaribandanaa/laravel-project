<section class="wprt-section offer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                     data-smobi="60"></div>
                <h2>JOB CATEGORIES</h2>

                <div class="wprt-lines style-1 custom-5">
                    <div class="line-1"></div>
                    <div class="line-2"></div>
                </div>
                <div class="wprt-spacer" data-desktop="40" data-mobi="40"
                     data-smobi="40"></div>
            </div><!-- /.col-md-12 -->

            <div class="col-md-12">
                <div class="wprt-service arrow-style-2 has-arrows arrow60 arrow-light"
                     data-layout="slider" data-column="3" data-column2="3" data-column3="2"
                     data-column4="1" data-gaph="30" data-gapv="30">
                    <div id="service-wrap" class="cbp">

                        <!--  @if(count($jobCategories->children) > 0) -->
                            @foreach($jobCategories as $jobCategory)
                                <div class="cbp-item">
                                    <div class="service-item clearfix">
                                        <div class="thumb"><img
                                                    src="{{asset('uploads/media/'.$jobCategory->attachment)}}"
                                                    alt="image"/></div>
                                        <div class="service-item-wrap">
                                            <h3 class="title font-size-18"><a
                                                        href="{{ route('page.view',[$jobCategories->slug,$jobCategory->slug])}}">{{ $jobCategory->title }}</a></h3>
                                            <p class="desc">
                                                {{ $jobCategory->short_description }}
                                            </p>
                                            <a href="{{ route('page.view',[$jobCategories->slug,$jobCategory->slug])}}" class="wprt-button small rounded-3px">READ
                                                MORE</a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                   <!--  @endif -->
                    <!-- /.cbp-item -->
                    </div><!-- /#service-wrap -->
                </div><!-- /.wprt-service -->
            </div><!-- /.col-md-12 -->

            <div class="col-md-12">
                <div class="wprt-spacer" data-desktop="80" data-mobi="60"
                     data-smobi="60"></div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>