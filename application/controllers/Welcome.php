<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['title']		= 'Buku Tamu';

		$data['aplikasi']	= $this->m_model->get_desc('tb_aplikasi');

		$this->load->view('beranda', $data);
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');

        $nama           = $_POST['nama'];
        $jenisKelamin   = $_POST['jenisKelamin'];
        $telp           = $_POST['telp'];
        $alamat         = $_POST['alamat'];
        $keperluan      = $_POST['keperluan'];
        $kepada         = $_POST['kepada'];
        $snapshot       = $_POST['snapshot'];
        $terdaftar      = date('Y-m-d H:i:s');

        $kpr = array("Formulir permohonan bantuan hukum", "Formulir permohonan penggeledahan", "Formulir pemberitahuan perkara", "Formulir surat kuasa", "Formulir permohonan penangguhan eksekusi", "Formulir permohonan peninjauan kembali", "Formulir permohonan penggantian jaksa penuntut umum", "Formulir permohonan rekonsiliasi");

        $data = array(
            'nama'          => $nama,
            'jenisKelamin'  => $jenisKelamin,
            'telp'          => $telp,
            'alamat'        => $alamat,
            'keperluan'     => $kpr[$keperluan],
            'kepada'        => $kepada,
            'terdaftar'     => $terdaftar,
            'snapshot'      => $snapshot,
        );

        $this->m_model->insert($data, 'tb_tamu');
        $this->session->set_flashdata('pesan','Data berhasil ditambahkan!');
        redirect('welcome');
    }
}
