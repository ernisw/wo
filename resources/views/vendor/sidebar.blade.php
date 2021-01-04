<aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <!-- <img src="{{ asset('smart/dist/img/logos.jpg') }}" alt="SmartAdmin WebApp" aria-roledescription="logo"> -->
                            <span class="page-logo-text mr-1">Shine Moment</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <!-- <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i> -->
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card">
                            <img src="{{ asset('smart/dist/img/logos.jpg') }}" class="profile-image rounded-circle">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                    {{ Auth::user()->name }}
                                    </span>
                                </a>
                      
                            </div>
                            <img src="{{ asset('smart/dist/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">

                        <li>

                        <a href="{{ route('dataLayananVendor') }}" title="Infografis" data-filter-tags="infografis">
                                    <i class="fal fa-image"></i>
                                    <span class="nav-link-text" data-i18n="nav.infografis">Layanan</span>
                                </a>

                                </li>

                                <li>

                        <a href="{{ route('dataPengajuanKerjasama') }}" title="Infografis" data-filter-tags="infografis">
                                    <i class="fal fa-image"></i>
                                    <span class="nav-link-text" data-i18n="nav.infografis">Pengajuan Permintaan Kerjasama</span>
                                </a>

                                </li>

                                <li>

                        <a href="{{ route('dataProfile') }}" title="Infografis" data-filter-tags="infografis">
                                    <i class="fal fa-image"></i>
                                    <span class="nav-link-text" data-i18n="nav.infografis">Profile</span>
                                </a>

                                </li>

                                <li>

                        <a href="{{ route('dataTransaksi1') }}" title="Infografis" data-filter-tags="infografis">
                                    <i class="fal fa-image"></i>
                                    <span class="nav-link-text" data-i18n="nav.infografis">Transaksi</span>
                                </a>

                                </li>

                                <!-- <li class="nav-title">Transaksi</li>
                            <li>
                                <a href="#" title="UI Components" data-filter-tags="ui components">
                                    <i class="fal fa-window"></i>
                                    <span class="nav-link-text" data-i18n="nav.ui_components">Transaksi</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Transaksi Belum Diproses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Transaksi Sudah Diproses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Selesai</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->

                                 <!-- <li> -->

                            <!-- <li class="nav-title">Transaksi</li>
                            <li>
                                <a href="#" title="UI Components" data-filter-tags="ui components">
                                    <i class="fal fa-window"></i>
                                    <span class="nav-link-text" data-i18n="nav.ui_components">Transaksi</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Transaksi Belum Diproses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Transaksi Sudah Diproses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Selesai</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
</aside>
