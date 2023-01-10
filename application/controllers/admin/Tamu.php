<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('level')){
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data Tamu Kejaksaan';
        $data['subtitle']   = '';

        $data['tamu'] = $this->m_model->get_desc('tb_tamu');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/tamu');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id );

        $this->m_model->delete($where, 'tb_tamu');
        $this->session->set_flashdata('pesan','Data berhasil dihapus!');
        redirect('admin/tamu');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');

        $nama           = $_POST['nama'];
        $jenisKelamin   = $_POST['jenisKelamin'];
        $instansi       = $_POST['instansi'];
        $telp           = $_POST['telp'];
        $alamat         = $_POST['alamat'];
        $keperluan      = $_POST['keperluan'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = array(
            'nama'          => $nama,
            'jenisKelamin'  => $jenisKelamin,
            'instansi'      => $instansi,
            'telp'          => $telp,
            'alamat'        => $alamat,
            'keperluan'     => $keperluan,
            'terdaftar'     => $terdaftar,
        );

        $this->m_model->insert($data, 'tb_tamu');
        $this->session->set_flashdata('pesan','Data berhasil ditambahkan!');
        redirect('admin/tamu');
    }

    public function update($id)
    {
        $nama           = $_POST['nama'];
        $jenisKelamin   = $_POST['jenisKelamin'];
        $instansi       = $_POST['instansi'];
        $telp           = $_POST['telp'];
        $alamat         = $_POST['alamat'];
        $keperluan      = $_POST['keperluan'];

        $data = array(
            'nama'          => $nama,
            'jenisKelamin'  => $jenisKelamin,
            'instansi'      => $instansi,
            'telp'          => $telp,
            'alamat'        => $alamat,
            'keperluan'     => $keperluan,
        );

        $where = array('id' => $id );

        $this->m_model->update($where, $data, 'tb_tamu');
        $this->session->set_flashdata('pesan','Data berhasil diubah!');
        redirect('admin/tamu');
    }

    public function rekap()
    {
        $data['title']      = 'Rekap Data Tamu';

        $data['tglawal']    = $_POST['tglawal'];
        $data['tglakhir']   = $_POST['tglakhir'];

        $daritgl    = date('Y-m-d H:i:s', strtotime($_POST['tglawal'] . '00:00:00'));
        $sampaitgl  = date('Y-m-d H:i:s', strtotime($_POST['tglakhir'] . '23:59:59'));

        $data['tamu'] = $this->db->query('SELECT * FROM tb_tamu WHERE terdaftar BETWEEN "'.$daritgl.'" AND "'.$sampaitgl.'" ORDER BY id DESC ');
         
        if(isset($_POST['exportExcel'])) {
            $this->load->view('admin/exporttamu', $data);
        } elseif(isset($_POST['print'])) {
            $this->load->view('admin/printtamu', $data);
        }
    }
}