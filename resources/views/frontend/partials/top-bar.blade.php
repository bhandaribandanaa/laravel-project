<div id="top-bar" class="style-2">
    <div id="top-bar-inner" class="container">
        <div class="top-bar-inner-wrap">

            <div class="top-bar-socials">
                <div class="inner">
                        <span class="icons">
                          Gov. Lic. No.: 1231/074/075
                        </span>
                </div>
            </div><!-- /.top-bar-socials -->

            <div class="top-bar-content">
                    <span id="top-bar-text">
                        <i class="fa fa-phone-square">&nbsp {{ (Session::has('settings')) ? Session::get('settings')['contact-number'] : "" }} </i>
                        <i class="fa fa-envelope">&nbsp{{ (Session::has('settings')) ? Session::get('settings')['web-master-email'] : "" }}</i>
                        <i class="fa fa-map-marker">&nbsp{{ (Session::has('settings')) ? Session::get('settings')['contact-address'] : "" }}</i>
                    </span><!-- /#top-bar-text -->
            </div><!-- /.top-bar-content -->
        </div>
    </div>
</div>