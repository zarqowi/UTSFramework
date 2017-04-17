<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemain_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataPemain()
		{
			$this->db->select("id,nama,posisi,tanggal_lahir");
			$query = $this->db->get('pemain');
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

		public function insertPemain()
		{
			$object = array(
				'nama' => $this->input->post('nama'), 
				'posisi' => $this->upload->data('posisi'),
				'tanggal_lahir' => $this->upload->data('tanggal_lahir') 
				);
			$this->db->insert('pemain', $object);
		}

		public function getPemain($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('pemain',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$this->db->where('id', $id);
			$this->db->update('pemain', $data);
		}

		public function deleteById($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('pemain');
		}

}

/* End of file Klub_Model.php */
/* Location: ./application/models/Klub_Model.php */
 ?>