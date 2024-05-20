<?php
class Home extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'judul' => "Katalog Buku",
 			'buku' => $this->Modelbuku->getBuku()->result(),
		];
		if ($this->session->userdata('email')) {
			$user = $this->Modeluser->cekData(['email' => $this->session->userdata('email')])->row_array();
			$data['user'] = $user['nama'];
			$this->load->view('templates/templates-user/header', $data);
			$this->load->view('buku/daftarbuku', $data);
			$this->load->view('templates/templates-user/modal', $data);
			$this->load->view('templates/templates-user/footer', $data);

 		} else {
 			$data['user'] = 'Pengunjung';
 			$this->load->view('templates/templates-user/header', $data);
 			$this->load->view('buku/daftarbuku', $data);
			$this->load->view('templates/templates-user/modal', $data);
 			$this->load->view('templates/templates-user/footer', $data);

 		}
 	}
	public function detailbuku()
	{
		$id = $this->uri->segment(3);
		$buku = $this->Modelbuku->joinKategoriBuku(['buku.id' => $id])->result();
		$data['user'] = "Pengunjung";
		$data['title'] = "Detail Buku";
		 
		foreach ($buku as $fields) {
			$data['judul'] = $fields->judul_buku;
			$data['pengarang'] = $fields->pengarang;
			$data['penerbit'] = $fields->penerbit;
			$data['kategori'] = $fields->id_kategori;
			$data['tahun'] = $fields->tahun_terbit;
			$data['isbn'] = $fields->isbn;
			$data['gambar'] = $fields->image;
			$data['dipinjam'] = $fields->dipinjam;
			$data['dibooking'] = $fields->dibooking;
			$data['stok'] = $fields->stok;
			$data['id'] = $fields->id;
		}
		 
		$this->load->view('templates/templates-user/header', $data);
		$this->load->view('buku/detail-buku', $data);
		$this->load->view('templates/templates-user/footer');
	}
	 
}
