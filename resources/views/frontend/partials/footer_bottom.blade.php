<div id="bottom" class="clearfix style-1">
    <div id="bottom-bar-inner" class="wprt-container">
        <div class="bottom-bar-inner-wrap">
        <div class="bottom-bar-menu">
                <ul class="bottom-nav">
                    <li><a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a></li>
                   <li><a href="#/"> Why Recruitment from us</a></li>
                    <li>
                    <?php $business = App\Classes\Helper::getBusiness(); ?>
                   
                           @foreach($business as $jc)
                               <li class="menu-item">
                                   <a href="{{ route('pages.detail',$jc->slug) }}">{{ $jc->page_title }}</a></li>
                              
                           @endforeach
                       </li>>
                   



                    <li><a href="#/">Apply Online</a></li>
                    <li><a href="#/">Contact Us</a></li>
                     
                </ul>       
            </div><!-- /.bottom-bar-menu -->

            <div class="clear"></div>

            <div class="bottom-bar-content" style="text-align:center">
                Sadik International Overseas Pvt Ltd. &copy; 2018. Powered By <a href="http://peacenepal.com/" target="_blank">Peace Nepal DOT
                    com</a> 

            </div><!-- /.bottom-bar-content -->


        </div>
    </div>
</div>