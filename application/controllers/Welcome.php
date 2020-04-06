<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['guru'] = $this->m_data->guru()->result();
		$data['mapel'] = $this->m_data->mapel()->result();
		$data['kelas'] = $this->m_data->kelas()->result();

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('guru', 'Guru', 'trim|required');
		$this->form_validation->set_rules('mapel', 'Mapel', 'trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');


		if ($this->form_validation->run() == FALSE) {

			$this->load->view('welcome_message', $data);
			
		} else {
			$this->input();
		}

	}

	private function input()
	{
		$nama = $this->input->post('nama');
		$guru = $this->input->post('guru');
		$mapel = $this->input->post('mapel');
		$kelas = $this->input->post('kelas');

		$simpan = $this->m_data->simpan($nama,$kelas,$guru,$mapel);

		if ($simpan == 'sukses') {
			$this->session->set_flashdata('success', 'Upload data berhasil');
			redirect('','refresh');
		} else {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('','refresh');
		}
		
	}

	function get_siswa()
	{
		$kodeKelas = $this->input->post('kodeKelas');
		$siswa = $this->m_data->siswa('siswa',$kodeKelas)->result();

		$tampil = '<option value="">-- Pilih Siswa -- </option>';
		foreach ($siswa as $sis) {
		//$tampil .= '<option value"">'.$sis->namaSiswa.'</option>';
		$tampil .= '<option value="'.$sis->identitas.'">'.$sis->namaSiswa.'</option>';	
		}
	
		echo json_encode($tampil);


	}
}
