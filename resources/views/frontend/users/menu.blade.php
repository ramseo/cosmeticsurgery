<style type="text/css">
    .left-icon {
        height: 30px;
        background-position: left;
        background-repeat: no-repeat;
        background-size: 28px;
        padding-left: 40px;
        padding-top: 5px;
    }

    .menu-menu-col a {
        /*padding: 15px !important;*/
        /*margin-left: 30px !important;*/
        /*font-size: 15px;*/

    }


    #mainFeatures a:hover,
    #mainFeatures a:active {
        filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%);
        background-color: transparent;
        color: #1877F2;
    }

    #mainFeatures {
        padding: 0px !important;
    }

    #mainFeatures li {
        list-style: none;
    }

    #mainFeatures li a i {
        padding: 5px 0 10px 35px;
    }

    .menu-counter {
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid #555;
    }
</style>
<div class="menu-menu-col">
    @php $types = getDataArray('types'); @endphp

    <!-- <style type="text/css">
            @if($types)
                @foreach($types as $type)
               
                        .icon-{{$type->slug}}{ 
                             background: url("{{asset('storage/type/icon/'.$type->icon)}}") no-repeat ;
                             background-size:30px 30px;
                             
                            }
                  
                @endforeach
            @endif
        </style> -->

    <ul class="list-unstyled avatar-ul">
        <li>
            <a href="{{ route('frontend.users.profileEdit') }}" class="{{ Request::segment(2) == 'edit' ? 'active' : '' }}">
                <i class="fa fa-user"></i>
                My Profile
            </a>
        </li>
        <li>
            <a href="{{ route('frontend.results.index') }}" class="{{ Request::segment(2) == 'results' ? 'active' : '' }}">
                <i class="fa fa-image"></i>
                Result Category
            </a>
        </li>
        <li>
            <a href="{{ route('frontend.content.index') }}" class="{{ Request::segment(2) == 'content' ? 'active' : '' }}">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                Content
            </a>
        </li>
        <li>
            <a href="{{ route('frontend.profile_posts.index') }}" class="{{ Request::segment(2) == 'posts' ? 'active' : '' }}">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                Posts
            </a>
        </li>
        <!-- <li data-toggle="collapse" data-target="#service" class="{{ Request::segment(1) == 'vendors' ? 'collapsed' : '' }} ">
            <a class="{{ Request::segment(1) == 'vendors' ? 'active' : '' }}" href="{{ route('frontend.vendors.slug')}}"><i class="fa fa-globe fa-lg"></i> My Vendors <span class="arrow"></span></a>
            <ul id="mainFeatures" class="sub-menu collapse {{ Request::segment(1) == 'vendors' ? 'show' : '' }}  ">
                @foreach($types as $type)
                <li>
                    <a href="{{ route('frontend.vendors.slug', ['slug'=> $type->slug ])}}" class="{{ Request::segment(2) == $type->slug ? 'active' : '' }}">
                        <i id="menu_{{$type->slug}}" class="left-icon- icon-{{$type->slug}}"></i>
                        {{$type->name}}
                        @if(getTotalVendorUserMenu($type->id))
                        <span class="badge badge-secondary">{{getTotalVendorUserMenu($type->id)}}</span>
                        @endif

                    </a>
                </li>
                @endforeach
            </ul>
        </li> -->
        <?php
        $user = Auth::user();
        $getUserProvider = getUserProvider($user->id);
        if ($getUserProvider == NULL) {
        ?>
            <li><a href="{{ route('frontend.users.changePassword') }}" class="{{ Request::segment(2) == 'changePassword' ? 'active' : '' }}"><i class="fa fa-key"></i> Change Password</a></li>
        <?php } ?>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('account-logout-form').submit();">
                Logout
            </a>
        </li>
        <form id="account-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>