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
        <h6 class="text-center" style="color: black"><b>Welcome, {{ auth()->user()->nama_lengkap }}!</b></h6>
        <p class="text-center" style="color: black">{{ auth()->user()->user_role }}</p>
        <ul class="list-unstyled components mb-5" id="nav_accordion">
            <li class="nav-item {{ ($title === "Dashboard") ? 'active' : '' }}">
                <a href="{{url('/dashboard')}}">Dashboard</a>
            </li>
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
                <a href="{{url('/list-cabang')}}">Cabang</a>
            </li>
            <li class="nav-item {{ ($title === "Daftar Pegawai") ? 'active' : '' }}">
                <a href="{{url('/list-pegawai')}}">Pegawai</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pegawai" aria-expanded="false"
                    aria-controls="pegawai">
                    <span class="menu-title">Pegawai</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pegawai">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-pegawai')}}">Daftar Pegawai</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Jadwal Bekerja Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-jadwal')}}">Jadwal Kerja Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            @if(auth()->user()->user_role == "Admin" || auth()->user()->user_role == "Kepala Toko" || auth()->user()->user_role == "Wakil Kepala Toko")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#biaya" aria-expanded="false"
                    aria-controls="biaya">
                    <span class="menu-title">Biaya</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="biaya">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Jenis Biaya") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-jenis-biaya')}}">Jenis Biaya</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Pembayaran") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-pembayaran')}}">Pembayaran</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pembelian" aria-expanded="false"
                    aria-controls="pembelian">
                    <span class="menu-title">Pembelian</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pembelian">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Pembelian Bahan Baku") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-pembelian-bahan-baku')}}">Bahan Baku</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Pembelian Tinta") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-pembelian-tinta')}}">Tinta</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#kartu-stok" aria-expanded="false"
                    aria-controls="kartu-stok">
                    <span class="menu-title">Kartu Stok</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="kartu-stok">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Kartu Stok Bahan Baku") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('kartu-stok-bahan-baku')}}">Bahan Baku</a>
                        </li>
                        <li class="nav-item {{ ($title === "Kartu Stok Tinta") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('kartu-stok-tinta')}}">Tinta</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#produk" aria-expanded="false"
                    aria-controls="produk">
                    <span class="menu-title">Produk</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="produk">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Kategori") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-kategori')}}">Daftar Kategori</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Bahan Baku") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-bahan-baku')}}">Daftar Bahan Baku</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Produk Tinta") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-tinta')}}">Daftar Produk Tinta</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Bahan Setengah Jadi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('list-bahan-setengah-jadi')}}">Daftar Bahan Setengah Jadi</a>
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
            <li class="nav-item {{ ($title === "Daftar Pelanggan") ? 'active' : '' }}">
                <a href="{{url('/list-pelanggan')}}">Pelanggan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false"
                    aria-controls="transaksi">
                    <span class="menu-title">Transaksi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Daftar Promo") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/list-promo')}}">Promo</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Penawaran") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/list-penawaran')}}">Daftar Penawaran</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Antrian") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/list-antrian')}}">Antrian</a>
                        </li>
                        <li class="nav-item {{ ($title === "Transaksi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/transaksi')}}">Daftar Transaksi</a>
                        </li>
                        <li class="nav-item {{ ($title === "Daftar Komplain") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/list-komplain') }}">Daftar Komplain</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(auth()->user()->user_role == "Admin")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false"
                    aria-controls="laporan">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Laporan Laba Rugi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/laporan-laba-rugi')}}">Laba Rugi</a>
                        </li>
                        <li class="nav-item {{ ($title === "Laporan Transaksi") ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('/laporan-transaksi')}}">Transaksi</a>
                        </li>
                        <li class="nav-item {{ ($title === "Laporan Pembelian") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/laporan-pembelian') }}">Pembelian</a>
                        </li>
                        <li class="nav-item {{ ($title === "Laporan Performa Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/laporan-performa') }}">Performa Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li>
            @elseif (auth()->user()->user_role == "Kepala Toko" || auth()->user()->user_role == "Wakil Kepala Toko")
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false"
                    aria-controls="laporan">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Laporan Performa Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/laporan-performa') }}">Performa Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false"
                    aria-controls="laporan">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ ($title === "Laporan Performa Pegawai") ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/laporan-performa-individu') }}">Performa Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
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