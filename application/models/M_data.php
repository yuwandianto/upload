<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	function guru()
	{
		return $this->db->get('guru');
	}

	function mapel()
	{
		return $this->db->get('mapel');
	}

	function kelas()
	{
		return $this->db->get('kelas');
	}

	function siswa($table,$kodeKelas)
	{
		return $this->db->get_where('siswa', ['kodeKelas' =>$kodeKelas]);
	}

	function simpan($nama,$kelas,$guru,$mapel)
	{
		$filename = $_FILES['file']['name'];
		$extensi = substr(strrchr($filename, '.'), 1);

		$config['upload_path'] = './files/';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']  = '10000';
		//$config['file_name'] = $nama.'_'.$kelas.'_'.$guru.'_'.$mapel.'.'.$extensi;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('file')){
			return $this->upload->display_errors();
		}
		else {
			$namaFile = $this->upload->data('file_name');
			$dataInsert = [
				'namaFile' => $namaFile,
				'emailGuru' => $guru,
				'idSiswa' => $nama,
				'mapel' => $mapel,
			];

			$this->db->insert('files', $dataInsert);
			
			return 'sukses';
		}
	}



}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */