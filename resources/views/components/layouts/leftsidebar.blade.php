<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ url('/') }}">
            <img style="max-height:70px" src="{{ asset('/images/logo.png') }}" alt="">
        </a>
    </div>
  
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <!--Hotels-->
                <li class="d-none">
                <a href="/hotels" class="dropdown-toggle no-arrow">
                    <i class="icon-copy fa fa-hotel" aria-hidden="true"></i><span class="mtext">Hotels</span>
                </a>
                </li>
                <!--Transportation Booking-->
                <li>
                    <a href="/transportation" class="dropdown-toggle no-arrow">
                        <i class="icon-copy fa fa-car" aria-hidden="true"></i><span class="mtext">Transportation</span>
                    </a>
                </li>
                 <!--Balance-->
                 <li>
                    <a href="/user/balance" class="dropdown-toggle no-arrow">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i><span class="mtext">Balance</span>
                    </a>
                </li>
                <!--setting-->
                <li>
                    <a href="/setting" class="dropdown-toggle no-arrow">
                        <i class="icon-copy fa fa-cog" aria-hidden="true"></i><span class="mtext">Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>