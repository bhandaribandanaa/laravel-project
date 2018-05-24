@extends('layout.frontend.app')


@section('slider')
    @include('frontend.partials.index-slider')
@endsection

@section('content')

    <div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">

                    <section class="wprt-section">
                        <div class="container">
                            {{--Latest Demand--}}
                            <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                            <h2>Latest Demand</h2>
                            <div class="wprt-lines style-1 custom-3">
                                <div class="line-1"></div>
                                <div class="line-2"></div>
                            </div>
                            <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="6%">S.N</th>
                                    <th width="25%">Job Positon</th>
                                    <th>Salary</th>
                                    <th>Type</th>
                                    <th width="9%">Req No.</th>
                                    <th>Fooding</th>
                                    <th>Accommodation</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Heavy / Light Driver</td>
                                    <td>Nrs 80,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Electrical Engineer</td>
                                    <td>Nrs 95,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Waiter/Waiteress</td>
                                    <td>Nrs 75,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>House Keeping / Cleaner</td>
                                    <td>Nrs 60,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Cook / Assistant Cook</td>
                                    <td>Nrs 70,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Pipe / Pipe Fitter</td>
                                    <td>Nrs 65,000</td>
                                    <td>Free Visa</td>
                                    <td>10</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>2018-04-05</td>
                                </tr>


                                </tbody>
                            </table>

                            {{--Latest Demand End--}}

                            {{--About Us--}}
                            <div class="wprt-spacer" data-desktop="40" data-mobi="60" data-smobi="60"></div>
                            <h2>ABOUT US</h2>
                            <div class="wprt-lines style-1 custom-3">
                                <div class="line-1"></div>
                                <div class="line-2"></div>
                            </div>
                            <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="wprt-toggle style-1">
                                        <h3 class="toggle-title">We have 30 plus years in the building
                                            industry</h3>
                                        <div class="toggle-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. In a metus pellentesque, scelerisque ex sed,
                                            volutpat nisi. Curabitur tortor mi, eleifend ornare lobortis non.
                                            Nulla porta purus quis iaculis ultrices. Proin aliquam sem at nibh
                                            hendrerit sagittis. Nullam ornare odio eu lacus tincidunt malesuada.
                                            Sed eu vestibulum elit. Curabitur tortor mi, eleifend ornare.
                                        </div>
                                    </div>

                                    <div class="wprt-toggle active style-1">
                                        <h3 class="toggle-title">Quality construction continues after the
                                            project</h3>
                                        <div class="toggle-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. In a metus pellentesque, scelerisque ex sed,
                                            volutpat nisi. Curabitur tortor mi, eleifend ornare lobortis non.
                                            Nulla porta purus quis iaculis ultrices. Proin aliquam sem at nibh
                                            hendrerit sagittis. Nullam ornare odio eu lacus tincidunt malesuada.
                                            Sed eu vestibulum elit. Curabitur tortor mi, eleifend ornare.
                                        </div>
                                    </div>

                                    <div class="wprt-toggle style-1">
                                        <h3 class="toggle-title">We use technology to do the job more
                                            quickly</h3>
                                        <div class="toggle-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. In a metus pellentesque, scelerisque ex sed,
                                            volutpat nisi. Curabitur tortor mi, eleifend ornare lobortis non.
                                            Nulla porta purus quis iaculis ultrices. Proin aliquam sem at nibh
                                            hendrerit sagittis. Nullam ornare odio eu lacus tincidunt malesuada.
                                            Sed eu vestibulum elit. Curabitur tortor mi, eleifend ornare.
                                        </div>
                                    </div>

                                    <div class="wprt-toggle style-1">
                                        <h3 class="toggle-title">Employees are continually trained on safety
                                            issues</h3>
                                        <div class="toggle-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. In a metus pellentesque, scelerisque ex sed,
                                            volutpat nisi. Curabitur tortor mi, eleifend ornare lobortis non.
                                            Nulla porta purus quis iaculis ultrices. Proin aliquam sem at nibh
                                            hendrerit sagittis. Nullam ornare odio eu lacus tincidunt malesuada.
                                            Sed eu vestibulum elit. Curabitur tortor mi, eleifend ornare.
                                        </div>
                                    </div>
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6">
                                    <div class="wprt-galleries galleries w-570px" data-width="135"
                                         data-margin="10">
                                        <div id="wprt-slider" class="flexslider">
                                            <ul class="slides">
                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="assets/img/gallery/1.jpg"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <a class="zoom"
                                                       href="{{ asset('sadik/img/gallery/1.jpg')}}"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <img src="assets/img/gallery/1.jpg" alt="image"/>
                                                    <img src="{{ asset('sadik/img/gallery/1.jpg') }}"
                                                         alt="image"/>
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom"
                                                       href="{{ asset('sadik/img/gallery/2.jpg') }}"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <img src="assets/img/gallery/2.jpg" alt="image"/>
                                                    <img src="{{ asset('sadik/img/gallery/2.jpg') }}"
                                                         alt="image"/>
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom"
                                                       href="{{ asset('sadik/img/gallery/3.jpg') }}"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <img src="assets/img/gallery/3.jpg" alt="image"/>
                                                    <img src="{{ asset('sadik/img/gallery/3.jpg') }}"
                                                         alt="image"/>
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="assets/img/gallery/4.jpg"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <a class="zoom"
                                                       href="{{ asset('sadik/img/gallery/4.jpg') }}"><i
                                                                class="fa fa-arrows-alt"></i></a>
                                                    <img src="assets/img/gallery/4.jpg" alt="image"/>
                                                    <img src="{{ asset('sadik/img/gallery/4.jpg') }}"
                                                         alt="image"/>
                                                </li>
                                            </ul>
                                        </div>

                                        <div id="wprt-carousel" class="flexslider">
                                            <ul class="slides">
                                                <li><img src="{{ asset('sadik/img/gallery/1-s.jpg') }}"
                                                         alt="image"></li>
                                                <li><img src="{{ asset('sadik/img/gallery/2-s.jpg') }}"
                                                         alt="image"></li>
                                                <li><img src="{{ asset('sadik/img/gallery/3-s.jpg') }}"
                                                         alt="image"></li>
                                                <li><img src="{{ asset('sadik/img/gallery/4-s.jpg') }}"
                                                         alt="image"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.col-md-6 -->

                                {{----}}

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                                         data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>
                    {{--Job Categories--}}
                    @include('content::index-job_categories')
                    {{--End Job Categories--}}
                    <!-- WORKS -->
                    <section class="wprt-section works parallax">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                                         data-smobi="60"></div>
                                    <h2 class="text-left text-white">COUNTRIES WE SUPPLY</h2>
                                    <div class="wprt-lines custom-2">
                                        <div class="line-1"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40"
                                         data-smobi="40"></div>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-12">
                                    <div class="wprt-project arrow-style-2 has-arrows arrow60 arrow-dark"
                                         data-layout="slider" data-column="3" data-column2="3" data-column3="2"
                                         data-column4="1" data-gaph="30" data-gapv="30">
                                        <div id="projects" class="cbp">


                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="{{ asset('sadik/img/projects/3r.jpg') }}"
                                                                 alt="image"/>
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank"
                                                                           href="page-project-detail-3.html">QATAR</a>
                                                                    </h2>

                                                                </div>
                                                            </figcaption>
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox"
                                                           href="{{ asset('sadik/img/projects/3-full.jpg') }}"
                                                           data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="{{ asset('sadik/img/projects/1r.jpg') }}"
                                                                 alt="image"/>
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank"
                                                                           href="page-project-detail-3.html">OMAN</a>
                                                                    </h2>

                                                                </div>
                                                            </figcaption>
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox"
                                                           href="{{ asset('img/projects/3-full.jpg') }}"
                                                           data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="{{ asset('sadik/img/projects/2r.jpg') }}"
                                                                 alt="image"/>
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank"
                                                                           href="page-project-detail-3.html">DUBAI</a>
                                                                    </h2>

                                                                </div>
                                                            </figcaption>
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox"
                                                           href="{{ asset('sadik/img/projects/3-full.jpg') }}"
                                                           data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="{{ asset('sadik/img/projects/4r.jpg') }}"
                                                                 alt="image"/>
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank"
                                                                           href="page-project-detail-3.html">BAHRAIN</a>
                                                                    </h2>

                                                                </div>
                                                            </figcaption>
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox"
                                                           href="{{ asset('sadik/img/projects/3-full.jpg') }}"
                                                           data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="{{ asset('sadik/img/projects/6r.jpg') }}"
                                                                 alt="image"/>
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank"
                                                                           href="page-project-detail-3.html">MALAYSIA</a>
                                                                    </h2>

                                                                </div>
                                                            </figcaption>
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox"
                                                           href="{{ asset('sadik/img/projects/3-full.jpg') }}"
                                                           data-title="LUXURY BUILDINGS">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->


                                        </div><!-- /#projects -->
                                    </div><!--/.wprt-project -->
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="80" data-mobi="60"
                                         data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>


                     {{--News Update--}}
                   @include('news::v_news')
                    {{--End News Update--}}

                      <!-- TESTIMONIALS -->


                     {{--Our Partners--}}
                   @include('gallery::v_gallery')
                    {{--End Our Partners--}}

                              

                             

                                <div class="col-md-6">
                                    <h2>TESTIMONIALS</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40"
                                         data-smobi="40"></div>

                                    <div class="wprt-testimonials has-outline arrow-style-2 has-arrows arrow60 arrow-light"
                                         data-layout="slider" data-column="1" data-column2="1" data-column3="1"
                                         data-column4="1" data-gaph="0" data-gapv="0">
                                        <div id="testimonials-wrap" class="cbp">
                                            <div class="cbp-item">
                                                <div class="customer clearfix">
                                                    <div class="inner">
                                                        <div class="image"><img
                                                                    src="{{ asset('sadik/img/testimonials/1.jpg') }}"
                                                                    alt="image"/></div>
                                                        <h4 class="name">DON PAULSON</h4>
                                                        <div class="position">Architectural Co.</div>
                                                        <blockquote class="whisper">Your efficient planning,
                                                            scheduling, management, and supervision resulted in
                                                            timely completion and a quality
                                                            facility...Particularly refreshing was the spirit of
                                                            cooperation demonstrated by your firm which served
                                                            to minimize costly delays and contract
                                                            modifications.
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div><!-- /.cbp-item -->

                                            <div class="cbp-item">
                                                <div class="customer clearfix">
                                                    <div class="inner">
                                                        <div class="image"><img
                                                                    src="{{ asset('sadik/img/testimonials/2.jpg') }}"
                                                                    alt="image"/></div>
                                                        <h4 class="name">DON PAULSON</h4>
                                                        <div class="position">Architectural Co.</div>
                                                        <blockquote class="whisper">Your efficient planning,
                                                            scheduling, management, and supervision resulted in
                                                            timely completion and a quality
                                                            facility...Particularly refreshing was the spirit of
                                                            cooperation demonstrated by your firm which served
                                                            to minimize costly delays and contract
                                                            modifications.
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div><!-- /.cbp-item -->

                                            <div class="cbp-item">
                                                <div class="customer clearfix">
                                                    <div class="inner">
                                                        <div class="image"><img
                                                                    src="{{ asset('sadik/img/testimonials/3.jpg') }}"
                                                                    alt="image"/></div>
                                                        <h4 class="name">DON PAULSON</h4>
                                                        <div class="position">Architectural Co.</div>
                                                        <blockquote class="whisper">Your efficient planning,
                                                            scheduling, management, and supervision resulted in
                                                            timely completion and a quality
                                                            facility...Particularly refreshing was the spirit of
                                                            cooperation demonstrated by your firm which served
                                                            to minimize costly delays and contract
                                                            modifications.
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div><!-- /.cbp-item -->
                                        </div><!-- /#service-wrap -->
                                    </div><!-- /.wprt-service -->
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                                         data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>
                </div><!-- /.page-content -->
            </div>
        </div>
    </div>
</div>
@endsection