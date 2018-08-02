


 <section class="wprt-section works parallax">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                    <h2 class="text-left text-black">COUNTRIES WE SUPPLY</h2>
                                    <div class="wprt-lines custom-2">
                                        <div class="line-1"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                                </div><!-- /.col-md-12 -->
                                        
                                <div class="col-md-12">
                                    <div class="wprt-project arrow-style-2 has-arrows arrow60 arrow-dark" data-layout="slider" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="30" data-gapv="30">
                                        <div id="projects" class="cbp">
                                             @foreach($countries as $country)

                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                        	 <img  src="{{ asset('uploads/countries/'.$country->image) }}"/>
                                                            
                                                            <figcaption>
                                                                <div>
                                                                    <h2>
                                                                    	 <a href="{{ route('countries.detail', $country->slug) }}">
                                                                    {{ str_limit($country->name) }}
                                                                        </a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="{{ asset('uploads/countries/'.$country->image) }}" data-title=" {{ str_limit($country->name) }}">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            @endforeach
                                      

                                            
                                        </div><!-- /#projects -->
                                    </div><!--/.wprt-project -->
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>  