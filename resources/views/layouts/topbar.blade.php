<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            @if( in_array( \Auth()->user()->role_id,array(1,2) ))
                <ul class="navigation-menu">
                    <li class="has-submenu"> <a href="{{ url('') }}"><i class="dripicons-home"></i> {{ __('page.dashboard') }}</a> </li>
                    @if(\Auth()->user()->hasRole('super-admin') ||
                     \Auth()->user()->hasPermissionTo('view nationalitie') ||
                     \Auth()->user()->hasPermissionTo('view air port') ||
                     \Auth()->user()->hasPermissionTo('view office') ||
                     \Auth()->user()->hasPermissionTo('view contract source') ||
                     \Auth()->user()->hasPermissionTo('view contract source') ||
                     \Auth()->user()->hasPermissionTo('view profession') ||
                     \Auth()->user()->hasPermissionTo('view status') ||
                     \Auth()->user()->hasPermissionTo('view country') ||
                     \Auth()->user()->hasPermissionTo('view religion') ||
                     \Auth()->user()->hasPermissionTo('view terms and advantage') ||
                     \Auth()->user()->hasPermissionTo('view qualifications and experience') ||
                     \Auth()->user()->hasPermissionTo('view marketer') ||
                     \Auth()->user()->hasPermissionTo('view accommodation type') ||
                     \Auth()->user()->hasPermissionTo('view visa type') ||
                     \Auth()->user()->hasPermissionTo('view activity log')
                     )
                        <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.basic') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @if(\Auth()->user()->hasRole('super-admin'))
                                <li><a href="{{ url('/role') }}">{{ __('page.role') }}</a></li>
                            @endif
                            @can('view nationalitie')
                                <li><a href="{{ url('/nationalitie') }}">{{ __('page.nationalities') }}</a></li>
                            @endcan
                            @can('view air port')
                                <li><a href="{{ url('/airport') }}">{{ __('page.airports') }}</a></li>
                            @endcan
                            @can('view office')
                                <li><a href="{{ url('/offices') }}">{{ __('page.offices') }}</a></li>
                            @endcan
                            @can('view contract source')
                                <li><a href="{{ url('/contraact-source') }}">{{ __('page.sources_of_contract') }}</a></li>
                            @endcan
                            @can('view profession')
                                <li><a href="{{ url('/profession') }}">{{ __('page.professions') }}</a></li>
                            @endcan
                            @if(\Auth()->user()->hasRole('super-admin'))
                                <li><a href="{{ url('/users') }}">{{ __('page.users') }}</a></li>
                            @endif
                            @can('view status')
                                <li><a href="{{ url('/status') }}">{{ __('page.status') }}</a></li>
                            @endcan
                            @can('view country')
                                <li><a href="{{ url('/countrys') }}">{{ __('page.countrys') }}</a></li>
                            @endcan
                            @can('view religion')
                                <li><a href="{{ url('/religion') }}">{{ __('page.religions') }}</a></li>
                            @endcan
                            @can('view terms and advantage')
                                <li><a href="{{ url('/terms-and-advantage') }}">{{ __('page.terms_and_advantages') }}</a></li>
                            @endcan
                            @can('view qualifications and experience')
                                <li><a href="{{ url('/qualifications-and-experience') }}">{{ __('page.qualifications_and_experience') }}</a></li>
                            @endcan
                            @can('view marketer')
                                <li><a href="{{ url('/marketer') }}">{{ __('page.marketers') }}</a></li>
                            @endcan
                            @can('view accommodation type')
                                <li><a href="{{ url('/accommodation-type') }}">{{ __('page.accommodation_type') }}</a></li>
                            @endcan
                            @can('view visa type')
                                <li><a href="{{ url('/visa-type') }}">{{ __('page.visa_type') }}</a></li>
                            @endcan
                            @can('view activity log')
                                <li><a href="{{ url('/activity-log') }}">{{ __('page.activity_logs') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @if(\Auth()->user()->hasRole('super-admin') ||
                     \Auth()->user()->hasPermissionTo('view nationalitie') ||
                     \Auth()->user()->hasPermissionTo('view cv') ||
                     \Auth()->user()->hasPermissionTo('view customer') ||
                     \Auth()->user()->hasPermissionTo('view contract')
                     )
                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.office_work') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @can('view cv')
                                <li><a href="{{ url('/office-work/cv') }}">{{ __('page.cv') }}</a></li>
                            @endcan
                            @can('view customer')
                                <li><a href="{{ url('/office-work/customer') }}">{{ __('page.customers') }}</a></li>
                            @endcan
                            @can('view contract')
                                <li><a href="{{ url('/office-work/contract-list') }}">{{ __('page.contract_list') }}</a></li>
                            @endcan
                            @can('view contract')
                                <li><a href="{{ url('/office-work/contract-list/?underwarranty='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                                {{ __('page.under_warranty') }}</a></li>
                            @endcan
                            @can('view contract')
                                <li><a href="{{ url('/office-work/contract-list/?arrivals='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            {{ __('page.arrivals') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @if(\Auth()->user()->hasRole('super-admin') ||
                     \Auth()->user()->hasPermissionTo('view cost center') ||
                     \Auth()->user()->hasPermissionTo('view currency')
                     )
                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.accounting') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @can('view cost center')
                                <li><a href="{{ url('/accounting/cost-center') }}">{{ __('page.cost_centers') }}</a></li>
                            @endcan
                            @can('view currency')
                                <li><a href="{{ url('/accounting/currency') }}">{{ __('page.currencies') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @if(\Auth()->user()->hasRole('super-admin') ||
                     \Auth()->user()->hasPermissionTo('view ticket')||
                     \Auth()->user()->hasPermissionTo('view my ticket')
                     )
                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.support') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @can('view my ticket')
                                <li><a href="{{ url('/support/my-ticket') }}">{{ __('page.my_tickets') }}</a></li>
                            @endcan
                            @can('view ticket')
                                @if(\Auth()->user()->role_id == 1)
                                    <li><a href="{{ url('/support/ticket') }}">{{ __('page.tickets') }}</a></li>
                                @endif
                            @endcan
                        </ul>
                    </li>
                    @endif

                    @can('view accommodation')
                        <li class="has-submenu"> <a href="{{ url('/accommodation') }}"><i class="dripicons-archive"></i> {{ __('page.accommodation') }}</a> </li>
                    @endcan

                    @if(\Auth()->user()->role_id == 1)
                        @can('view invoice')
                            <li class="has-submenu"> <a href="{{ url('/sales/invoice') }}"><i class="dripicons-archive"></i> {{ __('page.invoices') }}</a> </li>
                        @endcan
                        @if(\Auth()->user()->hasRole('super-admin') ||
                             \Auth()->user()->hasPermissionTo('cv report') ||
                             \Auth()->user()->hasPermissionTo('customer report') ||
                             \Auth()->user()->hasPermissionTo('contract report') ||
                             \Auth()->user()->hasPermissionTo('ticket report') ||
                             \Auth()->user()->hasPermissionTo('invoice report') ||
                             \Auth()->user()->hasPermissionTo('arrival report')
                         )
                            <li class="has-submenu"> <a href="{{ url('/reports') }}"><i class="dripicons-archive"></i> {{ __('page.reports') }}</a> </li>
                        @endif
                    @endif
                     <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.language') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @if( Session::get('locale') != 'en' )
                            <li><a href="{{ url('locale/en') }}" > English</a></li>
                            @endif
                            @if( Session::get('locale') != 'ar' )
                            <li><a href="{{ url('locale/ar') }}" > Arabic</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.external_links') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            <li><a target="_blank" href="https://app.musaned.com.sa/#/signin">{{ __('page.visa_support') }}</a></li>
                            <li><a target="_blank" href="https://et.musaned.com.sa/auth/login">{{ __('page.linking_workers_sponsor') }}</a></li>
                            <li><a target="_blank" href="https://enjazit.com.sa/Enjaz/GetVisaInformation/Person"> {{ __('page.endorsements') }}</a></li>
                            <li><a target="_blank" href="https://pros.musaned.com.sa/login">{{ __('page.supporting_recruitment_office_management') }}</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
            @if(\Auth()->user()->role_id == 3 )
                <ul class="navigation-menu">

                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.office_work') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @can('view invoice')
                                <li><a href="{{ url('/office-work/cv') }}">{{ __('page.cv') }}</a></li>
                            @endcan
                        </ul>
                    </li>

                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.language') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            @if( Session::get('locale') != 'en' )
                                <li><a href="{{ url('locale/en') }}" > English</a></li>
                            @endif
                            @if( Session::get('locale') != 'ar' )
                                <li><a href="{{ url('locale/ar') }}" > Arabic</a></li>
                            @endif
                        </ul>
                    </li>



                    <li class="has-submenu"> <a href="#"><i class="dripicons-archive"></i> {{ __('page.support') }} <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu">
                            <li><a href="{{ url('/support/my-ticket') }}">{{ __('page.my_tickets') }}</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
            <!-- End navigation menu -->
        </div>
        <!-- end #navigation -->
    </div>
    <!-- end container -->
</div>
<!-- end navbar-custom -->