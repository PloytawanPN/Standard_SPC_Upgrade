<div>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/assets/image/logo.png" alt="">
                </span>
                <div class="text header-text">
                    <span class="name">Statistical</span>
                    <span class="Profession">Process Control</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/spc/dashboard" id="dashboard">
                            <i class="bx bx-home-alt icon" id="dash_icon"></i>
                            <span class="text nav-text" id="dash_text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/spc/chart" id="chart">
                            <i class='bx bx-bar-chart-alt-2 icon' id="chart_icon"></i>
                            <span class="text nav-text" id="chart_text">Control Chart</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/spc/logger" id="logger">
                            <i class='bx bx-copy-alt icon' id="log_icon"></i>
                            <span class="text nav-text" id="log_text">Data Logger</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/spc/parameter" id="parameter">
                            <i class='bx bx-message-square-add icon' id="param_icon"></i>
                            <span class="text nav-text" id="param_text">Parameter</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/spc/request" id="request">
                            <i class='bx bx-message-alt-error icon' id="request_icon"></i>
                            <span class="text nav-text" id="request_text">Request</span>
                        </a>
                    </li>
                    @if ($user_detail->role != 0)
                        <li class="nav-link">
                            <a href="/spc/approve" id="approve">
                                <i class='bx bx-check-shield icon' id="approve_icon"></i>
                                <span class="text nav-text" id="approve_text">Approve</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-link">
                        <a href="/spc/setting" id="setting">
                            <i class='bx bx-cog icon' id="set_icon"></i>
                            <span class="text nav-text" id="set_text">Setting</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <i class='bx bx-user icon'></i>
                    <span class="text nav-text">{{ $username }}.{{ $id }} </span>
                </li>
                <li class="" wire:click="signout">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
</div>
