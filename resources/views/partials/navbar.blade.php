<nav id="sidebar" class="sidebar">
    <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
    </div>
    <div class="p-2 pt-5">
        <img src="/images/Logo-Cassa.png" width="200" height="100" style="object-fit: scale-down;">
        <br>
        <ul class="list-unstyled components mb-5" id="nav_accordion">
            @if(auth()->user()->user_role != "Admin")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false"
                    aria-controls="profile">
                    <span class="menu-title">Profile</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="profile">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Data Diri") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('data-diri')}}">Data Diri</a>
                        </li>
                        <li class="nav-item {{ ($title === "Change Password") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('change-password')}}">Change Password</a>
                        </li>
                    </ul>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false"
                    aria-controls="profile">
                    <span class="menu-title">Profile</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="profile">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Change Password") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('change-password')}}">Change Password</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="nav-item {{ ($title === "Daftar Cabang") ? 'active' : '' }}">
                <a href="/list-cabang">Cabang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pegawai" aria-expanded="false"
                    aria-controls="pegawai">
                    <span class="menu-title">Pegawai</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pegawai">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{url('pegawai')}}">Add Pegawai</a>
                        </li> --}}
                        <li class="nav-item {{ ($title === "Daftar Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-pegawai')}}">Daftar Pegawai</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{url('jadwal')}}">Add Jadwal Kerja Pegawai</a>
                        </li> --}}
                        <li class="nav-item {{ ($title === "Daftar Jadwal Bekerja Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-jadwal')}}">Jadwal Kerja Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#absensi" aria-expanded="false"
                    aria-controls="absensi">
                    <span class="menu-title">Absensi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="absensi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Absensi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('absensi')}}">Check In / Check Out</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Absensi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-absensi')}}">Daftar Absensi</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($title === "Daftar Gaji") ? 'active' : '' }}">
                <a href="/list-gaji">Gaji</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#gaji" aria-expanded="false"
                    aria-controls="gaji">
                    <span class="menu-title">Gaji</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="gaji">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('gaji')}}">Add Gaji</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('list-gaji')}}">Daftar Gaji</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#produk" aria-expanded="false"
                    aria-controls="produk">
                    <span class="menu-title">Produk</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="produk">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{url('kategori')}}">Add Kategori</a>
                        </li> --}}
                        <li class="nav-item {{ ($title === "Daftar Kategori") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-kategori')}}">Daftar Kategori</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Bahan Baku") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-bahan-baku')}}">Daftar Bahan Baku</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Produk Tinta") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-tinta')}}">Daftar Produk Tinta</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Finishing") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-finishing')}}">Daftar Finishing</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Detail Produk") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-detail-produk')}}">Detail Produk</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($title === "Daftar Promo") ? 'active' : '' }}">
                <a href="/list-promo">Promo</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#promo" aria-expanded="false"
                    aria-controls="promo">
                    <span class="menu-title">Promo</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="promo">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('promo')}}">Add Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('list-promo')}}">Daftar Promo</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item {{ ($title === "Daftar Pelanggan") ? 'active' : '' }}">
                <a href="/list-pelanggan">Pelanggan</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pelanggan" aria-expanded="false"
                    aria-controls="pelanggan">
                    <span class="menu-title">Pelanggan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pelanggan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('pelanggan')}}">Add Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('list-pelanggan')}}">Daftar Pelanggan</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false"
                    aria-controls="transaksi">
                    <span class="menu-title">Transaksi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Antrian") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/list-antrian')}}">Antrian</a>
                        </li>
                        <li class="nav-item {{ ($title === "Transaksi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/transaksi')}}">Daftar Transaksi</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{url('/komplain')}}">Komplain</a>
                        </li> --}}
                        <li class="nav-item {{ ($title === "Daftar Komplain") ? 'active' : '' }}">
                            <a href="{{ url('/list-komplain') }}">Daftar Komplain</a>
                        </li>
                    </ul>
                </div>
            </li>
            <br>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">
                {{-- <button type="button" class="btn btn-danger"  onclick="window.location.href='/'"> --}}
                    <i class="fa fa-lock"> Logout</i>
                </button>
            </form>
        </ul>
    </div>
</nav>