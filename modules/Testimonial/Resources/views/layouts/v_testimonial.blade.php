

                                <div class="col-md-6">
                                    <h2>TESTIMONIALS</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>

                                    <div class="wprt-testimonials has-outline arrow-style-2 has-arrows arrow60 arrow-light" data-layout="slider" data-column="1" data-column2="1" data-column3="1" data-column4="1" data-gaph="0" data-gapv="0">
                                        <div id="testimonials-wrap" class="cbp">
                                           @foreach($testimonials  as $t)
                                            <div class="cbp-item">
                                                <div class="customer clearfix">
                                                    <div class="inner">
                                                        <div class="image"><img src="uploads/testimonials" alt="image" /></div>
                                                        <h4 class="name">{{$t -> name}}</h4>
                                                        <div class="position">{{$t -> company_name}}.</div>
                                                        <blockquote class="whisper">{{$t-> description}}</blockquote>
                                                    </div>
                                                </div>
                                            </div><!-- /.cbp-item -->

                                          </div><!-- /#service-wrap -->
                                    </div><!-- /.wprt-service -->
                                </div><!-- /.col-md-6 -->