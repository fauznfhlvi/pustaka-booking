<?php 
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 

class Pinjam extends CI_Controller 
{ 
    public function __construct() 
    { 
        parent::__construct(); 
        cek_login(); 
        cek_user(); 
    } 

    public function index() 
    {   
        $data['judul'] = "Data Pinjam"; 
        $data['user'] = $this->Modeluser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['pinjam'] = $this->Modelpinjam->joinData(); 
 
        $this->load->view('templates/header', $data); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('pinjam/data-pinjam', $data); 
        $this->load->view('templates/footer'); 
    } 

    public function daftarBooking() 
    { 
        $data['judul'] = "Daftar Booking"; 
        $data['user'] = $this->Modeluser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['pinjam'] = $this->db->query("SELECT * FROM booking")->result_array(); 

        $this->load->view('templates/header', $data); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('booking/daftar-booking', $data); 
        $this->load->view('templates/footer'); 
    } 
public function bookingDetail() 
{ 
    $id_booking = $this->uri->segment(3); 
    $data['judul'] = "Booking Detail"; 
    $data['user'] = $this->Modeluser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
    $data['agt_booking'] = $this->db->query("SELECT * FROM booking b, user u WHERE b.id_user=u.id AND b.id_booking='$id_booking'")->result_array(); 
    $data['detail'] = $this->db->query("SELECT id_buku, judul_buku, pengarang, penerbit, tahun_terbit FROM booking_detail d, buku b WHERE d.id_buku=b.id AND d.id_booking='$id_booking'")->result_array(); 

    $this->load->view('templates/header', $data); 
    $this->load->view('templates/sidebar', $data); 
    $this->load->view('templates/topbar', $data); 
    $this->load->view('booking/booking-detail', $data); 
    $this->load->view('templates/footer'); 
} 

public function pinjamAct() 
{ 
    $id_booking = $this->uri->segment(3); 
    $lama = $this->input->post('lama', TRUE); 

    $bo = $this->db->query("SELECT * FROM booking WHERE id_booking='$id_booking'")->row(); 

    $tglsekarang = date('Y-m-d'); 
    $no_pinjam = $this->Modelbooking->kodeOtomatis('pinjam', 'no_pinjam'); 

    $tgl_kembali = date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglsekarang))); 

    $databooking = [ 
        'no_pinjam' => $no_pinjam, 
        'id_booking' => $id_booking, 
        'tgl_pinjam' => $tglsekarang, 
        'id_user' => $bo->id_user, 
        'tgl_kembali' => $tgl_kembali, 
        'tgl_pengembalian' => '0000-00-00', 
        'status' => 'Pinjam', 
        'total_denda' => 0 
    ]; 

    $this->Modelpinjam->simpanPinjam($databooking); 
    $this->Modelpinjam->simpanDetail($id_booking, $no_pinjam); 

    $denda = $this->input->post('denda', TRUE); 
    $this->db->query("UPDATE detail_pinjam SET denda='$denda' WHERE no_pinjam='$no_pinjam'"); 

    // Hapus Data booking yang bukunya diambil untuk dipinjam 
    $this->Modelpinjam->deleteData('booking', ['id_booking' => $id_booking]); 
    $this->Modelpinjam->deleteData('booking_detail', ['id_booking' => $id_booking]); 

    // Update dibooking dan dipinjam pada tabel buku saat buku yang dibooking diambil untuk dipinjam 
    $this->db->query("UPDATE buku, detail_pinjam SET buku.dipinjam=buku.dipinjam+1, buku.dibooking=buku.dibooking-1 WHERE buku.id=detail_pinjam.id_buku AND detail_pinjam.no_pinjam='$no_pinjam'"); 

    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Peminjaman Berhasil Disimpan</div>'); 
    redirect(base_url() . 'pinjam'); 
} 
 public function ubahStatus() 
{ 
    $id_buku = $this->uri->segment(3); 
    $no_pinjam = $this->uri->segment(4); 
    $where = ['id_buku' => $this->uri->segment(3)]; 

    $tgl = date('Y-m-d'); 
    $status = 'Kembali'; 

    // Update status menjadi kembali pada saat buku dikembalikan 
    $this->db->query("UPDATE pinjam, detail_pinjam SET pinjam.status='$status', pinjam.tgl_pengembalian='$tgl' WHERE detail_pinjam.id_buku='$id_buku' AND pinjam.no_pinjam='$no_pinjam'"); 

    // Update stok dan dipinjam pada tabel buku 
    $this->db->query("UPDATE buku, detail_pinjam SET buku.dipinjam=buku.dipinjam-1, buku.stok=buku.stok+1 WHERE buku.id=detail_pinjam.id_buku AND detail_pinjam.id_buku='$id_buku'"); 

    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status Peminjaman Berhasil Diubah</div>'); 
    redirect(base_url('pinjam')); 
} 
}