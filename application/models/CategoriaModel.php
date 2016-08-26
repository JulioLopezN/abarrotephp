<?php 

class CategoriaModel extends CI_Model {
    public $id;
    public $descripcion;

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

    public function getById($id){
        $query = $this->db->get_where('categorias', array('id' => $id));
        return $query->row();
    }

    public function getAll(){
        $query = $this->db->get('categorias');
        return $query->result_array();
    }

    public function insert(){
        $this->db->insert('categorias', $this);
    }

    public function update(){
        $this->db->update('categorias', $this, array('id' => $this->id));
    }

    public function delete(){
        $this->db->delete('categorias', array('id' => $this->id)); 
    }
}