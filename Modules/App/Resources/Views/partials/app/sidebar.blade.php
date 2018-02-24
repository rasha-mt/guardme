<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li>
                <a href="/account/dashboard" class="waves-effect">
                    <i class="fa fa-home"></i>
                    <span class="hide-menu"> Dashboard</span>
                </a>
            </li>

            <li>
                <a href="/account/teams" class="waves-effect">
                    <i class="fa fa-users"></i>
                    <span class="hide-menu"> Teams <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="/account/teams"><i class="fa fa-circle-o"></i> Overview</a> </li>
                    <li> <a href="/account/teams/edit"><i class="fa fa-pencil"></i> Edit Team</a> </li>
                    <li> <a href="/account/teams/favourites"><i class="fa fa-heart red-text"></i> Favourites</a> </li>
                    <li> <a href="/account/teams/report-user"><i class="fa fa-circle"></i> Report Freelancer</a> </li>
                </ul>
            </li>


            <li>
                <a href="/account/profile" class="{{ isPath('account/profile') ? 'active' : '' }} waves-effect">
                    <i class="fa fa-user"></i>
                    <span class="hide-menu"> Profile <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/profile"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="/account/profile/edit"><i class="fa fa-edit"></i> Edit profile</a></li>
                    <li><a href="/account/feedback"><i class="fa fa-reply"></i> Feedback</a></li>
                    <li><a href="/account/delete"><i class="fa fa-remove"></i> Delete Account</a></li>
                </ul>
            </li>

            <li >
                <a href="/account/wallet" class="{{ isPath('account/wallet') ? 'active' : '' }}">
                    <i class="ti ti-wallet"></i>
                    <span class="hide-menu"> Wallet <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                @if(hasRole(config('guardme.acl.Employer')))
                    <li><a href="/account/wallet/escrow"><i class="fa fa-circle-o"></i> Escrow</a></li>
                    
                    <li><a href="/account/wallet/paywithpaypal"><i class="fa fa-plus-circle"></i> Add Funds</a></li>
                     <li><a href="/account/wallet/withdrawInputs"><i class="fa fa-undo"></i>  Withdraw</a></li>
                    @endif

                        @if(hasRole(config('guardme.Super_Admin')) or hasRole(config('guardme.acl.Admin')))
                     <li><a href="/account/wallet/list-history"><i class="fa fa-list-alt"></i>  History</a></li>
                     <li><a href="/account/wallet/list-withdraw"><i class="fa fa-check"></i> Approve Withdraws</a></li>
                      @endif
                    <li><a href="/account/wallet/approve-payment"><i class="fa fa-check"></i> Approve Payment</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/schedules" class="{{ isPath('account/schedules') ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i>
                    <span class="hide-menu"> Jobs <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/jobs/schedule"><i class="fa fa-calendar-check-o"></i> Active Schedule</a></li>
                    <li><a href="/account/jobs/completed"><i class="fa fa-check"></i> Completed</a></li>
                    <li><a href="/account/jobs/on-going"><i class="fa fa-circle-o"></i> On-going</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/reports" class="{{ isPath('account/reports') ? 'active' : '' }} ">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="hide-menu"> Reports</span>
                </a>
            </li>

            <li >
                <a href="/account/support" class="{{ isPath('account/support') ? 'active' : '' }}">
                    <i class="fa fa-handshake-o"></i>
                    <span class="hide-menu"> Support <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li><a href="/account/support/tickets/create"><i class="fa fa-plus-circle"></i> Create Ticket</a></li>
                    <li><a href="/account/support/tickets/open"><i class="fa fa-circle-o"></i> Open Ticket</a></li>
                    <li><a href="/account/support/tickets/close"><i class="fa fa-remove"></i> Closed Ticket</a></li>
                </ul>
            </li>

            <li>
                <a href="/account/settings" class="{{ isPath('account/settings') ? 'active' : '' }}">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu"> Settings <span class="fa arrow"></span></span>
                </a>

                <ul class="nav nav-second-level">
                    <li class="{{ isPath('account/privacy') ? 'active' : '' }} ">
                        <a href="/account/privacy" class="">
                            <i class="fa fa-lock"></i> <span>Privacy</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="/account/invite" class="{{ isPath('account/invite') ? 'active' : '' }} ">
                    <i class="fa fa-share-alt"></i>
                    <span class="hide-menu"> Invite Users</span>

                </a>
            </li>

            @if(hasRole(config('guardme.acl.Super_Admin')))
            <li>
                <a href="/account/acl" class="{{ isPath('account/acl') ? 'active' : '' }} ">
                    <i class="fa fa-lock"></i>
                    <span class="hide-menu"> Access Control</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>