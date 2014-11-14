<?php
/**
 * Subir imágenes al sistema y guardar la ruta en la DB
 *
 * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
 * @version 0.1
 * @copyright Zavordigital, 08 March, 2011
 * @package Imagenes
 **/
class Imagenes extends MX_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'user_agent'));
        $this->load->helper(array('url', 'html', 'form', 'avatar', 'cyp', 'apipulzos'));
        $this->load->model('imagen', '', true);
    }

    /**
     * Mostrar imágenes contenidas en un album
     *
     * La unidad lógica es el album. Entonces todos los metodos de este 
     * controlador dependen de la existencia de un album. No puede haber fotos  
     * que no pertenezcan a un album  
     *
     * @param integer $id id del album a revisar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function index($id)
    {
        //obtener todas las imágenes del album
        $imagenes = $this->imagen->get('imagenAlbumId = '.$id);
		$album=$this->imagen->getalbum('albumId = '.$id);
		$anexo=$this->imagen->get_anexo($id);
        $this->load->view('imagenes/index', array('imagenes'=>$imagenes, 'albumId'=>$id,'album'=>$album,'anexo'=>$anexo));
    }

    /**
     * Ver una imagen a detalle
     *
     * En el index solo se muestran thumbs de la fotos que contiene un album. 
     * Al llamar a este metodo ya se consigue la foto en grande y se ve 
     * a detalle toda la información que contiene
     *
     * @param integer $id Id de la foto a mostrar.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function ver($id)
    {
        // Obtener la imágen para mostar toda la info
        $imagen = $this->imagen->get('imagenId = '.$id);
        
        $content = $this->load->view('imagenes/ver', array('imagen'=>$imagen));
    }

    /**
     * Crear una nueva imágen
     *
     * Hacer el registro en la DB y subir la imágen al filesystem
     *
     * @param integer $id Id del album al cual agregar la imágen
     * @param bool $flag Si hacerla avatar inmediatamente o no
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function crear($id, $flag=0)
    {
        // verificar si el furmulario ha sido mandado.
        $post = $this->input->post('Imagenes');
       
        if($_FILES['imagen']['name'] != '')
        {
            //cargar la libreria para crear el thumbnail
            $this->load->library('image_lib');

            $file_path = './statics/img_usuarios/'.$this->session->userdata('id').'/'.$id.'/';
            //create directory
            @mkdir($file_path, 0777, true);

            //se crea el directorio para el thumbnail
            $file_path1 = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/';
            //create directory
            @mkdir($file_path1, 0777, true);

            //prepare file upload
            $upload_settings = array(
                'upload_path'=>$file_path,
                'allowed_types'=>'gif|jpg|jpeg|png',
                'max_size'=>'1000000000000',
                'max_width'=>'1300000000',
                'max_height'=>'1300000000',
                'remove_spaces'=>true,
                'encrypt_name'=>true,
            );

            $this->load->library('upload', $upload_settings);
            if($this->upload->do_upload('imagen'))
            {
                //sacar información sobre el archivo
                $file_info = $this->upload->data();
                $exif = exif_read_data($file_info['full_path'], 0, true);
                $valores2 = '';
                
				foreach ($exif as $key => $section) {
				    foreach ($section as $name => $val) {
				    	$text1 = $key.$name;
				    	if($text1 == 'IFD0Orientation'){
				        	$valores2 = $val;
				        }
				    }
				}
                
                // preparar la información antes de guardar
                $post['imagenFechaCreacion'] = time();
                $post['imagenFechaModificacion'] = time();
                $post['imagenAlbumId'] = $id;
                $post['imagenRuta'] = 'statics/img_usuarios/'.$this->session->userdata('id').'/'.$id.'/'.$file_info['file_name'];
                
                $insert_id = $this->imagen->save($post);
                
				if($file_info['image_width'] < $file_info['image_height'])
				{
					if($file_info['image_width'] == 800 || $files_info['image_height'] == 800)
					{
						unset($config);
            			$config['source_image'] = $post['imagenRuta'];
            			$config['maintain_ratio'] = 'TRUE';
            			$config['width'] = 480;
            			$config['height'] = 640;
            			$config['new_image'] = $post['imagenRuta'];
            			$this->image_lib->initialize($config);
            			$this->image_lib->resize();
					}
	                $corte = explode(".", $file_info['file_name']);
    	            $nombres_usuario1 = get_user_name($this->session->userdata('id')); 
        	        $name_short1 = cut_name_user($nombres_usuario1);
        	        //PARTE PARA QUITAR CARACTERES RAROS
        	        $name_short1 = str_replace("ú", "u", $name_short1);
				    $name_short1 = str_replace("ó", "o", $name_short1);
    				$name_short1 = str_replace("í", "i", $name_short1);
				    $name_short1 = str_replace("é", "e", $name_short1);
				    $name_short1 = str_replace("á", "a", $name_short1);
				    $name_short1 = str_replace("Á", "A", $name_short1);
				    $name_short1 = str_replace("É", "E", $name_short1);
				    $name_short1 = str_replace("Í", "I", $name_short1);
				    $name_short1 = str_replace("Ó", "O", $name_short1);
				    $name_short1 = str_replace("Ú", "U", $name_short1);
				    $name_short1 = str_replace("Ñ", "N", $name_short1);
				    $name_short1 = str_replace("ñ", "n", $name_short1);
				    $name_short1 = str_replace("ä", "a", $name_short1);
				    $name_short1 = str_replace("ë", "e", $name_short1);
				    $name_short1 = str_replace("ï", "i", $name_short1);
				    $name_short1 = str_replace("ö", "o", $name_short1);
				    $name_short1 = str_replace("ü", "u", $name_short1);
				    $name_short1 = str_replace("Ä", "A", $name_short1);
				    $name_short1 = str_replace("Ë", "E", $name_short1);
				    $name_short1 = str_replace("Ï", "I", $name_short1);
				    $name_short1 = str_replace("Ö", "O", $name_short1);
				    $name_short1 = str_replace("Ü", "U", $name_short1);
                    
                    if($valores2 == 6 || $valores == '6')
                    {
                        //PARTE DONDE SE ACTUALIZA LA FOTO DEPENDIENDO LA ORIENTACION EN ESTE CASO 6
					  	unset($config);
					  	$this->image_lib->clear();
					  
						$config['create_thumb'] = FALSE;//No thumbnail
						$config['source_image'] = $post['imagenRuta'];
						$config['new_image'] = $post['imagenRuta'];// Full path for the new image
						$config['rotation_angle'] = '270';
 
						//Initialize the new config
						$this->image_lib->initialize($config);
 
						//Rotate the image
						$this->image_lib->rotate();
						
						//PARTE PARA LA THUMBNAIL
						//CONFIGURACIONES DE LA THUMB
						unset($config);
						$this->image_lib->clear();

                        $config['image_library'] = 'gd2';
    	                $config['source_image'] = $post['imagenRuta'];
        	            $config['create_thumb'] = 'TRUE';
            	        $config['maintain_ratio'] = 'TRUE';
                	    $config['width'] = 45;
                    	$config['height'] = 55;
	                    $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);
    
                	    $this->image_lib->resize();
                    }
                    elseif($valores2 == 3 || $valores2 == '3')
                    {
                        //PARTE DONDE SE ACTUALIZA LA FOTO DEPENDIENDO LA ORIENTACION EN ESTE CASO 6
	                	
						//Unset config for the next one
						unset($config);
						$this->image_lib->clear();
					  
						$config['create_thumb'] = FALSE;//No thumbnail
						$config['source_image'] = $post['imagenRuta'];
						$config['new_image'] = $post['imagenRuta'];// Full path for the new image
						$config['rotation_angle'] = '180';
 
						//Initialize the new config
						$this->image_lib->initialize($config);
 
						//Rotate the image
						$this->image_lib->rotate();
						
						//PARTE PARA LA THUMBNAIL
						//CONFIGURACIONES DE LA THUMB
						unset($config);
						$this->image_lib->clear();

                        $config['image_library'] = 'gd2';
	                    $config['source_image'] = $post['imagenRuta'];
        	            $config['create_thumb'] = 'TRUE';
            	        $config['maintain_ratio'] = 'TRUE';
            	        $config['width'] = 55;
                    	$config['height'] = 45;
	                    $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);
    
                	    $this->image_lib->resize(); 
                    }
                    else
                    {
                        unset($config);
                        $this->image_lib->clear();
                    	$config['image_library'] = 'gd2';
	                    $config['source_image'] = $post['imagenRuta'];
    	                $config['create_thumb'] = 'TRUE';
        	            $config['maintain_ratio'] = 'TRUE';
            	        $config['width'] = 45;
                	    $config['height'] = 55;
    	                $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);

                        $this->image_lib->resize();
                    }
            	}
            	elseif($file_info['image_height'] < $file_info['image_width'])
            	{
            		if($file_info['image_width'] > 800)
            		{
            			unset($config);
            			$config['source_image'] = $post['imagenRuta'];
            			$config['maintain_ratio'] = 'TRUE';
            			$config['width'] = 800;
            			$config['height'] = 598;
            			$config['new_image'] = $post['imagenRuta'];
            			$this->image_lib->initialize($config);
            			$this->image_lib->resize();
            		}
            		$corte = explode(".", $file_info['file_name']);
    	            $nombres_usuario1 = get_user_name($this->session->userdata('id')); 
        	        $name_short1 = cut_name_user($nombres_usuario1);
            	    $name_short1 = str_replace("ú", "u", $name_short1);
				    $name_short1 = str_replace("ó", "o", $name_short1);
    				$name_short1 = str_replace("í", "i", $name_short1);
				    $name_short1 = str_replace("é", "e", $name_short1);
				    $name_short1 = str_replace("á", "a", $name_short1);
				    $name_short1 = str_replace("Á", "A", $name_short1);
				    $name_short1 = str_replace("É", "E", $name_short1);
				    $name_short1 = str_replace("Í", "I", $name_short1);
				    $name_short1 = str_replace("Ó", "O", $name_short1);
				    $name_short1 = str_replace("Ú", "U", $name_short1);
				    $name_short1 = str_replace("Ñ", "N", $name_short1);
				    $name_short1 = str_replace("ñ", "n", $name_short1);
				    $name_short1 = str_replace("ä", "a", $name_short1);
				    $name_short1 = str_replace("ë", "e", $name_short1);
				    $name_short1 = str_replace("ï", "i", $name_short1);
				    $name_short1 = str_replace("ö", "o", $name_short1);
				    $name_short1 = str_replace("ü", "u", $name_short1);
				    $name_short1 = str_replace("Ä", "A", $name_short1);
				    $name_short1 = str_replace("Ë", "E", $name_short1);
				    $name_short1 = str_replace("Ï", "I", $name_short1);
				    $name_short1 = str_replace("Ö", "O", $name_short1);
				    $name_short1 = str_replace("Ü", "U", $name_short1);
				    if($valores2 == 6 || $valores2 == '6')
				    {
				    	//PARTE DONDE SE ACTUALIZA LA FOTO DEPENDIENDO LA ORIENTACION EN ESTE CASO 6
	                	
						//Unset config for the next one
					  	unset($config);
					  	$this->image_lib->clear();
					  
						//echo "hola: " . $post['imagenRuta'];;
						$config['create_thumb'] = FALSE;//No thumbnail
						$config['source_image'] = $post['imagenRuta'];
						$config['new_image'] = $post['imagenRuta'];// Full path for the new image
						$config['rotation_angle'] = '270';
 
						//Initialize the new config
						$this->image_lib->initialize($config);
 
						//Rotate the image
						$this->image_lib->rotate();
						
						//PARTE PARA LA THUMBNAIL
						//CONFIGURACIONES DE LA THUMB
						unset($config);
						$this->image_lib->clear();

                        $config['image_library'] = 'gd2';
    	                $config['source_image'] = $post['imagenRuta'];
        	            $config['create_thumb'] = 'TRUE';
            	        $config['maintain_ratio'] = 'TRUE';
                	    $config['width'] = 45;
                    	$config['height'] = 55;
	                    $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);
    
                	    $this->image_lib->resize();
    	        	}
    	        	elseif($valores2 == 3 || $valores2 == '3')
				    {
				    	//PARTE DONDE SE ACTUALIZA LA FOTO DEPENDIENDO LA ORIENTACION EN ESTE CASO 6
	                	
						//Unset config for the next one
						unset($config);
						$this->image_lib->clear();
					  
						$config['create_thumb'] = FALSE;//No thumbnail
						$config['source_image'] = $post['imagenRuta'];
						$config['new_image'] = $post['imagenRuta'];// Full path for the new image
						$config['rotation_angle'] = '180';
 
						//Initialize the new config
						$this->image_lib->initialize($config);
 
						//Rotate the image
						$this->image_lib->rotate();
						
						//PARTE PARA LA THUMBNAIL
						//CONFIGURACIONES DE LA THUMB
						unset($config);
						$this->image_lib->clear();

                        $config['image_library'] = 'gd2';
	                    $config['source_image'] = $post['imagenRuta'];
        	            $config['create_thumb'] = 'TRUE';
            	        $config['maintain_ratio'] = 'TRUE';
            	        $config['width'] = 55;
                    	$config['height'] = 45;
	                    $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);
    
                	    $this->image_lib->resize(); 
                    }
                    else
                    {
                        //PARTE DONDE SE ACTUALIZA LA FOTO DEPENDIENDO LA ORIENTACION EN ESTE CASO 6
	                	
						//Unset config for the next one
						unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
    	                $config['source_image'] = $post['imagenRuta'];
        	            $config['create_thumb'] = 'TRUE';
            	        $config['maintain_ratio'] = 'TRUE';
                	    $config['width'] = 55;
                    	$config['height'] = 45;
	                    $config['new_image'] = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short1).'.jpg';
            	        $this->image_lib->initialize($config);

                	    $this->image_lib->resize();
                    }
            	}
                
                $valores = $this->imagen->count_data_thumbnail($this->session->userdata('id'));
                if($valores == 0)
                {
                    $nombres_usuario = get_user_name($this->session->userdata('id')); 
                    $name_short = cut_name_user($nombres_usuario);
                    //PARTE DE REASIGNACION
                    $name_short = str_replace("ú", "u", $name_short);
				    $name_short = str_replace("ó", "o", $name_short);
    				$name_short = str_replace("í", "i", $name_short);
				    $name_short = str_replace("é", "e", $name_short);
				    $name_short = str_replace("á", "a", $name_short);
				    $name_short = str_replace("Á", "A", $name_short);
				    $name_short = str_replace("É", "E", $name_short);
				    $name_short = str_replace("Í", "I", $name_short);
				    $name_short = str_replace("Ó", "O", $name_short);
				    $name_short = str_replace("Ú", "U", $name_short);
				    $name_short = str_replace("Ñ", "N", $name_short);
				    $name_short = str_replace("ñ", "n", $name_short);
				    $name_short = str_replace("ä", "a", $name_short);
				    $name_short = str_replace("ë", "e", $name_short);
				    $name_short = str_replace("ï", "i", $name_short);
				    $name_short = str_replace("ö", "o", $name_short);
				    $name_short = str_replace("ü", "u", $name_short);
				    $name_short = str_replace("Ä", "A", $name_short);
				    $name_short = str_replace("Ë", "E", $name_short);
				    $name_short = str_replace("Ï", "I", $name_short);
				    $name_short = str_replace("Ö", "O", $name_short);
				    $name_short = str_replace("Ü", "U", $name_short);
                    $ruta_imagen = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short).'_thumb.jpg';
                    $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                         'thumbUsuarioId'=>$this->session->userdata('id')
                                     );

                    $this->imagen->save_thumb($datos_thumb);
                }
                else
                {
                    $nombres_usuario = get_user_name($this->session->userdata('id')); 
                    $name_short = cut_name_user($nombres_usuario);
                	//PARTE DE REASIGNACION
                    $name_short = str_replace("ú", "u", $name_short);
				    $name_short = str_replace("ó", "o", $name_short);
    				$name_short = str_replace("í", "i", $name_short);
				    $name_short = str_replace("é", "e", $name_short);
				    $name_short = str_replace("á", "a", $name_short);
				    $name_short = str_replace("Á", "A", $name_short);
				    $name_short = str_replace("É", "E", $name_short);
				    $name_short = str_replace("Í", "I", $name_short);
				    $name_short = str_replace("Ó", "O", $name_short);
				    $name_short = str_replace("Ú", "U", $name_short);
				    $name_short = str_replace("Ñ", "N", $name_short);
				    $name_short = str_replace("ñ", "n", $name_short);
				    $name_short = str_replace("ä", "a", $name_short);
				    $name_short = str_replace("ë", "e", $name_short);
				    $name_short = str_replace("ï", "i", $name_short);
				    $name_short = str_replace("ö", "o", $name_short);
				    $name_short = str_replace("ü", "u", $name_short);
				    $name_short = str_replace("Ä", "A", $name_short);
				    $name_short = str_replace("Ë", "E", $name_short);
				    $name_short = str_replace("Ï", "I", $name_short);
				    $name_short = str_replace("Ö", "O", $name_short);
				    $name_short = str_replace("Ü", "U", $name_short);
                    $ruta_imagen = './statics/img_usuarios/'.$this->session->userdata('id').'/thumb/'.strtolower($name_short).'_thumb.jpg';
                    $this->imagen->update_thumb($ruta_imagen, $this->session->userdata('id'));
                }
				
                if($flag == 1)
                {
                    $this->avatar($insert_id);
                }
                echo json_encode($insert_id);
                return;
            }
        }
        $this->load->view('imagenes/crear', array('idAlbum'=>$id));
    }

    /**
     * Editar metadata de una imágen
     *
     * @param integer $id Id de la imágen a editar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function editar($id)
    {
        // obtener la imagen a editar
        $imagen = $this->imagen->get('imagenId = '.$id);

        // verificar si el formulario fué mandado
        $post = $this->input->post('Imagenes');
        if($post)
        {
            //prepare
            $post['imagenFechaModificacion'] = time();
            $this->imagen->save($post, 'imagenId = '.$id);
            redirect('imagenes/index/'.$imagen[0]->imagenAlbumId);
        }

        $header = $this->load->view('usuarios/header_login', '', true);
        $content = $this->load->view('imagenes/editar', array('imagen'=>$imagen), true);
        $this->load->view('main/template', array('content'=>$content, 'header'=>$header));
    }

    /**
     * Borrar una foto de la DB y del filesystem
     *
     * @param integer $id Id de la imágen a borrar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function borrar($id)
    {
        $this->imagen->delete($id);
    }

    /**
     * función parche por huevón
     * TODO: Revisar una manera correcta de hacer esto.
     *
     * Cermbiar la bandera en la DB sobre si la imagen es avatar o no. 
     * Verificando que la imagen cuyo id ha sido pasado en el parametro no 
     * tenga la bandera ya activada. Y desactivando la que estuviese 
     * configurada previamente.
     *
     * @param integer $id ID de la imagen a settear
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function avatar($id)
    {
        // encontrar primero que imágen es el avatar actual
        $imagenes = $this->imagen->get('imagenes.imagenId = '.$id);
        $imagen = $imagenes[0];

        //check if the flag is set
        if($imagen->imagenAvatar == 1)
        {
            return;
        }else{
            $this->imagen->save(array('imagenAvatar'=>0), 
            'imagenes.imagenAvatar = 1 AND imagenes.imagenAlbumId = '.$imagen->imagenAlbumId);
            $this->imagen->save(array('imagenAvatar'=>1), 'imagenes.imagenId = '.$id);
        }
		redirect(''.base_url().'index.php/usuarios/perfil#'.base_url().'index.php/albums/ver_albums/'.$this->session->userdata('id'));
    }

    /**
     * De esas funciones que estoy seguro vamos a tener que quitar después pero
     * hecha para sacar del apuro
     *
     * @param integer $id_imagen ID de la imagen a revisar
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function cambiar_avatar($id_imagen=null)
    {
        $id = $this->session->userdata('id');
        // chack if there is a get param
        if($id_imagen)
        {
            // set image and return
            $this->avatar($id_imagen);
            return;
        }
        // Create default albumn or return the one already in DB
        $idAlbum = $this->imagen->get_default_album($id);
        $this->load->view('imagenes/crear', array('idAlbum'=>$idAlbum, 'flag'=>1));
    }

    /**
     * Obtener el URL de la imágen según el id que se pasa.
     *
     * @return void
     * @author axoloteDeAccion <mario.r.vallejo@gmail.com>
     **/
    public function get_imagen_url($id)
    {
        $data = $this->imagen->get('imagenes.imagenId = '.$id);
        $url = $data[0]->imagenRuta;
        echo base_url().$url;
    }

    /**
     **/
	public function crear_imagen($id_imagen)
    {
        
        $this->load->view('imagenes/crear', array('idAlbum'=>$id_imagen, 'flag'=>0));
    }

    /**
     **/
	public function imagenes_album($id,$idU)
    {
        //obtener todas las imágenes del album
        $imagenes = $this->imagen->get('imagenAlbumId = '.$id);
		$album=$this->imagen->getalbum('albumId = '.$id);
		$anexo=$this->imagen->get_anexo($idU);
        $this->load->view('imagenes/index', array('imagenes'=>$imagenes, 'albumId'=>$id,'album'=>$album,'anexo'=>$anexo));
    }
}
