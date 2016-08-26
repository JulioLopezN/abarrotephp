<?php 

class ProductoModel extends CI_Model {
    public $id;
    public $codigo;
    public $concepto;
    public $precio;
    public $costo;
    public $cantidad;
    public $unidad;
    public $categoria_id;
    public $imagen_url;
    public $descripcion;

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

    public function getById($id){
        $query = $this->db->get_where('productos', array('id' => $id));
        $producto = $query->row();
		$this->id 			    = $producto->id;
		$this->codigo 			= $producto->codigo;
		$this->concepto 		= $producto->concepto;
		$this->precio 			= $producto->precio;
		$this->costo 			= $producto->costo;
		$this->cantidad 		= $producto->cantidad;
		$this->unidad 			= $producto->unidad;
		$this->categoria_id 	= $producto->categoria_id;
		$this->imagen_url 		= $producto->imagen_url;
		$this->descripcion 		= $producto->descripcion;
        return $this;
    }

    public function getAll(){
        $query = $this->db->get('productos');
        return $query->result_array();
    }

    public function insert(){
        $this->db->insert('productos', $this);
    }

    public function update(){
        $this->db->update('productos', $this, array('id' => $this->id));
    }

    public function delete(){
        $this->db->delete('productos', array('id' => $this->id)); 
    }

}