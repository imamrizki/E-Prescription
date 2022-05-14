<!-- Navigation -->
<ul class="navbar-nav">
    <li class="nav-item @yield('obat_alkes_active')">
        <a class="nav-link" href="{{ route('obat_alkes') }}">
            <i class="fa fa-medkit text-success"></i> Obat & Alkes
        </a>
    </li>
    <li class="nav-item @yield('signa_policy_active')">
        <a class="nav-link" href="{{ route('signa_policy') }}">
            <i class="fa fa-list-alt text-danger"></i> Signa Policy
        </a>
    </li>
</ul>
<hr class="my-3">
<ul class="navbar-nav mb-md-3">
    <li class="nav-item @yield('prescription_active')">
        <a class="nav-link" href="{{ route('prescriptions') }}">
            <i class="ni ni-tv-2 text-info"></i> Prescriptions
        </a>
    </li>
</ul>
