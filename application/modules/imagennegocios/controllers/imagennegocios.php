<?php if(! defined('BASEPATH')) exit('No Direct Script Access Allowed.');
/**
 * Controlador de imagenNegocios, es el
 * archivo que hace toda la funcionalidad
 * de este modulo como lo es crear, ver,
 * actualizar y eliminar a la imagen. En general
 * este metodo manejara todos los datos de las
 * imagenes del negocio.
 *
 * @version 0.1 
 * @copyright ZavorDigital, 21 February, 2011
 * @package imagenUsuarios
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
 
class imagenNegocios extends MX_Controller
{
	/**
	 * @ignore
	 * Estructura de la BD en imagenNegocios
	 * imagenId: int(11) not null, PK, autoIncrement
	 * imagenNegocioAlbumId: int(11) not null
	 * imagenNegocioAvatar: tinyint(1) not null
	 * imagenNegocioNombre: varchar(140) not null
	 * imagenNegocioDescripcion: text not null
	 * imagenNegocioRuta: varchar(300) not null
	 * imagenfechaCreacion: int(11) not null
	 * imagenFechaModificacion: int(11) not null
	 **/
	 
	/**
	 * Constructor del controllador de
	 * imagenes de negocios donde se
	 * inicializaran todas las librerias,
	 * helpers y el modelo
	 *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('imagenNegocio', '', TRUE);
		$this->load->library(array('session','user_agent'));
		$this->load->helper(array('url','html','form', 'avatar', 'apipulzos'));
	}
	
	/**
	 * Carga la vista inicial de los imagenes del
	 * album dependiendo el id del mismo. Solo es
	 * para los negocios
	 *
     * @params int id de la imagen
     * @params int id del negocio
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function index($id, $idN=null)
    {
        $datos['idNegocios'] = $idN;
        $datos['datosImg'] = $id;
        $datos['imagenes'] = $this->imagenNegocio->get('imagenNegocioAlbumId = '.$id);
        $this->load->view('imagennegocios/index',$datos);
	}
	
	/** 
	 * Metodo el cual muestra la vista de
	 * las imagenes que estan en los albums
	 * de los negocios
	 *
     * @params int id de la imagen
     * @params int id de la empresa
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function ver($id)
    {
        //SE OBTIENEN LOS DATOS DE LA IMAGEN
        $datos['imagen'] = $this->imagenNegocio->get_imagen_data($id);
        $this->load->view("imagennegocios/ver", $datos);
    }
	
	/**
	 * Crea un registro de la imagen que se
	 * carga en el album de los negocios, ademas
	 * de que guarda la imagen referenciada a la 
	 * relacion de los usuarios
	 *
	 * @params int id del album
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function crear($id, $flag=0)
    {
		// verificar si el furmulario ha sido mandado.
        $post = $this->input->post('Imagenes');
		$idImagen = $this->imagenNegocio->get_data($this->session->userdata('id'));
        if($post)
        {
            //cargar la libreria de la manipulacion de imagenes
            $this->load->library('image_lib');

            $file_path = './statics/img_negocios/'.$idImagen->negocioId.'/'.$id.'/';
            //create directory
            @mkdir($file_path, 0777, true);

            //crear directorio para el thumbnail negocios
            $file_thumb = './statics/img_negocios/'.$idImagen->negocioId.'/thumb/';
            //create directory
            @mkdir($file_thumb, 0777, true);

            //prepare file upload
            $upload_settings = array(
                'upload_path'=>$file_path,
                'allowed_types'=>'gif|jpg|jpeg|png',
                'max_size'=>'10000',
                'max_width'=>'3000',
                'max_height'=>'3000',
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
                $post['imagenNegocioAlbumId'] = $id;
                $post['imagenNegocioRuta'] = 'statics/img_negocios/'.$idImagen->negocioId.'/'.$id.'/'.$file_info['file_name'];
                $insert_id = $this->imagenNegocio->save($post);
            
                $nombres_negocios = cut_name_user($idImagen->negocioNombre);
                $config['image_library'] = 'gd2';
                $config['source_image'] = $post['imagenNegocioRuta'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 45;
                $config['height'] = 55;
                $config['new_image'] = './statics/img_negocios/'.$idImagen->negocioId.'/thumb/'.$this->session->userdata('idN').'.jpg';
                $this->image_lib->initialize($config);

                $this->image_lib->resize();

                if($file_info['image_width'] < $file_info['image_height'])
                { //if checar si el ancho es menor **inicio**
                    if($file_info['image_width'] == 800 || $file_info['image_height'] == 800)
                    {
                        unset($config);
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 480;
                        $config['height'] = 640;
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $name_short1 = $this->session->userdata('idN');
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
                    if($valores2 == 6 || $valores2 == '6')
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $config['rotation_angle'] = '270';

                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        //PARTE DE LA THUMBNAIL
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                    elseif($valores2 == 3 || $valores2 == '3')
                    {
                        unset($config);
                        $this->image_lib->clear();

                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $config['rotation_angle'] = '180';

                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        //CREATE THE THUMB
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            var_dump($datos_thumb);
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                    else
                    {
                        unset($config);
                        $this->image_lib->clear();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            var_dump($datos_thumb);
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                } //if checar si el ancho es menor **fin**
                elseif($file_info['image_height'] < $file_info['image_width'])
                {//else checar si es menor la altura **inicio**
                    if($file_info['image_width'] > 800)
                    {
                        unset($config);
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 800;
                        $config['height'] = 598;
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $corte = explode(".", $file_info['file_name']);
                    $name_short1 = $this->session->userdata('idN');
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
                    if($valores2 == 6 || $valores2 == '6')
                    {
                        unset($config);
                        $this->image_lib->clear();

                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $config['rotation_angle'] = '270';

                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        //CREATE THE THUMBNAIL
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 45;
                        $config['height'] = 55;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            var_dump($datos_thumb);
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                    elseif($valores2 == 3 || $valores2 == '3')
                    {
                        unset($config);
                        $this->image_lib->clear();

                        $config['create_thumb'] = FALSE;
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['new_image'] = $post['imagenNegocioRuta'];
                        $config['rotation_angle'] = '180';

                        $this->image_lib->initialize($config);
                        $this->image_lib->rotate();

                        //CREATE THUMB
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            var_dump($datos_thumb);
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                    else
                    {
                        unset($config);
                        $this->image_lib->clear();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $post['imagenNegocioRuta'];
                        $config['create_thumb'] = 'TRUE';
                        $config['maintain_ratio'] = 'TRUE';
                        $config['width'] = 55;
                        $config['height'] = 45;
                        $config['new_image'] = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'.jpg';

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $valores = $this->imagenNegocio->count_data_thumbnail($this->session->userdata('id'));
                        if($valores == 0)
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $datos_thumb = array('usuarioThumbName'=>$ruta_imagen,
                                                 'thumbUsuarioId'=>$this->session->userdata('id')
                                                );
                            var_dump($datos_thumb);
                            $this->imagenNegocio->save_thumb($datos_thumb);
                        }
                        else
                        {
                            $name_short = cut_name_user($idImagen->negocioNombre);
                            $ruta_imagen = './statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                            $this->imagenNegocio->update_thumb($ruta_imagen, $this->session->userdata('id'));
                        }
                        //UPDATE GEOTAG IMG
                        $ruta_img1 = 'statics/img_negocios/'.$this->session->userdata('idN').'/thumb/'.$name_short1.'_thumb.jpg';
                        $rt_img = str_replace('/', '-', $ruta_img1);
                        $ruta_img = 'http:--www.pulzos.com-'.$rt_img;
                        $this->imagenNegocio->update_img_geotag($this->session->userdata('id'), $ruta_img);
                    }
                }//else checar si es menor la altura **fin**
                if($flag == 1)
                {
                    $this->cambiar_avatar_negocio($insert_id);
                }
                echo json_encode($insert_id);
                return;
            }
        }
        $this->load->view('imagennegocios/crear', array('idAlbum'=>$id));
	}
	
	/**
	 * Metodo para editar los datos
	 * de la imagen del album de negocios
	 *
     * @params int id de la imagen
     * @params int id del album al que pertenece la imagen NULL
     * @params int id del negocio
     *
	 * @return flag verdadero exito falso fallido
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function editar($id, $idA = null, $idN = null)
    {
        $post = $this->input->post('EditarI');
        if($post)
        {
            $post['imagenFechaModificacion'] = time();
            $this->imagenNegocio->edit_data($post, $id);
        }
        else
        {
            $datos['imagenes'] = $this->imagenNegocio->get_imagen_data($id);
            $this->load->view('imagennegocios/editar', $datos);
        }
    }
	
	/**
	 * Borra la imagen del album de negocios
	 * y ya no aparece en este
	 *
	 * @params int id de la imagen
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	 public function borrar($id, $idA=null)
     {
         $valor = $this->imagenNegocio->delete($id);
     }

    /**
     * Metodos que se usa para sacar del apuro en cuanto al 
     * avatar sino no terminamos
     *
     * @params int id de la imagen
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function cambiar_avatar_negocio($id_imagen=null)
    {
        $id = $this->session->userdata('idN');
        //checar si hay un parametro GET
        if($id_imagen)
        {
            //se establece la imagen y se regresa
            $this->avatar($id_imagen);
            return;
        }
        //crea un album por defecto o regresa uno ya en la bd
        $idAlbum = $this->imagenNegocio->get_default_album($id);
        $this->load->view('imagennegocios/crear', array('idAlbum'=>$idAlbum, 'flag'=>1));
    }

	/**
	 * Marca la imagen que se quiere de avatar
	 * para mostrarla en el perfil del negocio
	 * y en todas las partes donde aparesca
	 *
     * @params int id de la imagen
     * @params int id del album al que pertenece la imagen
     *
	 * @return void
	 * @author blackfoxgdl <ruben.alonso21@gmail.com>
	 **/
	public function avatar($id)
    {
        // encontrar primero que imágen es el avatar actual
        $imagenes = $this->imagenNegocio->get('imagennegocios.imagenId = '.$id);
        if(!empty($imagenes))
        {
            $imagen = $imagenes[0];
            //check if the flag is set
            if($imagen->imagenNegocioAvatar == 1)
            {
                return;
            }else{
                $this->imagenNegocio->edit(array('imagenNegocioAvatar'=>0), 
                'imagennegocios.imagenNegocioAvatar = 1 AND imagennegocios.imagenNegocioAlbumId = ' . $imagen->imagenNegocioAlbumId);
                $this->imagenNegocio->edit(array('imagenNegocioAvatar'=>1), 
                                                 'imagennegocios.imagenId = '.$id);
            }
        }
        else
        {
            redirect('http://www.pulzos.com/inicio.php/negocios/perfil#http://www.pulzos.com/index.php/negocios/principal/'.$this->session->userdata('id').'/'.$this->session->userdata('idN'));
        }
    }

    /**
     * Obtener la URL de la imagen segun el id que se pasa
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    public function get_imagen_url($id)
    {
        $data = $this->imagenNegocio->get('imagennegocios.imagenId = '.$id);
        $url = $data[0]->imagenNegocioRuta;
        echo base_url().$url;
    }
}
