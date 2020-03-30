<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use App\Jenis;
use App\Jabatan;

class SuratMasukControllerk extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alljenis = Jenis::getalluser();
        $alljabatan = Jabatan::getalluser();
        // $nama = $this->session->nama;
        // $nip = $this->modeluser->ambiladmin($nama);
        return view('suratmasuk', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan]);
    }

    public function store(Request $request)
    {
        // $this->load->helper(array('form', 'url'));
        // $nama_file = md5(uniqid(rand(), true));
        // $this->load->library('upload');
        // $config = [
        //     'upload_path' => './assets/img/',
        //     'allowed_types' => 'gif|jpg|png|jpeg|bmp',
        //     'file_name' => $nama_file
        // ];
        // $this->upload->initialize($config);

        // if (!$this->upload->do_upload('gambar')) {
        //     $gambar = "";
        // } else {
        //     $gambar = $this->upload->file_name;
        // }

        $urut = $request->input('urut');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $jenis = $request->input('jenis');
        $jabat = $request->input('jabat');
        $tglsurat = $request->input('tglsurat');
        $tglterima = $request->input('tglterima');
        $pengirim = $request->input('pengirim');
        $perihal = $request->input('perihal');
        $keterangan = $request->input('ket');
        $nip = $request->input('nip', '171150074');
        $nosurat = $jenis . '/' . $jabat . '/' . $urut . '/' . $bulan . '/' . $tahun;


        SuratMasuk::create([
            'no_surat' => $nosurat,
            'tgl_surat' => $tglsurat,
            'tgl_terima' => $tglterima,
            'pengirim' => $pengirim,
            'perihal' => $perihal,
            'keterangan' => $keterangan,
            // 'gambar' => $gambar,
            'nip' => $nip,
            'kode_jenissurat' => $jenis,
            'kode_jenjang' => $jabat
        ]);

        return redirect()->back();
    }
}
