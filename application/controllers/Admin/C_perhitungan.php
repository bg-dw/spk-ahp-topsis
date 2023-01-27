<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_perhitungan extends CI_Controller
{
    function __construct()
    {
        //akan berjalan ketika controller Beranda di jalankan
        parent::__construct();

        $this->load->model('M_perhitungan');
        $this->load->model('M_kriteria');
        $this->load->model('M_lokasi');
        if ($this->session->userdata('login') == FALSE) {
            redirect(base_url('c_login/')); //mengarahkan ke halaman login
        }
    }

    public function index()
    {
        $data['content'] = 'admin/perhitungan/V_perhitungan';
        $data['lokasi'] = $this->M_lokasi->db_get('tbl_lokasi')->result();
        $kt = $this->M_kriteria->db_get('tbl_kriteria')->result();
        foreach ($kt as $val) { //membuat array baru
            $kriteria['id'][] = $val->id_kriteria;
            $kriteria['nama'][] = $val->nama_kriteria;
        }
        $data['kriteria'] = $kriteria;
        $this->load->view('admin/Main', $data);
    }

    public function hasil_perhitungan()
    {
        $nilai = $this->input->post('nilai');
        $id_lokasi = $this->input->post('lokasi');
        if (count($id_lokasi) >= 2) {
            if ($nilai) { //jika nilai kosong
                // $where = array('id_kriteria' => $id);
                $kriteria = $this->M_perhitungan->db_get('tbl_kriteria')->result();
                $detail = $this->M_perhitungan->get_detail($id_lokasi)->result();
                $detail_group = $this->M_perhitungan->get_detail_group($id_lokasi)->result();
                // var_dump($nilai);

                foreach ($detail_group as $key) { //lokasi terpilih
                    $id_alt[] = $key->id_lokasi;
                    $nama_alt[] = $key->nama_lokasi;
                    $alamat_alt[] = $key->alamat_lokasi;
                }
                foreach ($kriteria as $key) { //kriteria_terpilih
                    $id[] = $key->id_kriteria;
                    $nm_kt[] = $key->nama_kriteria;
                    $tipe_kt[] = $key->tipe_kriteria;
                }

                //A.Penentuan bobot
                // var_dump($nilai);
                //membuat matrix hijau
                $x = 0;
                for ($i = 0; $i < count($id); $i++) {
                    for ($j = $i; $j < count($id); $j++) {
                        if ($id[$i] != $id[$j]) {
                            $temp[$i][$j] = $nilai[$x];
                            $x++;
                        }
                    }
                }
                // var_dump($temp);

                //menambahkan matrix kuning kedalam matrix hijau, dan menyiapkan tempat matrix biru
                for ($i = 0; $i < count($id); $i++) {
                    for ($j = 0; $j < count($id); $j++) {
                        if ($id[$i] == $id[$j]) {
                            $matrix_n[$i][$j] = 1;
                        } else {
                            if (array_key_exists($i, $temp) && array_key_exists($j, $temp[$i])) {
                                if ($temp[$i][$j] == 0) {
                                    $matrix_n[$i][$j] = 1;
                                } else {
                                    $matrix_n[$i][$j] = $temp[$i][$j];
                                }
                            } else {
                                $matrix_n[$i][$j] = "x";
                            }
                        }
                    }
                }
                // var_dump($matrix_n);
                // echo "<br>";
                // echo "<br>";
                // for ($i = 0; $i < count($id); $i++) {
                //     for ($j = $i; $j < count($id); $j++) {
                //         if ($id[$i] != $id[$j]) {
                //             echo $temp[$i][$j] . "|";;
                //             $x++;
                //         }
                //     }
                //     echo "<br>";
                // }
                // echo "<br>";
                // echo "<br>";
                // for ($i = 0; $i < count($id); $i++) {
                //     for ($j = 0; $j < count($id); $j++) {
                //         echo $matrix_n[$i][$j] . "|";
                //     }
                //     echo "<br>";
                // }

                //perbandingan kriteria (matrx biru)
                for ($i = 0; $i < count($id); $i++) {
                    for ($j = 0; $j < count($id); $j++) {
                        if ($matrix_n[$i][$j] != "x") {
                            $mat[$i][$j] = $matrix_n[$i][$j];
                        } else {
                            $mat[$i][$j] = 1 / $matrix_n[$j][$i];
                        }
                    }
                }
                // var_dump($mat);
                // echo "<br>";
                // echo "<br>";

                // for ($i = 0; $i < count($id); $i++) {
                //     for ($j = 0; $j < count($id); $j++) {
                //         echo $mat[$i][$j] . "|";
                //     }
                //     echo "<br>";
                // }
                // echo "<br>";
                // echo "<br>";

                //menjumlahkan nilai per kolom
                for ($i = 0; $i < count($id); $i++) {
                    if (round(array_sum(array_column($mat, $i)), 2) == 0) { //jika pembagi =0
                        $pembagi[] = 1;
                    } else {
                        $pembagi[] = round(array_sum(array_column($mat, $i)), 2);
                    }
                }
                // var_dump($pembagi);

                //Normalisasi

                for ($i = 0; $i < count($id); $i++) {
                    for ($j = 0; $j < count($id); $j++) {
                        $normalisasi[$i][$j] = $mat[$i][$j] / $pembagi[$j];
                        // echo $mat[$i][$j] / $pembagi[$j] . "|";
                        // echo "<br>";
                    }
                    // echo "<br>";
                }
                // var_dump($normalisasi);

                //jumlahkan nilai per baris
                for ($i = 0; $i < count($id); $i++) {
                    $jumlah[] = array_sum($normalisasi[$i]);
                }
                // var_dump($jumlah);
                // echo "<br>";
                $total_jumlah = round(array_sum($jumlah), 2);
                // echo $total_jumlah;
                // echo "<br>";

                //mencari priority vector
                for ($i = 0; $i < count($id); $i++) {
                    $bbt[] = round(($jumlah[$i] / $total_jumlah), 2);
                }
                // var_dump($bbt);

                $data = array();
                for ($i = 0; $i < count($id); $i++) {
                    array_push($data, array(
                        'id_kriteria' => $id[$i],
                        'bobot_kriteria' => $bbt[$i]
                    ));
                }
                $this->M_perhitungan->db_update_batch($data, 'tbl_kriteria', 'id_kriteria'); //update bobot kriteria sekaligus

                //B.Perhitungan
                // var_dump($detail);

                foreach ($detail as $val) { //menampung nilai kedalam array 1 dimensi
                    $val_x[] = floatval($val->nilai);
                }
                // var_dump($val_x);

                //Nilai Pangkat
                $i = 0;
                $x = 0;
                foreach ($detail_group as $val) { //sebanyak alternatif
                    for ($j = 0; $j < count($id); $j++) { //sebanyak kriteria
                        $nilai_alt[$i][$j] = $val_x[$x];
                        $np[$i][$j] = pow($val_x[$x], 2); //menampung nilai kedalam array 2 dimensi(berdasarkan lokasi)
                        $x++;
                    }
                    $i++;
                }
                // var_dump($np);

                //Pembagi
                for ($i = 0; $i < count($id); $i++) {
                    $pembagi_ts[] = sqrt(array_sum(array_column($np, $i))); //penjumlahan array 2 dimensi berdasarkan kolom,sqrt= akar kuadrat
                }
                // var_dump($pembagi_ts);

                //Matrix keputusan ternoramalisasi
                for ($i = 0; $i < count($id_alt); $i++) {
                    for ($j = 0; $j < count($id); $j++) {
                        $m_normalisasi[$i][$j] = (($nilai_alt[$i][$j]) / ($pembagi[$j]));
                    }
                }
                // var_dump($m_normalisasi);

                //Matrix keputusan ternoramalisasi terbobot
                for ($i = 0; $i < count($id_alt); $i++) {
                    for ($j = 0; $j < count($id); $j++) {
                        $m_terbobot[$i][$j] = (($nilai_alt[$i][$j]) * ($bbt[$j]));
                    }
                }
                // var_dump($m_normalisasi);

                //Mencari A+
                for ($i = 0; $i < count($id); $i++) { //perulangan sebanyak kriteria
                    if ($tipe_kt[$i] == "COST") {
                        $a_plus[$i] = min(array_column($m_terbobot, $i)); //penjumlahan array 2 dimensi berdasarkan kolom
                    } else {
                        $a_plus[$i] = max(array_column($m_terbobot, $i)); //penjumlahan array 2 dimensi berdasarkan kolom
                    }
                }
                // echo "<br>";
                // var_dump($a_plus);

                //Mencari A-
                for ($i = 0; $i < count($id); $i++) { //perulangan sebanyak kriteria
                    if ($tipe_kt[$i] == "COST") {
                        $a_min[$i] = max(array_column($m_terbobot, $i)); //penjumlahan array 2 dimensi berdasarkan kolom
                    } else {
                        $a_min[$i] = min(array_column($m_terbobot, $i)); //penjumlahan array 2 dimensi berdasarkan kolom
                    }
                }
                // echo "<br>";
                // var_dump($a_min);

                //Mencari D+
                for ($i = 0; $i < count($id_alt); $i++) { //sebanyak alternatif
                    $tampung = 0;
                    for ($j = 0; $j < count($id); $j++) {
                        $tampung += pow(($a_plus[$j] - $m_terbobot[$i][$j]), 2); //menambahkan setiap hasil pangkat pada setiap baris
                    }
                    $d_plus[$i] = sqrt($tampung);
                }
                // var_dump($d_plus);

                //Mencari D-
                for ($i = 0; $i < count($id_alt); $i++) {
                    $tampung = 0;
                    for ($j = 0; $j < count($id); $j++) {
                        $tampung += pow(($m_terbobot[$i][$j] - $a_min[$j]), 2); //menambahkan setiap hasil pangkat pada setiap baris
                    }
                    $d_min[$i] = sqrt($tampung);
                }
                // var_dump($d_min);

                //Nilai akhir
                for ($x = 0; $x < count($id_alt); $x++) {
                    if (($d_min[$x]) + ($d_plus[$x]) == 0) {
                        $hasil[$x] = ($d_min[$x]) / 1; //jika pembagi sama dengan 0
                    } else {
                        $hasil[$x] = ($d_min[$x]) / (($d_min[$x]) + ($d_plus[$x]));
                    }
                }
                // echo "<br>";
                // var_dump($hasil);

                //rangking
                for ($i = 0; $i < count($id_alt); $i++) { //sebanyak baris
                    $rank[$i]['id'] = $id_alt[$i];
                    $rank[$i]['lokasi'] = $nama_alt[$i];
                    $rank[$i]['alamat'] = $alamat_alt[$i];
                    $rank[$i]['nilai'] = $hasil[$i];
                }
                array_multisort(array_column($rank, "nilai"), SORT_DESC, $rank); //sort dari nilai terbesar ke terkecil

                for ($i = 0; $i < count($id_alt); $i++) { //sebanyak baris
                    $terpilih[$i]['id'] = $rank[$i]['id'];
                    $terpilih[$i]['lokasi'] = $rank[$i]['lokasi'];
                    $terpilih[$i]['alamat'] = $rank[$i]['alamat'];
                    $terpilih[$i]['nilai'] = $rank[$i]['nilai'];
                    $terpilih[$i]['rank'] = $i + 1;
                }
                array_multisort(array_column($terpilih, "rank"), SORT_ASC, $terpilih); //sort dari id_lokasi terkecil ke terbesar

                $data['content'] = 'admin/perhitungan/V_hasil_perhitungan';
                $data['id_alt'] = $id_alt;
                $data['alt'] = $nama_alt;
                $data['nilai'] = $nilai_alt;
                $data['kt'] = $nm_kt;
                $data['tipe_kt'] = $tipe_kt;
                $data['pembagi'] = $pembagi_ts;
                $data['normalisasi'] = $m_normalisasi;
                $data['terbobot'] = $m_terbobot;
                $data['a_plus'] = $a_plus;
                $data['a_min'] = $a_min;
                $data['d_plus'] = $d_plus;
                $data['d_min'] = $d_min;
                $data['hasil'] = $hasil;
                $data['terpilih'] = $terpilih;
                $this->load->view('admin/Main', $data);
            } else {
                $this->session->set_flashdata('alert', 'Nilai Kosong!'); //flash data
                redirect(base_url('admin/c_perhitungan/'));
            }
        } else {
            $this->session->set_flashdata('alert', 'Harap Pilih Minimal 2 Lokasi!'); //flash data
            redirect(base_url('admin/c_perhitungan/'));
        }
    }

    public function lokasi($id)
    {
        $data['content'] = 'admin/perhitungan/V_lokasi';
        $where = array(
            'id_lokasi' => $id
        );
        $data['lokasi'] = $this->M_lokasi->db_get_where($where, 'tbl_lokasi')->row();
        $this->load->view('admin/Main', $data);
    }
}
