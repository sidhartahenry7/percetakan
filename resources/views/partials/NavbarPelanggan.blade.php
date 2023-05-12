<nav id="sidebar" class="sidebar">
    <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
    </div>
    <div class="p-2 pt-5" style="background: #FFC300">
        <img src="{{ asset('/images/Logo-Soerabaja45.png') }}" width="100%" height="100" style="object-fit: scale-down;">
        <br>
        <h6 class="text-center" style="color: black"><b>Welcome, {{ auth('pelanggan')->user()->nama_pelanggan }}!</b></h6>
        <p class="text-center" style="color: black">{{ auth('pelanggan')->user()->email }}</p>
        <ul class="list-unstyled components mb-5" id="nav_accordion">
            <li class="nav-item {{ ($title === "Dashboard") ? 'active' : '' }}">
                <a href="{{url('/dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false"
                    aria-controls="profile">
                    <span class="menu-title">Profile</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="profile">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Profile") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('profile')}}">Profile Saya</a>
                        </li>
                        <li class="nav-item {{ ($title === "Change Password") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('user-change-password')}}">Change Password</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item {{ ($title === "Kategori Produk") ? 'active' : '' }}">
                <a href="{{url('/category')}}">Kategori Produk</a>
            </li> --}}
            <li class="nav-item {{ ($title === "Keranjang Saya") ? 'active' : '' }}">
                <a href="{{url('/shopping-cart')}}">Keranjang Saya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false"
                    aria-controls="transaksi">
                    <span class="menu-title">Transaksi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Penawaran") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/daftar-penawaran')}}">Daftar Penawaran</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Transaksi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/daftar-transaksi')}}">Daftar Transaksi</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Komplain") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/daftar-komplain') }}">Daftar Komplain</a>
                        </li>
                    </ul>
                </div>
            </li>
            <br>
            <form action="{{url('/logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-lock"></i> Logout
                </button>
            </form>
        </ul>
    </div>
</nav>