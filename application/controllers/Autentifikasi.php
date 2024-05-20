<?php
class Autentifikasi extends CI_Controller
{
    public function index()
    {
       //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('role_id')==2) {redirect('user');} 
            elseif ($this->session->userdata('role_id')==1) {redirect('admin');}

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', ['required' => 'Email Harus diisi!!','valid_email' => 'Email Tidak Benar!!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password Harus diisi']);

        if ($this->form_validation->run() == false) { $data['judul'] = 'Login'; $data['user'] = '';
            //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/login');
            $this->load->view('templates/aute_footer');} 

            else {$this->_login();
    }
}

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->Modeluser->cekData(['email' => $email])->row_array();
        //jika usernya ada
        if ($user) {
            //jika user sudah aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = ['email' => $user['email'],'role_id' => $user['role_id']];
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {redirect('admin');} 
                      else {
                        if ($user['image'] == 'default.jpg') {$this->session->set_flashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');}
                        redirect('user');}
    }                 else {$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                        redirect('autentifikasi');}
    }                 else {$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                        redirect('autentifikasi');}
    }                 else {$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
                        redirect('autentifikasi');}
    }

    public function blok()
        {$this->load->view('autentifikasi/blok');}
    
    public function gagal()
        {$this->load->view('autentifikasi/gagal');}

    public function registrasi()
        { if ($this->session->userdata('email')) {redirect('user');}
        //membuat rule untuk inputan nama agar tidak boleh kosong dengan membuat pesan error dengan 
        //bahasa sendiri yaitu 'Nama Belum diisi'
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', ['required' => 'Nama Belum diisi!!']);
        //membuat rule untuk inputan email agar tidak boleh kosong, tidak ada spasi, format email harus valid
        //dan email belum pernah dipakai sama user lain dengan membuat pesan error dengan bahasa sendiri 
        //yaitu jika format email tidak benar maka pesannya 'Email Tidak Benar!!'. jika email belum diisi,
        //maka pesannya adalah 'Email Belum diisi', dan jika email yang diinput sudah dipakai user lain,
        //maka pesannya 'Email Sudah dipakai'
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', ['valid_email' => 'Email Tidak Benar!!','required' => 'Email Belum diisi!!','is_unique' => 'Email Sudah Terdaftar!']);
        //membuat rule untuk inputan password agar tidak boleh kosong, tidak ada spasi, tidak boleh kurang dari
        //dari 3 digit, dan password harus sama dengan repeat password dengan membuat pesan error dengan 
        //bahasa sendiri yaitu jika password dan repeat password tidak diinput sama, maka pesannya
        //'Password Tidak Sama'. jika password diisi kurang dari 3 digit, maka pesannya adalah 
        //'Password Terlalu Pendek'.

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password Tidak Sama!!','min_length' => 'Password Terlalu Pendek']);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');
        //jika jida disubmit kemudian validasi form diatas tidak berjalan, maka akan tetap berada di
        //tampilan registrasi. tapi jika disubmit kemudian validasi form diatas berjalan, maka data yang 
        //diinput akan disimpan ke dalam tabel user
          if ($this->form_validation->run() == false) {
        $data['judul'] = 'Registrasi Member';
        $this->load->view('templates/aute_header', $data);
        $this->load->view('autentifikasi/registrasi');
        $this->load->view('templates/aute_footer');
    }       else {
        // Jika validasi berhasil, simpan data pengguna ke dalam tabel user
        $data = ['nama' => htmlspecialchars($this->input->post('nama', true)),'email' => htmlspecialchars($this->input->post('email', true)),'image' => 'default.jpg','password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),'role_id' => 2,'is_active' => 0,'tanggal_input' => time()];
        $this->Modeluser->simpanData($data); // menggunakan model
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
        redirect('autentifikasi');
    }
}
function logout() {
    session_destroy();
    redirect('autentifikasi');
}
public function fetchData()
    {
        $url = "https://api.npoint.io/99c279bb173a6e28359c/data";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            
            $data['surahs'] = json_decode($response, true);
            $this->load->view('surah_view', $data);
            // $data = json_decode($response, true);
            // $this->output
            //      ->set_content_type('application/json')
            //      ->set_output(json_encode($data));
        } else {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Unable to fetch data']));
        }
    }


}
?>