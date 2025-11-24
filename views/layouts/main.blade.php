<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @php($website_settings = app(App\Settings\WebsiteSettings::class))
  @php($general_settings = app(App\Settings\GeneralSettings::class))
  @php($discord_settings = app(App\Settings\DiscordSettings::class))
  @use('App\Constants\PermissionGroups')

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="{{ $website_settings->seo_title }}" property="og:title">
  <meta content="{{ $website_settings->seo_description }}" property="og:description">
  <meta
    content='{{ \Illuminate\Support\Facades\Storage::disk('public')->exists('logo.png') ? asset('storage/logo.png') : asset('images/ctrlpanel_logo.png') }}'
    property="og:image">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="icon"
        href="{{ \Illuminate\Support\Facades\Storage::disk('public')->exists('favicon.ico') ? asset('storage/favicon.ico') : asset('favicon.ico') }}"
        type="image/x-icon">

  <script src="{{ asset('plugins/alpinejs/3.12.0_cdn.min.js') }}" defer></script>

  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

  <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

  <link rel="preload" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  </noscript>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
  <style>
    #userDropdown.dropdown-toggle::after {
      display: none !important;
    }
  </style>
  <link rel="stylesheet" href="{{ asset('themes/MayTheme/app.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/MayTheme/css/may.css') }}?v={{ config('app.version') }}">
</head>

<body class="sidebar-mini layout-fixed dark-mode" style="height: auto;">
<div class="wrapper">
  <nav class="main-header sticky-top navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                Cuenta
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('notifications.index') }}" class="dropdown-item">
                    <i class="fas fa-bell mr-2"></i> Notificaciones
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.index') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('preferences.index') }}" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Preferencias
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            <small class="text-white"><i class="fas fa-coins mr-1"></i>{{ Currency::formatForDisplay(Auth::user()->credits) }}</small>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" style="overflow-y: auto">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('home') }}"
               class="nav-link @if (Request::routeIs('home')) active @endif">
              <i class="nav-icon fa fa-home"></i>
              <p>Panel de control</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('servers.index') }}"
               class="nav-link @if (Request::routeIs('servers.*')) active @endif">
              <i class="nav-icon fa fa-server"></i>
              <p>Servidores
                <span class="badge badge-info right">{{ Auth::user()->servers()->count() }} /
                                        {{ Auth::user()->server_limit }}</span>
              </p>
            </a>
          </li>

          @php($ticket_enabled = app(App\Settings\TicketSettings::class)->enabled)
          @if ($ticket_enabled)
            @canany(PermissionGroups::TICKET_PERMISSIONS)
              <li class="nav-item">
                <a href="{{ route('ticket.index') }}"
                   class="nav-link @if (Request::routeIs('ticket.*')) active @endif">
                  <i class="nav-icon fas fa-ticket-alt"></i>
                  <p>Ticket de Soporte</p>
                </a>
              </li>
            @endcanany
          @endif

          <li class="nav-item">
            <a href="{{ route('store.index') }}" class="nav-link @if (Request::routeIs('store.*')) active @endif">
                <i class="nav-icon fas fa-shopping-basket"></i>
                <p>Tienda</p>
            </a>
           </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#redeemVoucherModal"
               href="javascript:void(0)">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>Canjear código</p>
            </a>
          </li>
          @if (session()->get('previousUser'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.logbackin') }}">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>Volver a iniciar sesión</p>
              </a>
            </li>
          @endif

          @canany(array_merge(
              PermissionGroups::TICKET_PERMISSIONS,
              PermissionGroups::OVERVIEW_PERMISSIONS,
              PermissionGroups::TICKET_ADMIN_PERMISSIONS,
              PermissionGroups::TICKET_BLACKLIST_PERMISSIONS,
              PermissionGroups::ROLES_PERMISSIONS,
              PermissionGroups::SETTINGS_PERMISSIONS,
              PermissionGroups::API_PERMISSIONS,
              PermissionGroups::USERS_PERMISSIONS,
              PermissionGroups::SERVERS_PERMISSIONS,
              PermissionGroups::PRODUCTS_PERMISSIONS,
              PermissionGroups::STORE_PERMISSIONS,
              PermissionGroups::VOUCHERS_PERMISSIONS,
              PermissionGroups::PARTNERS_PERMISSIONS,
              PermissionGroups::COUPONS_PERMISSIONS,
              PermissionGroups::USEFUL_LINKS_PERMISSIONS,
              PermissionGroups::PAYMENTS_PERMISSIONS,
              PermissionGroups::LOGS_PERMISSIONS
          ))
            <li class="nav-header">{{ __('Administration') }}</li>
          @endcanany

          @canany(PermissionGroups::OVERVIEW_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.overview.index') }}"
                 class="nav-link @if (Request::routeIs('admin.overview.*')) active @endif">
                <i class="nav-icon fa fa-home"></i>
                <p>{{ __('Overview') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::TICKET_ADMIN_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.ticket.index') }}"
                 class="nav-link @if (Request::routeIs('admin.ticket.index')) active @endif">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>{{ __('Ticket List') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::TICKET_BLACKLIST_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.ticket.blacklist') }}"
                 class="nav-link @if (Request::routeIs('admin.ticket.blacklist')) active @endif">
                <i class="nav-icon fas fa-user-times"></i>
                <p>{{ __('Ticket Blacklist') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::ROLES_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.roles.index') }}"
                 class="nav-link @if (Request::routeIs('admin.roles.*')) active @endif">
                <i class="nav-icon fa fa-user-check"></i>
                <p>{{ __('Role Management') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::SETTINGS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.settings.index') . '#icons' }}"
                 class="nav-link @if (Request::routeIs('admin.settings.*')) active @endif">
                <i class="nav-icon fas fa-tools"></i>
                <p>{{ __('Settings') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::API_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.api.index') }}"
                 class="nav-link @if (Request::routeIs('admin.api.*')) active @endif">
                <i class="nav-icon fa fa-gamepad"></i>
                <p>{{ __('Application API') }}</p>
              </a>
            </li>
          @endcanany

          @canany(array_merge(
              PermissionGroups::USERS_PERMISSIONS,
              PermissionGroups::SERVERS_PERMISSIONS,
              PermissionGroups::PRODUCTS_PERMISSIONS
          ))
            <li class="nav-header">{{ __('Management') }}</li>
          @endcanany

          @canany(PermissionGroups::USERS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.users.index') }}"
                 class="nav-link @if (Request::routeIs('admin.users.*')) active @endif">
                <i class="nav-icon fas fa-users"></i>
                <p>{{ __('Users') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::SERVERS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.servers.index') }}"
                 class="nav-link @if (Request::routeIs('admin.servers.*')) active @endif">
                <i class="nav-icon fas fa-server"></i>
                <p>{{ __('Servers') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::PRODUCTS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.products.index') }}"
                 class="nav-link @if (Request::routeIs('admin.products.*')) active @endif">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>{{ __('Products') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::STORE_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.store.index') }}"
                 class="nav-link @if (Request::routeIs('admin.store.*')) active @endif">
                <i class="nav-icon fas fa-shopping-basket"></i>
                <p>{{ __('Store') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::VOUCHERS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.vouchers.index') }}"
                 class="nav-link @if (Request::routeIs('admin.vouchers.*')) active @endif">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>{{ __('Vouchers') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::PARTNERS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.partners.index') }}"
                 class="nav-link @if (Request::routeIs('admin.partners.*')) active @endif">
                <i class="nav-icon fas fa-handshake"></i>
                <p>{{ __('Partners') }}</p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::COUPONS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.coupons.index') }}"
                 class="nav-link @if (Request::routeIs('admin.coupons.*')) active @endif">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>{{ __('Coupons') }}</p>
              </a>
            </li>
          @endcanany

          @canany(array_merge(
              PermissionGroups::USEFUL_LINKS_PERMISSIONS,
              PermissionGroups::PAYMENTS_PERMISSIONS,
              PermissionGroups::LOGS_PERMISSIONS
          ))
            <li class="nav-header">{{ __('Other') }}</li>
          @endcanany

          @canany(PermissionGroups::USEFUL_LINKS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.usefullinks.index') }}"
                 class="nav-link @if (Request::routeIs('admin.usefullinks.*')) active @endif">
                <i class="nav-icon fas fa-link"></i>
                <p>{{ __('Useful Links') }}</p>
              </a>
            </li>
          @endcanany


          @canany(array_merge(
              PermissionGroups::PAYMENTS_PERMISSIONS,
              PermissionGroups::LOGS_PERMISSIONS
          ))
            <li class="nav-header">{{ __('Logs') }}</li>
          @endcanany

          @canany(PermissionGroups::PAYMENTS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.payments.index') }}"
                 class="nav-link @if (Request::routeIs('admin.payments.*')) active @endif">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>{{ __('Payments') }}
                  <span class="badge badge-success right">{{ \App\Models\Payment::count() }}</span>
                </p>
              </a>
            </li>
          @endcanany

          @canany(PermissionGroups::LOGS_PERMISSIONS)
            <li class="nav-item">
              <a href="{{ route('admin.activitylogs.index') }}"
                 class="nav-link @if (Request::routeIs('admin.activitylogs.*')) active @endif">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>{{ __('Activity Logs') }}</p>
              </a>
            </li>
          @endcanany
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    @yield('content')

    @include('modals.redeem_voucher_modal')

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-{{ date('Y') }} <a
        href="{{ url('/') }}">{{ config('app.name','Ctrlpanel.gg') }}</a>.</strong>
    All rights
    reserved. Powered by <a href="https://CtrlPanel.gg">CtrlPanel</a>.
    @if (!str_contains(config('BRANCHNAME'), 'main') && !str_contains(config('BRANCHNAME'), 'unknown'))
      Version <b>{{ config('app')['version'] }} - {{ config('BRANCHNAME') }}</b>
    @endif

    <div class="float-right d-none d-sm-inline-block">
      @if ($website_settings->show_imprint)
        <a target="_blank" href="{{ route('terms', 'imprint') }}"><strong>{{ __('Imprint') }}</strong></a> |
      @endif
      @if ($website_settings->show_privacy)
        <a target="_blank" href="{{ route('terms', 'privacy') }}"><strong>{{ __('Privacy') }}</strong></a>
      @endif
      @if ($website_settings->show_tos)
        | <a target="_blank"
             href="{{ route('terms', 'tos') }}"><strong>{{ __('Terms of Service') }}</strong></a>
      @endif
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script src={{ asset('plugins/select2/js/select2.min.js') }}></script>


<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
</script>
<script>
  const processAlert = (msg) => {
      const regex = /\[REPRODUCE\]\((.*?)\)/;
      const match = msg.match(regex);
      if (match && match[1]) {
          new Audio(match[1]).play().catch(e=>console.log(e));
          return msg.replace(regex, '');
      }
      return msg;
  };

  document.addEventListener("DOMContentLoaded", () => {
      const regex = /\[REPRODUCE\]\((.*?)\)/;
      const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
      let node;
      while(node = walker.nextNode()) {
          const match = node.nodeValue.match(regex);
          if(match && match[1]) {
              new Audio(match[1]).play().catch(e => console.log("Autoplay bloqueado por navegador, necesita interacción"));
              node.nodeValue = node.nodeValue.replace(regex, '');
          }
      }
  });

  @if (Session::has('error'))
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    html: processAlert('{{ Session::get('error') }}'),
  })
  @endif
  @if (Session::has('success'))
  Swal.fire({
    icon: 'success',
    title: processAlert('{{ Session::get('success') }}'),
    position: 'top-end',
    showConfirmButton: false,
    background: '#343a40',
    toast: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  @endif
  @if (Session::has('info'))
  Swal.fire({
    icon: 'info',
    title: processAlert('{{ Session::get('info') }}'),
    position: 'top-end',
    showConfirmButton: false,
    background: '#343a40',
    toast: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  @endif
  @if (Session::has('warning'))
  Swal.fire({
    icon: 'warning',
    title: processAlert('{{ Session::get('warning') }}'),
    position: 'top-end',
    showConfirmButton: false,
    background: '#343a40',
    toast: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  @endif
</script>
<script>document.addEventListener("DOMContentLoaded",()=>{const f=document.querySelector(".main-footer");if(f)f.innerHTML="<div class=\"may-footer-content\">Powered by CtrlPanel ᴹᵃʸᵀʰᵉᵐᵉ <span>|</span> <a href=\"https://github.com/SoySapo6\" target=\"_blank\" class=\"may-link\">SoyMaycol</a></div>";document.querySelectorAll("a").forEach(a=>{if(a.textContent.toUpperCase().includes("GITHUB")){a.href="https://github.com/SoySapo6/MayTheme"}if(a.textContent.includes("CtrlPanel")||a.href.includes("sponsors")){a.innerHTML="<i class=\"fab fa-whatsapp\"></i> Sigueme en WhatsApp";a.href="https://whatsapp.com/channel/0029VayXJte65yD6LQGiRB0R";a.target="_blank"}})});</script>
</body>

</html>
