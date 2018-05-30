<!-- Slider -->
<div class="rev_slider_wrapper fullwidthbanner-container">
    <div id="rev-slider2" class="rev_slider fullwidthabanner">
        <ul>
            <!-- Slide -->
            @foreach($banner as $b)
            <li data-transition="random">
                <!-- Main Image -->
                <img src="{{asset('uploads/banner/'. $b->image)}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina>
                <!-- Layers -->
                <div class="sfb tp-caption tp-resizeme text-white font-family-heading text-shadow text-center font-weight-700 letter-spacing-2px"
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['-90','-90','-90','-90']"
                    data-fontsize="['58','54','50','46']"
                    data-lineheight="['68','64','60','56']"
                    data-width="none"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;" 
                    data-transform_in="o:0" 
                    data-transform_out="o:0" 
                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                    data-mask_out="x:0;y:0;s:inherit;e:inherit;"
                    data-start="1500"
                    data-splitin="none"
                    data-splitout="none"
                    data-responsive_offset="on">
                    {{$b-> title}}
                </div>
                <div class="sfb tp-caption tp-resizeme text-white text-shadow text-center"
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['-14','-14','-14','-14']"
                    data-fontsize="['16','16','16','16']"
                    data-lineheight="['30','30','30','28']"
                    data-width="none"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;" 
                    data-transform_in="o:0" 
                    data-transform_out="o:0" 
                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                    data-mask_out="x:0;y:0;s:inherit;e:inherit;"
                    data-start="1500"
                    data-splitin="none"
                    data-splitout="none"
                    data-responsive_offset="on"
                    data-lasttriggerstate="reset">
                    {!! $b-> heading !!}
                </div>
               
            </li>
            @endforeach
            <!-- End Slide -->

             <!-- Slide -->
          
            <!-- End Slide -->

           
        </ul>
        <div class="tp-bannertimer tp-bottom"></div>
    </div>
</div>