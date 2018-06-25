<footer id="footer">
    <div id="footer-widgets" class="container style-1">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget_text">
                  
             <?php $aboutus = App\Classes\Helper::getAboutUS(); ?>


                     @foreach($aboutus as $c)
                     <h2 class="widget-title"><span> ABOUT US</span></h2>
                     {{ str_limit(strip_tags($c->description), 520) }}
            @if (strlen(strip_tags($c->description)) > 520)
              ... <a href="{{ route('pages.detail',$c->slug) }}" class="widget_text">Read More</a>
            @endif
                  

              
                    @endforeach
          </div>

                   
                   
                </div>
            


            <div class="col-md-4">
               <div class="widget widget_links">
                   <h2 class="widget-title"><span>JOB CATEGORIES</span></h2>
                    <?php $jobcategories = App\Classes\Helper::getJobCategories(); ?>
                   @if(count($jobcategories)>0)
                       <ul class="sub-menu">
                           @foreach($jobcategories as $jc)
                               <li class="menu-item">
                                   <a href="{{ route('pages.detail',$jc->slug) }}">{{ $jc->page_title }}</a>
                              
                           @endforeach
                       </ul>
                   @endif
               </div>
           </div>

        

            <div class="col-md-4">
                <div class="widget widget_information">
                    <h2 class="widget-title"><span>CONTACT INFO</span></h2>
                    <ul class="style-2">
                      <?php $settings = App\Classes\Helper::settings(); ?>
                        <li class="address clearfix">
                            <span class="hl">Address:</span>
                            <span class="text">{{ $settings['contact-address'] }}</span>
                        </li>
                        <li class="phone clearfix">
                            <span class="hl">Phone:</span>
                            <span class="text">{{ $settings['contact-number'] }}</span>
                        </li>
                        <li class="email clearfix">
                            <span class="hl">E-mail:</span>
                            <span class="text">{{ $settings['web-master-email'] }}
                                       
                                </span>
                        </li>


                    </ul>
                </div>

                <div class="widget widget_spacer">
                    <div class="wprt-spacer clearfix" data-desktop="10" data-mobi="10" data-smobi="10"></div>
                </div>

                <div class="widget widget_socials">
                    <div class="socials">
                        <a target="_blank" href="{{ $settings['twitter-link'] }}"><i class="fa fa-twitter"></i></a>
                        <a target="_blank" href="{{ $settings['facebook-link'] }}"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" href="{{ $settings['gplus-link'] }}"><i class="fa fa-google-plus"></i></a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>