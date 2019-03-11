 <footer class="main-footer"> 
    <!--Widgets Section-->
    <div class="widgets-section">
      <div class="auto-container">
        <div class="row clearfix"> 
          
          <!--Footer Column-->
          <div class="footer-column col-md-4 col-sm-4 col-xs-12">
            
            <div class="footer-widget logo-widget">
              <?php $aboutus = App\Classes\Helper::getAbtus(); ?>
               @foreach($aboutus as $c)
              <h2>About Us</h2>
              <div class="widget-content">

                <div class="text">
                  {{ str_limit(strip_tags($c->description), 120) }}
                    @if (strlen(strip_tags($c->description)) > 120)
                      <a href="{{'about-us-1'}}" class="widget_text">Read More</a>
                    @endif
                    </div>
              </div>
              @endforeach
            </div>
          </div>
         
          <!--Footer Column-->
          <div class="footer-column col-md-4 col-sm-4 col-xs-12">
            <div class="footer-widget links-widget">
              <h2>Our Services</h2>
              <?php $services = App\Classes\Helper::getService(); ?>
              {{--  {{ dd($services) }} --}}
              <ul class="services-list">
                @if(count($services)>0)
                  @foreach($services as $service)
                    <li class="menu-item"><a href="{{$service->slug}}">{{$service->page_title}}</a></li>
                  @endforeach
                @endif
                {{-- <li><a href="{{'about'}}">About Us</a></li>
                <li><a href="{{'turkish'}}">Turkish Language Class</a></li>
                <li><a href="{{'education'}}">Education/Training</a></li>
                <li><a href="{{'aboutnepal'}}">About Nepal</a></li>
                <li><a href="{{'recruitnepal'}}">Why Recruit from Nepal</a></li> --}}
              </ul>
            </div>
          </div>
          
          <!--Footer Column-->
          <div class="footer-column col-md-4 col-sm-4 col-xs-12">
            <div class="footer-widget logo-widget">
              <h2>Contact Details</h2>
              <div class="widget-content">
                <ul class="contact-info">
                   <?php $settings = App\Classes\Helper::settings(); ?>
                  <li>
                    <div class="icon"><span class="flaticon-placeholder"></span></div>
                    <span class="title">Our Location:</span>{{ $settings['contact-address'] }}</li>
                  <li>
                    <div class="icon"><span class="flaticon-email"></span></div>
                    <span class="title">Email:</span> {{ $settings['web-master-email'] }} </li>
                  <li>
                    <div class="icon"><span class="flaticon-phone-call"></span></div>
                    <span class="title">Call Us:</span>{{ $settings['contact-number']}}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Footer Bottom-->
    <div class="footer-bottom">
      <div class="auto-container">
        <div class="row clearfix"> 
          <!--Column-->
          <div class="column col-md-6 col-sm-12 col-xs-12">
            <div class="copyright">Copyrights &copy; 2017 Euro Nepal. All Rights Reserved</div>
          </div>
          <!--Nav Column-->
          <div class="nav-column col-md-6 col-sm-12 col-xs-12"> Powered By: <a href="http://peacenepal.com" target="_blank">Peace Nepal DOT Com</a> </div>
        </div>
      </div>
    </div>
  </footer>