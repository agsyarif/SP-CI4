<?php

namespace App\Controllers;

use App\Models\Mdata;

class Basis extends BaseController
{
    public function index()
    {
        $x['hal'] = "beranda";
        $dtx = new Mdata();
        $x["jmlbuku"] = $dtx->getTotalBuku();
        $x["maxtahun"] = $dtx->getMaxTahun();
        $x["maxpenerbit"] = $dtx->getMaxPenerbit();
        $x["maxrak"] = $dtx->getMaxRak();
        return view("home", $x);
    }

    public function data()
    {
        $dtx = new Mdata();
        $x['hal'] = "buku";
        $x["dtpengarang"] = $dtx->getPengarang();
        $x["dtpenerbit"] = $dtx->getPenerbit();
        return view("home", $x);
    }

    private function os()
    {
        $ux = $_SERVER["HTTP_USER_AGENT"];
        if (preg_match("/linux/i", $ux)) {
            $platform = "Linux";
        } elseif (preg_match("/macintosh|mac os x/i", $ux)) {
            $platform = "macOS";
        } elseif (preg_match("/windows|win32/i", $ux)) {
            $platform = "Windows";
        } else {
            $platform = "Tidak Diketahui";
        }
        return $platform;
    }

    private function mac()
    {
        ob_start();
        system('ipconfig /all');
        $mycom = ob_get_contents();
        ob_clean();
        $findme = "Physical";
        $pmac = strpos($mycom, $findme);
        $mac = substr($mycom, ($pmac + 36), 17);
        return $mac;
    }

    private function serial()
    {
        $seri = shell_exec('wmic diskdrive get serialnumber');
        return $seri;
    }

    public function tentang()
    {
        $x["hal"] = "tentang";
        $x["os"] = $this->os();
        $x["mac"] = $this->mac();
        $getserial = $x["os"] == "Windows" ? $this->serial() : "Tidak Terdeteksi";
        $x["serial"] = str_replace("SerialNumber ", "", $getserial);
        return view("home", $x);
    }

    public function getData()
    {
        $dtx = new Mdata();
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $dtx->getBuku();
        foreach ($dt as $k) {
            $kode = $k->Kode_Buku;
            $judul = $k->Judul;
            $pengarang = $k->Pengarang;
            $penerbit = $k->Penerbit;
            $tahun = $k->Tahun_Terbit;
            $isbn = $k->ISBN;
            $tombolkelola = sprintf("<button type='button' class='btn btn-primary' data-kode='%s' onclick='filter(this)'>Kelola</button>", $kode);
            $dtisi .= sprintf('["%s","%s","%s","%s","%s","%s","%s"],', $kode, $judul, $pengarang, $penerbit, $tahun, $isbn, $tombolkelola);
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

    public function TambahData()
    {
        $dtx = new Mdata();
        $kode = $this->request->getVar("kodex");
        $judul = $this->request->getVar("judulx");
        $isbn = $this->request->getVar("isbnx");
        $pengarang = $this->request->getVar("pengarangx");
        $penerbit = $this->request->getVar("penerbitx");
        $tahun = $this->request->getVar("tahunx");
        $rak = $this->request->getVar("rakx");
        $proses = $dtx->TambahData($kode, $judul, $isbn, $pengarang, $penerbit, $tahun, $rak);
        if ($proses == "1") {
            echo '{"kode":"1","pesan":"Data Berhasil di Tambahkan"}';
        } else {
            echo '{"kode":"0","pesan":"Data Gagal di Tambahkan, Periksa Kembali Isian Anda"}';
        }
    }

    public function AmbilData()
    {
        $dtx = new Mdata();
        $kode = $this->request->getVar("kodex");
        $hasil = $dtx->AmbilData($kode);

        if (is_array($hasil)) {
            if (count($hasil) > 0) {
                foreach ($hasil as $h) {
                    $judul = $h->Judul;
                    $idpengarang = $h->ID_Pengarang;
                    $idpenerbit = $h->ID_Penerbit;
                    $isbn = $h->ISBN;
                    $tahun = $h->Tahun_Terbit;
                    $rak = $h->Rak;
                }
                echo sprintf(
                    '{"kode":"1","judul":"%s","pengarang":"%s","penerbit":"%s","isbn":"%s","tahun":"%s","rak":"%s"}',
                    $judul,
                    $idpengarang,
                    $idpenerbit,
                    $isbn,
                    $tahun,
                    $rak
                );
            } else {
                echo '{"kode":"0","pesan":"Data Tidak DItemukan"}';
            }
        } else {
            echo '{"kode":"0","pesan":"Data Tidak DItemukan"}';
        }
    }

    public function UpdateData()
    {
        $dtx = new Mdata();
        $kode = $this->request->getVar("kodex");
        $judul = $this->request->getVar("judulx");
        $isbn = $this->request->getVar("isbnx");
        $pengarang = $this->request->getVar("pengarangx");
        $penerbit = $this->request->getVar("penerbitx");
        $tahun = $this->request->getVar("tahunx");
        $rak = $this->request->getVar("rakx");
        $proses = $dtx->UpdateData($kode, $judul, $isbn, $pengarang, $penerbit, $tahun, $rak);
        if ($proses == "1") {
            echo '{"kode":"1","pesan":"Data Berhasil di Update"}';
        } else {
            echo '{"kode":"0","pesan":"Data Gagal di Update, Periksa Kembali Isian Anda"}';
        }
    }

    public function HapusData()
    {
        $dtx = new Mdata();
        $kode = $this->request->getVar("kodex");
        $proses = $dtx->HapusData($kode);
        if ($proses == "1") {
            echo '{"kode":"1","pesan":"Data Berhasil di Hapus"}';
        } else {
            echo '{"kode":"0","pesan":"Data Gagal di Hapus, Periksa Kembali Isian Anda"}';
        }
    }

    public function RekapDashboard()
    {
        $dtx = new Mdata();
        $jenis = $this->request->uri->getSegment(2);
        $nilai = urldecode($this->request->uri->getSegment(3));

        if ($jenis == "bytahun") {
            $sql = sprintf("SELECT Judul FROM buku WHERE Tahun_Terbit = '%s'", $nilai);
        } elseif ($jenis == "bypenerbit") {
            $sql = sprintf("SELECT Judul FROM buku_view WHERE Penerbit = '%s'", $nilai);
        } else {
            $sql = "SELECT Judul FROM buku WHERE Rak LIKE'" . $nilai . "%'";
        }
        $hasil = $dtx->RekapDashboard($sql);
        echo json_encode($hasil);
    }
}
