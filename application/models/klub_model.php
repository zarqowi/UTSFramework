<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klub_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKlub()
		{
			$this->db->select("id,nama,logo");
			$query = $this->db->get('klub');
			return $query->result();
		}

		public function getPemainByKlub($idKlub)
		{
			$this->db->select("klub.nama as namaklub,pemain.id,pemain.nama,pemain.posisi,DATE_FORMAT(pemain.tanggal_lahir,'%d-%m-%Y') as tanggallahir");
			$this->db->where('fk_klub', $idKlub);	
			$this->db->join('klub', 'klub.id = pemain.fk_klub', 'left');	
			$query = $this->db->get('pemain');
			return $query->result();
		}

		public function insertKlub()
		{
			$object = array(
				'nama' => $this->input->post('nama'), 
				'logo' => $this->upload->data('file_name') 
				);
			$this->db->insert('klub', $object);
		}

		public function getKlub($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('klub',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$this->db->where('id', $id);
			$this->db->update('klub', $data);
		}

		public function deleteById($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('klub');
		}

}

/* End of file Klub_Model.php */
/* Location: ./application/models/Klub_Model.php */
 ?>