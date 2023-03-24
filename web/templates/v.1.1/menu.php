<?php

function menu($user, $menu, $submenu) {
    if ($user == 'siswa') {
        $content = '
            <div class="sidebar-menu nav-collapse">
                <ul>
                    <li class="' . aktif($menu, 1) . '">
                        <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp">
                            <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                            <span class="selected"></span>
                        </a>					
                    </li>
                    <li class="has-sub ' . aktif($menu, 2) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-user fa-fw"></i> <span class="menu-text">Biodata</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 1) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodata">
                                    <span class="sub-menu-text">Data Personal</span></a></li>
                            <li class="' . subaktif($submenu, 2) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodata_ubahpass"><span class="sub-menu-text">Ubah Password</span></a></li>
                            <li class="' . subaktif($submenu, 3) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodata_ayah"><span class="sub-menu-text">Data Ayah</span></a></li>
                            <li class="' . subaktif($submenu, 4) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodata_ibu"><span class="sub-menu-text">Data Ibu</span></a></li>
                            <li class="' . subaktif($submenu, 5) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlbiodata&prog=biodata_wali"><span class="sub-menu-text">Data Wali</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 3) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-book fa-fw"></i> <span class="menu-text">Raport</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 7) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlraport&prog=raport_mainraport"><span class="sub-menu-text">Raport Semester</span></a></li>
                            <li class="' . subaktif($submenu, 8) . '"><a target="_blank" class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlraport&prog=raport_cetaksampul&id='.MyEncrypt($_SESSION['user']).'"><span class="sub-menu-text">Cetak Sampul</span></a></li>
                            <li class="' . subaktif($submenu, 9) . '"><a target="_blank" class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlraport&prog=raport_cetakprestasi&id='.MyEncrypt($_SESSION['user']).'"><span class="sub-menu-text">Cetak Halaman Prestasi
                                    </span></a></li>
                            <li class="' . subaktif($submenu, 10) . '"><a target="_blank" class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlraport&prog=raport_cetakpindah&id='.MyEncrypt($_SESSION['user']).'"><span class="sub-menu-text">Cetak Halaman Pindah dll.
                                    </span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub '.aktif($menu,4).'">
                        <a href="javascript:;" class="">
                        <i class="fa fa-file-text fa-fw"></i> <span class="menu-text">KRS</span>
                        <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="'.subaktif($submenu,10).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlkrs&prog=krs">
                            <span class="sub-menu-text">Penyusunan KRS</span></a></li>
                            <li class="'.subaktif($submenu,11).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlkrs&prog=krs_pa">
                            <span class="sub-menu-text">House Parent</span></a></li>
                            <li class="'.subaktif($submenu,12).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlkrs&prog=krs_lihatjadwal">
                            <span class="sub-menu-text">Lihat Jadwal Pelajaran</span></a></li>
                            <li class="'.subaktif($submenu,13).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlkrs&prog=krs_cetak">
                            <span class="sub-menu-text">Cetak KRS</span></a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /SIDEBAR MENU -->
            </div>
		';
    } elseif ($user == 'admin') {
        $content = '
            <div class="sidebar-menu nav-collapse">
                <ul>
                    <li class="' . aktif($menu, 1) . '">
                        <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp">
                            <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                            <span class="selected"></span>
                        </a>					
                    </li>
                    <li class="has-sub ' . aktif($menu, 2) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-user fa-fw"></i> <span class="menu-text">Biodata</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 1) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodata">
                                    <span class="sub-menu-text">Data Personal</span></a></li>
                            <li class="' . subaktif($submenu, 2) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlbiodata&prog=biodataubahpwd"><span class="sub-menu-text">Ubah Password</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 3) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-home fa-fw"></i> <span class="menu-text">Sekolah</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 3) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlidentitasskl&prog=identitassekolah"><span class="sub-menu-text">Data Identitas Sekolah</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 4) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-users fa-fw"></i> <span class="menu-text">Siswa</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 4) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsiswa&prog=siswadata"><span class="sub-menu-text">Data Siswa</span></a></li>
                            <li class="' . subaktif($submenu, 5) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsiswa&prog=siswa"><span class="sub-menu-text">Tambah Siswa</span></a></li>
                            <li class="' . subaktif($submenu, 41) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsiswa&prog=siswakrs"><span class="sub-menu-text">KRS Siswa</span></a></li>
                            <li class="' . subaktif($submenu, 6) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsiswa&prog=siswa_ubahpwd"><span class="sub-menu-text">Ubah Password Siswa</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 5) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-users fa-fw"></i> <span class="menu-text">Pegawai</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 7) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlpegawai&prog=pegawaidata"><span class="sub-menu-text">Data Pegawai</span></a></li>
                            <li class="' . subaktif($submenu, 8) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlpegawai&prog=pegawai"><span class="sub-menu-text">Tambah Pegawai</span></a></li>
                            <li class="' . subaktif($submenu, 9) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlpegawai&prog=pegawaiubahpwd"><span class="sub-menu-text">Ubah Password Pegawai
                                    </span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 6) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-users fa-fw"></i> <span class="menu-text">Guru</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 10) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlguru&prog=gurudata"><span class="sub-menu-text">Data Guru</span></a></li>
                            <li class="' . subaktif($submenu, 11) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlguru&prog=guru"><span class="sub-menu-text">Tambah Guru</span></a></li>
                            <li class="' . subaktif($submenu, 12) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlguru&prog=guruubahpwd"><span class="sub-menu-text">Ubah Password Guru</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 7) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-tasks fa-fw"></i> <span class="menu-text">Mata Pelajaran</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 13) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmtp&prog=mtpdata"><span class="sub-menu-text">Data Mata Pelajaran</span></a></li>
                            <li class="' . subaktif($submenu, 14) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlmtp&prog=mtp"><span class="sub-menu-text">Tambah Mata Pelajran</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 8) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-sitemap fa-fw"></i> <span class="menu-text">Jurusan</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 15) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctljurusan&prog=jurusandata"><span class="sub-menu-text">Data Jurusan</span></a></li>
                            <li class="' . subaktif($submenu, 16) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctljurusan&prog=jurusan"><span class="sub-menu-text">Tambah Jurusan</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 9) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-subscript fa-fw"></i> <span class="menu-text">Kelas</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 17) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlkelas&prog=kelasdata"><span class="sub-menu-text">Data Kelas</span></a></li>
                            <li class="' . subaktif($submenu, 18) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlkelas&prog=kelas"><span class="sub-menu-text">Tambah Kelas</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 10) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-home fa-fw"></i> <span class="menu-text">Ruang</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 19) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlruang&prog=ruangdata"><span class="sub-menu-text">Data Ruang</span></a></li>
                            <li class="' . subaktif($submenu, 20) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlruang&prog=ruang"><span class="sub-menu-text">Tambah Ruang</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 11) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-home fa-fw"></i> <span class="menu-text">House</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 21) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlhouse&prog=housedata"><span class="sub-menu-text">Data House</span></a></li>
                            <li class="' . subaktif($submenu, 22) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlhouse&prog=houseinput"><span class="sub-menu-text">Tambah House</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 12) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-briefcase fa-fw"></i> <span class="menu-text">Sekolah Asal Siswa</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 23) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsekolah&prog=sekolahdata"><span class="sub-menu-text">Data Sekolah</span></a></li>
                            <li class="' . subaktif($submenu, 24) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlsekolah&prog=sekolah"><span class="sub-menu-text">Tambah Sekolah</span></a></li>
                        </ul>
                    </li>
                    <li class="has-sub ' . aktif($menu, 16) . '">
                        <a href="javascript:;" class="">
                            <i class="fa fa-gear fa-fw"></i> <span class="menu-text">Setting Program</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="' . subaktif($submenu, 35) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stpkrs"><span class="sub-menu-text">Tanggal KRS</span></a></li>
                            <li class="' . subaktif($submenu, 36) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stpnilai"><span class="sub-menu-text">Tanggal Input Nilai</span></a></li>
                            <li class="' . subaktif($submenu, 37) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stpip"><span class="sub-menu-text">Tanggal Generate IP
                                    </span></a></li>
                            <li class="' . subaktif($submenu, 38) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stprapotan"><span class="sub-menu-text">Tanggal Rapotan</span></a></li>
                            <li class="' . subaktif($submenu, 39) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stptsa"><span class="sub-menu-text">Setting Tahun dan Semester Aktif
                                    </span></a></li>
                            <li class="' . subaktif($submenu, 40) . '"><a class="" href="?rt=' . $_SESSION['tipe'] . '&ctl=ctlstp&prog=stpselan"><span class="sub-menu-text">Setting Tahun dan Semester Penjadwalan Sem. Berikutnya
                                    </span></a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /SIDEBAR MENU -->
            </div>
		';
    } elseif ($user == 'guru') {
        $content = '
			<div class="sidebar-menu nav-collapse">
				<ul>
                        <li class="' . aktif($menu, 1) . '">
                                <a href="?rt=' . $_SESSION['tipe'] . '&ctl=ctl&prog=mp">
                                <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                                <span class="selected"></span>
                                </a>					
                        </li>
                        <li class="has-sub ' . aktif($menu, 2) . '">
                                <a href="javascript:;" class="">
                                <i class="fa fa-user fa-fw"></i> <span class="menu-text">Biodata</span>
                                <span class="arrow"></span>
                                </a>
                        <ul class="sub">
                            <li class="'.subaktif($submenu,1).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlbiodata&prog=biodata">
                            <span class="sub-menu-text">Data Personal</span></a></li>
                            <li class="'.subaktif($submenu,2).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlbiodata&prog=biodataubahpwd"><span class="sub-menu-text">Ubah Password</span></a></li>
                        </ul>
					</li>
					<li class="has-sub ' . aktif($menu, 3) . '">
						<a href="javascript:;" class="">
						<i class="fa fa-edit fa-fw"></i> <span class="menu-text">Input Nilai</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
                            <li class="'.subaktif($submenu,4).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlnilai&prog=nilai_listinputcp">
                            <span class="sub-menu-text">Input Nilai Capaian Kompetensi
                            </span></a></li>
                            <li class="'.subaktif($submenu,5).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlnilai&prog=nilai_listinputdk">
                            <span class="sub-menu-text">Input Nilai Deskripsi Kompetensi
                            </span></a></li>
							<li class="' . subaktif($submenu, 6) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlnilai&prog=nilaicetak"><span class="sub-menu-text">Cetak Nilai
							</span></a></li>
							
						</ul>
					</li>
					<li class="has-sub ' . aktif($menu, 4) . '">
						<a href="javascript:;" class="">
						<i class="fa fa-legal fa-fw"></i> <span class="menu-text">House Parent</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
                            <li class="'.subaktif($submenu,7).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlhp&prog=hp_antarmapel">
                            <span class="sub-menu-text">Input Nilai K1 & K2 Antarmapel
                            </span></a></li>
                            <li class="'.subaktif($submenu,8).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlhp&prog=hp_kehadiran">
                            <span class="sub-menu-text">Isian Kehadiran Siswa
                            </span></a></li>
                            <li class="'.subaktif($submenu,9).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlhp&prog=hp_kenaikan">
                            <span class="sub-menu-text">Isian Kenaikan Kelas Siswa
                            </span></a></li>
                            <li class="'.subaktif($submenu,10).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlhp&prog=hp_prestasi"><span class="sub-menu-text">Input Data Prestasi Siswa
                            </span></a></li>
                            <li class="'.subaktif($submenu,11).'"><a class="" href="forms.html"><span class="sub-menu-text">Daftar Siswa Asuh
                            </span></a></li>
						</ul>
					</li>
					<li class="has-sub ' . aktif($menu, 5) . '">
						<a href="javascript:;" class="">
						<i class="fa fa-briefcase fa-fw"></i> <span class="menu-text">Pengajaran</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
							<li class="' . subaktif($submenu, 12) . '"><a class="" href="?rt='. $_SESSION['tipe'] .'&ctl=ctlpengajaran&prog=pengajarandpp"><span class="sub-menu-text">Daftar Peserta Pembelajaran
							</span></a></li>
							<li class="'.subaktif($submenu,13).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlpengajaran&prog=pengajaran_jadwal"><span class="sub-menu-text">Jadwal Mengajar</span></a></li>
						</ul>
					</li>
				</ul>
				<!-- /SIDEBAR MENU -->
			</div>
		';
    } elseif ($user == 'pegawai') {
        $content = '
			<div class="sidebar-menu nav-collapse">
				<ul>
					<li class="'.aktif($menu,1).'">
						<a href="?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp">
						<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
						<span class="selected"></span>
						</a>					
					</li>
					<li class="has-sub '.aktif($menu,2).'">
						<a href="javascript:;" class="">
						<i class="fa fa-user fa-fw"></i> <span class="menu-text">Biodata</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
							<li class="'.subaktif($submenu,1).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlbiodata&prog=biodata">
							<span class="sub-menu-text">Data Personal</span></a></li>
						</ul>
					</li>
					<li class="has-sub '.aktif($menu,3).'">
						<a href="javascript:;" class="">
						<i class="fa fa-users fa-fw"></i> <span class="menu-text">Siswa</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
							<li class="'.subaktif($submenu,3).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlsiswa&prog=mainsiswa"><span class="sub-menu-text">Data Siswa</span></a></li>
							<li class="'.subaktif($submenu,4).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlsiswa&prog=siswa_input"><span class="sub-menu-text">Tambah Siswa</span></a></li>
							<li class="'.subaktif($submenu,5).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlsiswa&prog=mainstatus"><span class="sub-menu-text">Status Siswa</span></a></li>
							<li class="'.subaktif($submenu,6).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlsiswa&prog=siswa_ubahpwd"><span class="sub-menu-text">Ubah Password Siswa</span></a></li>
						</ul>
					</li>
					<li class="has-sub '.aktif($menu,4).'">
						<a href="javascript:;" class="">
						<i class="fa fa-calendar fa-fw"></i> <span class="menu-text">Jadwal</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
							<li class="'.subaktif($submenu,7).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctljadwal&prog=jadwal"><span class="sub-menu-text">Penjadwalan Mapel</span></a></li>
							<li class="'.subaktif($submenu,8).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctljadwal&prog=jadwal_next"><span class="sub-menu-text">Penjadwalan Mapel Sem. Selanjutnya</span></a></li>
							<li class="'.subaktif($submenu,10).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctljadwal&prog=jadwal_ujian"><span class="sub-menu-text">Jadwal Ujian
							</span></a></li>
						</ul>
					</li>
					<li class="has-sub '.aktif($menu,5).'">
						<a href="javascript:;" class="">
						<i class="fa fa-book fa-fw"></i> <span class="menu-text">Raport</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub">
							<li class="'.subaktif($submenu,11).'"><a class="" href="?rt='.$_SESSION['tipe'].'&ctl=ctlraport&prog=mainraport"><span class="sub-menu-text">Cetak Raport Semester</span></a></li>
							</span></a></li>
						</ul>
					</li>
				</ul>
				<!-- /SIDEBAR MENU -->
			</div>
		';
    }

    return $content;
}

function aktif($a, $b) {
    if ($a == $b) {
        return "active";
    } else {
        return "";
    }
}

function subaktif($a, $b) {
    if ($a == $b) {
        return "current";
    } else {
        return "";
    }
}

?>