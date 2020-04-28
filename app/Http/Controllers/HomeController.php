<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Guru;
use App\Kehadiran;
use App\Kelas;
use App\Siswa;
use App\Mapel;
use App\User;
use App\Paket;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hari = date('w');
        $jam = date('H:i');
        $jadwal = Jadwal::OrderBy('jam_mulai')->OrderBy('jam_selesai')->OrderBy('kelas_id')->where('hari_id', $hari)->where('jam_mulai', '<=', $jam)->where('jam_selesai', '>=', $jam)->get();
        $pengumuman = Pengumuman::limit(1)->get();
        $kehadiran = Kehadiran::all();
        return view('home', compact('jadwal', 'pengumuman', 'kehadiran'));
    }

    public function admin()
    {
        $jadwal = Jadwal::all();
        $guru = Guru::all();
        $gurulk = Guru::where('jk', 'L')->get();
        $gurupr = Guru::where('jk', 'P')->get();
        $siswa = Siswa::all();
        $siswalk = Siswa::where('jk', 'L')->get();
        $siswapr = Siswa::where('jk', 'P')->get();
        $kelas = Kelas::all();
        $bkp = Kelas::where('paket_id', '1')->get();
        $dpib = Kelas::where('paket_id', '2')->get();
        $ei = Kelas::where('paket_id', '3')->get();
        $oi = Kelas::where('paket_id', '4')->get();
        $tbsm = Kelas::where('paket_id', '6')->get();
        $rpl = Kelas::where('paket_id', '7')->get();
        $tpm = Kelas::where('paket_id', '5')->get();
        $las = Kelas::where('paket_id', '8')->get();
        $bkpa1 = Siswa::where('Kelas_id', '1')->get();
        $bkpb1 = Siswa::where('Kelas_id', '2')->get();
        $dpiba1 = Siswa::where('Kelas_id', '3')->get();
        $dpibb1 = Siswa::where('Kelas_id', '4')->get();
        $dpibc1 = Siswa::where('Kelas_id', '5')->get();
        $eia1 = Siswa::where('Kelas_id', '6')->get();
        $eib1 = Siswa::where('Kelas_id', '7')->get();
        $oia1 = Siswa::where('Kelas_id', '8')->get();
        $oib1 = Siswa::where('Kelas_id', '9')->get();
        $tbsma1 = Siswa::where('Kelas_id', '16')->get();
        $tbsmb1 = Siswa::where('Kelas_id', '17')->get();
        $rpla1 = Siswa::where('Kelas_id', '18')->get();
        $rplb1 = Siswa::where('Kelas_id', '19')->get();
        $rplc1 = Siswa::where('Kelas_id', '20')->get();
        $tpma1 = Siswa::where('Kelas_id', '10')->get();
        $tpmb1 = Siswa::where('Kelas_id', '11')->get();
        $tpmc1 = Siswa::where('Kelas_id', '12')->get();
        $tpmd1 = Siswa::where('Kelas_id', '13')->get();
        $lasa1 = Siswa::where('Kelas_id', '14')->get();
        $lasb1 = Siswa::where('Kelas_id', '15')->get();
        $bkpa2 = Siswa::where('Kelas_id', '21')->get();
        $bkpb2 = Siswa::where('Kelas_id', '22')->get();
        $dpiba2 = Siswa::where('Kelas_id', '23')->get();
        $dpibb2 = Siswa::where('Kelas_id', '24')->get();
        $dpibc2 = Siswa::where('Kelas_id', '25')->get();
        $eia2 = Siswa::where('Kelas_id', '26')->get();
        $eib2 = Siswa::where('Kelas_id', '27')->get();
        $oia2 = Siswa::where('Kelas_id', '28')->get();
        $oib2 = Siswa::where('Kelas_id', '29')->get();
        $tbsma2 = Siswa::where('Kelas_id', '36')->get();
        $tbsmb2 = Siswa::where('Kelas_id', '37')->get();
        $rpla2 = Siswa::where('Kelas_id', '38')->get();
        $rplb2 = Siswa::where('Kelas_id', '39')->get();
        $rplc2 = Siswa::where('Kelas_id', '40')->get();
        $tpma2 = Siswa::where('Kelas_id', '30')->get();
        $tpmb2 = Siswa::where('Kelas_id', '31')->get();
        $tpmc2 = Siswa::where('Kelas_id', '32')->get();
        $tpmd2 = Siswa::where('Kelas_id', '33')->get();
        $lasa2 = Siswa::where('Kelas_id', '34')->get();
        $lasb2 = Siswa::where('Kelas_id', '35')->get();
        $bkpa3 = Siswa::where('Kelas_id', '41')->get();
        $bkpb3 = Siswa::where('Kelas_id', '42')->get();
        $dpiba3 = Siswa::where('Kelas_id', '43')->get();
        $dpibb3 = Siswa::where('Kelas_id', '44')->get();
        $dpibc3 = Siswa::where('Kelas_id', '45')->get();
        $eia3 = Siswa::where('Kelas_id', '46')->get();
        $eib3 = Siswa::where('Kelas_id', '47')->get();
        $oia3 = Siswa::where('Kelas_id', '48')->get();
        $oib3 = Siswa::where('Kelas_id', '49')->get();
        $tbsma3 = Siswa::where('Kelas_id', '56')->get();
        $tbsmb3 = Siswa::where('Kelas_id', '57')->get();
        $rpla3 = Siswa::where('Kelas_id', '58')->get();
        $rplb3 = Siswa::where('Kelas_id', '59')->get();
        $rplc3 = Siswa::where('Kelas_id', '60')->get();
        $tpma3 = Siswa::where('Kelas_id', '50')->get();
        $tpmb3 = Siswa::where('Kelas_id', '51')->get();
        $tpmc3 = Siswa::where('Kelas_id', '52')->get();
        $tpmd3 = Siswa::where('Kelas_id', '53')->get();
        $lasa3 = Siswa::where('Kelas_id', '54')->get();
        $lasb3 = Siswa::where('Kelas_id', '55')->get();
        $mapel = Mapel::all();
        $user = User::all();
        $paket = Paket::all();
        return view('admin.index', compact(
            'jadwal',
            'bkpa1',
            'bkpb1',
            'dpiba1',
            'dpibb1',
            'dpibc1',
            'eia1',
            'eib1',
            'oia1',
            'oib1',
            'tbsma1',
            'tbsmb1',
            'rpla1',
            'rplb1',
            'rplc1',
            'tpma1',
            'tpmb1',
            'tpmc1',
            'tpmd1',
            'lasa1',
            'lasb1',
            'bkpa2',
            'bkpb2',
            'dpiba2',
            'dpibb2',
            'dpibc2',
            'eia2',
            'eib2',
            'oia2',
            'oib2',
            'tbsma2',
            'tbsmb2',
            'rpla2',
            'rplb2',
            'rplc2',
            'tpma2',
            'tpmb2',
            'tpmc2',
            'tpmd2',
            'lasa2',
            'lasb2',
            'bkpa3',
            'bkpb3',
            'dpiba3',
            'dpibb3',
            'dpibc3',
            'eia3',
            'eib3',
            'oia3',
            'oib3',
            'tbsma3',
            'tbsmb3',
            'rpla3',
            'rplb3',
            'rplc3',
            'tpma3',
            'tpmb3',
            'tpmc3',
            'tpmd3',
            'lasa3',
            'lasb3',
            'guru',
            'gurulk',
            'gurupr',
            'siswalk',
            'siswapr',
            'siswa',
            'kelas',
            'bkp',
            'dpib',
            'ei',
            'oi',
            'tbsm',
            'rpl',
            'tpm',
            'las',
            'mapel',
            'user',
            'paket'
        ));
    }
}
