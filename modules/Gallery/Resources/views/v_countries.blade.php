     <section class="wprt-section works parallax">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                    <h2 class="text-left text-white">COUNTRIES WE SUPPLY</h2>
                                    <div class="wprt-lines custom-2">
                                        <div class="line-1"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                                </div><!-- /.col-md-12 -->
                                        
                                <div class="col-md-12">
                                    <div class="wprt-project arrow-style-2 has-arrows arrow60 arrow-dark" data-layout="slider" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="30" data-gapv="30">
                                        <div id="projects" class="cbp">
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                          @foreach($images-> $gal)
                                           <img  src="{{ asset('uploads/gallery/'.$gal->image) }}" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">MALAYSIA</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="assets/img/projects/3-full.jpg" data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                       @endforeach
                                                </div>
                                            </div><!--/.cbp-item -->

                                            
                                        </div><!-- /#projects -->
                                    </div><!--/.wprt-project -->
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>   







<div class="col-md-6">
    <h2></h2>
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



