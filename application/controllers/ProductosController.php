<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductosController extends CI_Controller {
	
	public function index()
	{
		$this->load->view('productos');
	}

	public function add()
	{
		$this->load->model('ProductoModel');
		$producto = $this->ProductoModel;
		$producto->codigo 			= $_POST['codigo'];
		$producto->concepto 		= $_POST['concepto'];
		$producto->precio 			= $_POST['precio'];
		$producto->costo 			= $_POST['costo'];
		$producto->cantidad 		= $_POST['cantidad'];
		$producto->unidad 			= $_POST['unidad'];
		$producto->categoria_id 	= $_POST['categoria_id'];
		if(isset($_FILES['imagen'])) {
            $result = $this->saveImage($producto->codigo , $_FILES);

			if(isset($result['imagename']) && $result['code'] == true)
				$producto->imagen_url = $result['imagename'];
		}
		$producto->descripcion 		= $_POST['descripcion'];
		$producto->insert();
		echo json_encode($producto);
	}

	public function edit()
	{
		$this->load->model('ProductoModel');
		$producto_id = $_POST['id'];
		$producto = $this->ProductoModel->getById($producto_id);
		$producto->codigo 			= $_POST['codigo'];
		$producto->concepto 		= $_POST['concepto'];
		$producto->precio 			= $_POST['precio'];
		$producto->costo 			= $_POST['costo'];
		$producto->cantidad 		= $_POST['cantidad'];
		$producto->unidad 			= $_POST['unidad'];
		$producto->categoria_id 	= $_POST['categoria_id'];
		if(isset($_FILES['imagen'])) {
            $result = $this->saveImage($producto->codigo, $_FILES);

			if(isset($result['imagename']) && $result['code'] == true)
				$producto->imagen_url = $result['imagename'];
		}
		$producto->descripcion 		= $_POST['descripcion'];
		$producto->update();
		echo json_encode($producto);
	}

	public function delete()
	{
		$this->load->model('ProductoModel');
		$producto_id = $_POST['id'];
		$producto = $this->ProductoModel->getById($producto_id);
		$producto->delete();
		echo json_encode($producto);
	}

	public function all()
	{
		$this->load->model('ProductoModel');
		$productos = $this->ProductoModel->getAll();
		echo json_encode($productos);
	}

	private function saveImage($namefile, $files, $result = array('code' => 1, 'message' => '')) {
        $target_dir = __DIR__ . "/../../images/";
        $namefile = $namefile . '.' . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . basename($namefile);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $uploadOk = true;

        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check === false) {
            $result['message'] .= "El archivo no es una imagen.\n";
            $result['code'] = 0;
        }

        if (file_exists($target_file)) {
            $result['message'] .= "La imagen ya existe.\n";
            $result['code'] = 1;
        }

        if ($_FILES["imagen"]["size"] > 1048576/*1 megabyte*/) {
            $result['message'] .= "La imagen es demaciado grande.\n";
            $result['code'] = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && 
           $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $result['message'] .= "Solo archivos del tipo JPG, JPEG, PNG & GIF.\n";
            $result['code'] = 0;
        }

        if ($result['code'] == 0) {
            $result['message'] .= "La imagen no se pudo guardar.\n";
            $result['code'] = 1;
        } else {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $result['message'] .= "La imagen ". basename($namefile) . " se ha guardado con exito.";
                $result['imagename'] = basename($namefile);
                $result['code'] = 1;
            } else {
                $result['message'] .= "Ocurrio un error al guardar la imagen.";
                $result['code'] = -1;            
            }
        }

        return $result;
    }
}
