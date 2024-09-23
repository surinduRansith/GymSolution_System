<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="{{route('dashboard')}}">Gym Solution</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{route('members.data')}}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Members</span>
                    </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{route('scheduletype.insert')}}" class="sidebar-link">
                    <i class="lni lni-dumbbell"></i>
                      <span>Schedule Types</span>
                  </a>
              </li>
                <li class="sidebar-item">
                    <a href="{{route('paymentreport.show')}}" class="sidebar-link">
                      <i class="lni lni-invest-monitor"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('attendancereport.show')}}" class="sidebar-link">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                        <a href="{{route('loginshow.page')}}" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('registration.page')}}" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#logout" aria-expanded="false" aria-controls="logout">
                    <i class="lni lni-exit"></i>
                        <span>Logout</span>
                </a>
                <ul id="logout" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                    <a href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();" class="sidebar-link">Logout</a>
                    </li>
    
                </form>
                    <li class="sidebar-item">
                        <a href="{{route('profile.edit')}}" class="sidebar-link">Profile</a>
                    </li>
                </ul>
                </li>
            </ul>
        </aside>
        <div class="main p-3">
          <div class="container-fluid">
           

                @yield('content')

              
            </div>
        </div>
    </div>


</nav>
