
<aside id="sidebar">
    <div class="sidebar-inner c-overflow">
        <div class="profile-menu">
            <a href="javascript:void(0)">
                <div class="profile-pic">

                    @if(!empty(Auth::user()->attachment) && file_exists('uploads/users/'. Auth::user()->attachment))
                        <img src="{{URL::asset('uploads/users/'. Auth::user()->attachment) }}">
                    @else
                        <img src="{{ asset('backend/img/default-avatar.png') }}">
                    @endif
                </div>

                <div class="profile-info">
                    {{ ucwords(Auth::user()->full_name) }}

                    <i class="zmdi zmdi-arrow-drop-down"></i>
                </div>
            </a>
            <ul class="main-menu">
                <li>
                    <a href="{{ route('admin.users.profile') }}"><i class="zmdi zmdi-account"></i>Update Profile</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.change_password') }}"><i class="zmdi zmdi-key zmdi-hc-fw"></i>Change
                        Password</a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}"><i class="zmdi zmdi-time-restore"></i>Logout</a>
                </li>
            </ul>
        </div>

        <ul class="main-menu">
            <li class="{{ (Request::segment(2)=='dashboard' ? 'active':'') }}"><a
                        href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
           

            @if(Access::hasAccess('content-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='content' ? 'active':'') }}"><a
                            href="{{ route('admin.content.index') }}"><i class="zmdi zmdi-sort-asc zmdi-hc-fw"></i>Content
                        Management</a></li>
            @endif
             <!-- @if(Access::hasAccess('demand-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='demand' ? 'active':'') }}"><a
                            href="{{ route('admin.demands.index') }}"><i class="zmdi zmdi-sort-asc zmdi-hc-fw"></i>Demand
                        Management</a></li>
            @endif -->

           

         

            @if(Access::hasAccess('gallery-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='gallery' ? 'active':'') }}"><a
                            href="{{ route('admin.gallery.index') }}"><i class="zmdi zmdi-image"></i>Gallery</a></li>
            @endif

            


             

            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-headset-mic zmdi-hc-fw" aria-hidden="true"></i>News</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.news.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View News</a>
                    </li>
                    <li><a href="{{ route('admin.news.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add News</a>
                    </li>
                    <li class=""><a
                                href="{{ route('admin.news.category') }}"><i class="fa fa-eye" aria-hidden="true"></i>View News Category</a>
                    </li>
                    <li><a href="{{ route('admin.news.addCategory') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add News Category</a>
                    </li>
                </ul>
            </li>


            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-widgets aria-hidden="true"></i>Mission and Vision</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.countries.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Mission and Vision</a>
                    </li>
                    <li><a href="{{ route('admin.countries.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add Mission and Vision</a>
                    </li>
                    
                </ul>
            </li>










            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-widgets aria-hidden="true"></i>Testimonial Management</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.testimonials.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Testimonial</a>
                    </li>
                    <li><a href="{{ route('admin.testimonials.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add Testimonial</a>
                    </li>
                    
                </ul>
            </li>
             <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi-account" aria-hidden="true"></i>Applicants</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.applicants.index') }}"><i class="zmdi zmdi-account" aria-hidden="true"></i>View Applicants</a>
                    </li>
                   
                    
                </ul>
            </li>
               <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-sort-asc zmdi-hc-fw" aria-hidden="true"></i>Contact Message</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.contacts.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Contact Messsage</a>
                    </li>
                   
                    
                </ul>
            </li>





            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-widgets" aria-hidden="true"></i>Settings Management</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.settings.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Setting</a>
                    </li>
                    <li><a href="{{ route('admin.settings.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add Setting</a>
                    </li>
                    
                </ul>
            </li>



            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-download" aria-hidden="true"></i>Demand Management</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.demands.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Demand</a>
                    </li>
                    <li><a href="{{ route('admin.demands.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add Demand</a>
                    </li>
                    
                </ul>
            </li>

            @if(Access::hasAccess('companydocument-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='companydocument' ? 'active':'') }}"><a
                            href="{{ route('admin.companydocument.index') }}"><i class="zmdi zmdi-image"></i>Company Document</a></li>
            @endif

            <li class="sub-menu ">
                <a href="javascript:void(0)"><i class="zmdi zmdi-image-alt zmdi-hc-fw" aria-hidden="true"></i>Company Document Management</a>
                <ul>
                    <li class=""><a
                                href="{{ route('admin.companydocument.index') }}"><i class="fa fa-eye" aria-hidden="true"></i>View Company Document</a>
                    </li>
                    <li><a href="{{ route('admin.companydocument.add') }}"
                           class=""><i class="fa fa-plus" aria-hidden="true"></i>Add Company Document</a>
                    </li>
                    
                </ul>
            </li>

















            @if(Access::hasAccess('gallery-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='banner' ? 'active':'') }}"><a
                            href="{{ route('admin.banner.index') }}"><i class="zmdi zmdi-image-alt zmdi-hc-fw"></i>Banner
                        Management</a>
                </li>
            @endif

           <!--  @if(Access::hasAccess('content-management', 'access_view'))
                <li class="{{ (Request::segment(2)=='newsletter' ? 'active':'') }}"><a
                            href="{{ route('admin.newsletter.index') }}"><i class="fa fa-envelope" aria-hidden="true"></i>Email Subscriptions</a></li>
            @endif -->

            <!-- {{--@if(Access::hasAccess('downloads', 'access_view') || Access::hasAccess('downloads', 'access_view'))--}}
                {{--<li class="sub-menu {{ (Request::segment(2)=='downloads' ? 'active toggled':'') }}">--}}
                    {{--<a href=""><i class="zmdi zmdi-download"></i> Download Management</a>--}}
                    {{--<ul>--}}
                        {{--@if(Access::hasAccess('downloads', 'access_view'))--}}
                            {{--<li><a href="{{ URL::route('admin.download.category.index') }}"--}}
                                   {{--class="{{ (Request::segment(3)=='category' ? 'active':'') }}"><i--}}
                                            {{--class="zmdi zmdi-collection-video zmdi-hc-fw"></i>Category</a></li>--}}
                        {{--@endif--}}
                        {{--@if(Access::hasAccess('downloads', 'access_view'))--}}
                            {{--<li><a href="{{ URL::route('admin.download.video.index') }}"--}}
                                   {{--class="{{ (Request::segment(3)=='video' ? 'active':'') }}"><i--}}
                                            {{--class="zmdi zmdi-collection-video zmdi-hc-fw"></i>Mange Video</a></li>--}}
                        {{--@endif--}}
                        {{--@if(Access::hasAccess('downloads', 'access_view'))--}}
                            {{--<li><a href="{{ URL::route('admin.download.file.index') }}"--}}
                                   {{--class="{{ (Request::segment(3)=='file' ? 'active':'') }}"><i--}}
                                            {{--class="zmdi zmdi-image zmdi-hc-fw"></i>Manage File</a></li>--}}
                        {{--@endif--}}


                    {{--</ul>--}}
                {{--</li>--}}
            {{--@endif--}}
 -->



            {{--@if(Access::hasAccess('users', 'access_view'))--}}
                {{--<li class="{{ (Request::segment(2)=='users' ? 'active':'') }}"><a--}}
                            {{--href="{{ route('admin.users.index') }}"><i class="zmdi zmdi-accounts-list zmdi-hc-fw"></i>--}}
                        {{--Users</a></li>--}}
            {{--@endif--}}

           <!--  @if(Access::hasAccess('user-type', 'access_view') || Access::hasAccess('modules', 'access_view'))
                <li class="sub-menu {{ (Request::segment(2)=='configuration' ? 'active toggled':'') }}">
                    <a href=""><i class="zmdi zmdi-widgets"></i> Configurations</a>
                    <ul>
                        {{--@if(Access::hasAccess('user-type', 'access_view'))--}}
                        {{--<li><a href="{{ URL::route('admin.usertypes') }}"--}}
                        {{--class="{{ (Request::segment(3)=='usertypes' ? 'active':'') }}"><i--}}
                        {{--class="zmdi zmdi-apps zmdi-hc-fw"></i> User Types</a></li>--}}
                        {{--@endif--}}
                        {{--@if(Access::hasAccess('modules', 'access_view'))--}}
                        {{--<li><a href="{{ URL::route('admin.modules') }}"--}}
                        {{--class="{{ (Request::segment(3)=='modules' ? 'active':'') }}"><i--}}
                        {{--class="zmdi zmdi-view-module zmdi-hc-fw"></i> Modules</a></li>--}}
                        {{--@endif--}}


                    </ul>
                </li>
            @endif -->



            &nbsp;<br>
            </li>



        </ul>
    </div>
</aside>


