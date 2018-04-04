<!-- START Top Navbar-->
<nav role="navigation" class="navbar navbar-default navbar-top navbar-fixed-top">
    <!-- START navbar header-->
    <div class="navbar-header">
    <a href="dashboard.v1.html" class="navbar-brand">
        <div class="brand-logo">
            <img src="{{ asset('app/img/logo.png') }}" alt="App Logo" class="img-responsive">
        </div>
        <div class="brand-logo-collapsed">
            <img src="{{ asset('app/img/logo-single.png') }}" alt="App Logo" class="img-responsive">
        </div>
    </a>
    </div>
    <!-- END navbar header-->
    <!-- START Nav wrapper-->
    <div class="nav-wrapper">
    <!-- START Left navbar-->
    <ul class="nav navbar-nav">
        <li>
            <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
            <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                <em class="fa fa-navicon"></em>
            </a>
            <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
            <a href="#" data-toggle-state="aside-toggled" class="visible-xs">
                <em class="fa fa-navicon"></em>
            </a>
        </li>
        <!-- START Messages menu (dropdown-list)-->
        <li class="dropdown dropdown-list">
            <a href="#" data-toggle="dropdown" data-play="flipInX" class="dropdown-toggle">
                <em class="fa fa-envelope"></em>
            </a>
            <!-- START Dropdown menu-->
            <ul class="dropdown-menu">
                <li class="dropdown-menu-header">Unread messages</li>
                <li class="p-sm">
                <input type="text" placeholder="Find contacts.." onfocus="javascript:void(0);" class="form-control">
                </li>
                <li>
                <div class="scroll-viewport">
                    <!-- START list group-->
                    <div class="list-group scroll-content">
                        <!-- START list group item-->
                        <a href="#" class="list-group-item">
                            <div class="media">
                            <div class="pull-left">
                                <img src="{{ asset('app/img/user/01.jpg') }}" alt="Image" class="media-object img-circle thumb32">
                            </div>
                            <div class="media-body clearfix">
                                <small class="pull-right">5m</small>
                                <strong class="media-heading text-primary">
                                    <span class="circle circle-success circle-md"></span>Greg Lewis</strong>
                                <p class="mb-sm">
                                    <small>Nunc vel dui et leo sagittis fringilla.</small>
                                </p>
                            </div>
                            </div>
                        </a>
                        <!-- END list group item-->
                        <!-- START list group item-->
                        <a href="#" class="list-group-item">
                            <div class="media">
                            <div class="pull-left">
                                <img src="{{ asset('app/img/user/04.jpg') }}" alt="Image" class="media-object img-circle thumb32">
                            </div>
                            <div class="media-body clearfix">
                                <small class="pull-right">3h</small>
                                <strong class="media-heading text-primary">
                                    <span class="circle circle-success circle-md"></span>Constance Cook</strong>
                                <p class="mb-sm">
                                    <small>Nunc vel dui et leo sagittis fringilla.</small>
                                </p>
                            </div>
                            </div>
                        </a>
                        <!-- END list group item-->
                        <!-- START list group item-->
                        <a href="#" class="list-group-item">
                            <div class="media">
                            <div class="pull-left">
                                <img src="{{ asset('app/img/user/03.jpg') }}" alt="Image" class="media-object img-circle thumb32">
                            </div>
                            <div class="media-body clearfix">
                                <small class="pull-right">3h</small>
                                <strong class="media-heading text-primary">
                                    <span class="circle circle-danger circle-md"></span>Cody Barnes</strong>
                                <p class="mb-sm">
                                    <small>Nunc vel dui et leo sagittis fringilla.</small>
                                </p>
                            </div>
                            </div>
                        </a>
                        <!-- END list group item-->
                        <!-- START list group item-->
                        <a href="#" class="list-group-item">
                            <div class="media">
                            <div class="pull-left">
                                <img src="{{ asset('app/img/user/05.jpg') }}" alt="Image" class="media-object img-circle thumb32">
                            </div>
                            <div class="media-body clearfix">
                                <small class="pull-right">4h</small>
                                <strong class="media-heading text-primary">
                                    <span class="circle circle-danger circle-md"></span>Gina Robinson</strong>
                                <p class="mb-sm">
                                    <small>Nunc vel dui et leo sagittis fringilla.</small>
                                </p>
                            </div>
                            </div>
                        </a>
                        <!-- END list group item-->
                        <!-- START list group item-->
                        <a href="#" class="list-group-item">
                            <div class="media">
                            <div class="pull-left">
                                <img src="{{ asset('app/img/user/06.jpg') }}" alt="Image" class="media-object img-circle thumb32">
                            </div>
                            <div class="media-body clearfix">
                                <small class="pull-right">yesterday</small>
                                <strong class="media-heading text-primary">
                                    <span class="circle circle-danger circle-md"></span>Violet Olson</strong>
                                <p class="mb-sm">
                                    <small>Nunc vel dui et leo sagittis fringilla.</small>
                                </p>
                            </div>
                            </div>
                        </a>
                        <!-- END list group item-->
                    </div>
                    <!-- END list group-->
                </div>
                </li>
                <!-- START dropdown footer-->
                <li class="p">
                <a href="#" class="text-center">
                    <small class="text-primary">More messages</small>
                </a>
                </li>
                <!-- END dropdown footer-->
            </ul>
            <!-- END Dropdown menu-->
        </li>
        <!-- END Messages menu (dropdown-list)-->
        <!-- START User avatar toggle-->
        <li>
            <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
            <a href="#" data-toggle-state="aside-user">
                <em class="fa fa-user"></em>
            </a>
        </li>
        <!-- END User avatar toggle-->
    </ul>
    <!-- END Left navbar-->
    <!-- START Right Navbar-->
    <ul class="nav navbar-nav navbar-right">
        <!-- Search icon-->
        <li>
            <a href="#" data-toggle="navbar-search">
                <em class="fa fa-search"></em>
            </a>
        </li>
        <!-- Fullscreen-->
        <li>
            <a href="#" data-toggle="fullscreen">
                <em class="fa fa-expand"></em>
            </a>
        </li>
        <!-- START Alert menu-->
        <li class="dropdown dropdown-list">
            <a href="#" data-toggle="dropdown" data-play="flipInX" class="dropdown-toggle">
                <em class="fa fa-bell"></em>
                <div class="label label-danger">11</div>
            </a>
            <!-- START Dropdown menu-->
            <ul class="dropdown-menu">
                <li>
                <!-- START list group-->
                <div class="list-group">
                    <!-- list item-->
                    <a href="#" class="list-group-item">
                        <div class="media">
                            <div class="pull-left">
                            <em class="fa fa-twitter fa-2x text-info"></em>
                            </div>
                            <div class="media-body clearfix">
                            <p class="m0">New followers</p>
                            <p class="m0 text-muted">
                                <small>1 new follower</small>
                            </p>
                            </div>
                        </div>
                    </a>
                    <!-- list item-->
                    <a href="#" class="list-group-item">
                        <div class="media">
                            <div class="pull-left">
                            <em class="fa fa-envelope fa-2x text-warning"></em>
                            </div>
                            <div class="media-body clearfix">
                            <p class="m0">New e-mails</p>
                            <p class="m0 text-muted">
                                <small>You have 10 new emails</small>
                            </p>
                            </div>
                        </div>
                    </a>
                    <!-- list item-->
                    <a href="#" class="list-group-item">
                        <div class="media">
                            <div class="pull-left">
                            <em class="fa fa-tasks fa-2x text-success"></em>
                            </div>
                            <div class="media-body clearfix">
                            <p class="m0">Pending Tasks</p>
                            <p class="m0 text-muted">
                                <small>11 pending task</small>
                            </p>
                            </div>
                        </div>
                    </a>
                    <!-- last list item-->
                    <a href="#" class="list-group-item">
                        <small>More notifications</small>
                        <span class="label label-danger pull-right">14</span>
                    </a>
                </div>
                <!-- END list group-->
                </li>
            </ul>
            <!-- END Dropdown menu-->
        </li>
        <!-- END Alert menu-->
        <!-- START Contacts button-->
        <li>
            <a href="#" data-toggle-state="offsidebar-open">
                <em class="fa fa-group"></em>
            </a>
        </li>
        <!-- END Contacts menu-->
    </ul>
    <!-- END Right Navbar-->
    </div>
    <!-- END Nav wrapper-->
    <!-- START Search form-->
    <form role="search" action="http://themicon.co/theme/beadmin/v1.1/search.html" class="navbar-form">
    <div class="form-group has-feedback">
        <input type="text" placeholder="Type and hit Enter.." class="form-control">
        <div data-toggle="navbar-search-dismiss" class="fa fa-times form-control-feedback"></div>
    </div>
    <button type="submit" class="hidden btn btn-default">Submit</button>
    </form>
    <!-- END Search form-->
</nav>
<!-- END Top Navbar-->