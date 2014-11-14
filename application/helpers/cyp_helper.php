<?php
/**
 * Coleccion de funciones para la creacion
 * y obtencion de datos de ciertas tablas
 * como son ciudades o paises. Tambien para
 * la creacion obtener los dias, meses y años
 * y colocarlos en un arreglo para su uso en
 * el front-end
 * 
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 * @version 0.1
 * @copyright ZavorDigital, 14 February, 2011
 * @package Helpers
 **/
 
 /**
  * Funcion para crear los arreglos de los paises
  * y los estados que se encuentren en dichas
  * tablas
  *
  * @params object cin informacion de la base 
  * de datos
  * @return array con datos de paises y estados
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function create_array($datosC)
    {
	    foreach($datosC->result() as $key)
		{
		    $p[$key->id] = $key->nombre;
		}
		return $p;
    }

 /**
  * Se crea un arreglo asociativo con los seguidores que
  * la empresa tiene para poder seleccionar a que usuario se
  * le mandara el inbox. NOTA SE MANDA ID DE EMPRESA EN TABLA
  * DE USUARIOS NO EL DE NEGOCIOS
  *
  * @params object con informacion de los seguidores
  * @return array con datos de los seguidores
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function create_array_followers($datos)
  {
      foreach($datos->result() as $key)
      {
          $p[$key->seguidorUsuarioId] = $key->nombre;
      }
      return $p;
  }

 /*
  * Se crea una funcion para crear un arreglo asociativo con
  * el cual se usara para poder crear una lista desplegable
  * con las subcategorias para que seleccione el pulzo a que
  * tipo de categoria va
  *
  * @params string datos a usarse para crear el arreglo asociativo
  * @return array arreglo asociativo con el cual se usara para mostrar las 
  *     subcategorias
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function create_array_subcategories($data)
  {
      foreach($data as $key)
      {
          $p[$key->id] = $key->nombre;
      }
      return $p;
  }

 /**
  * Se crea un arreglo asociativo con los amigos que el
  * usuario tiene para poder seleccionar a quien desea mandarle
  * el inbox. NOTA SE MANDA EL ID DE LA EMPRESA EN CASO DE QUE
  * LA SELECCION SEA EL NEGOCIO
  *
  * @params object con la informacion de los usuarios
  * @return array con los datos de los amigos
  * @author blackfoxghdl <ruben.alonso21@gmail.com>
  **/
  function create_array_friends($datos)
  {
      foreach($datos->result() as $key)
      {
          $p[$key->amigoAmigoId] = $key->nombre;
      }
      return $p;
  }

 /**
  * Funcion para obtener los dias que se
  * muestran en la parte de registro, 
  * colocandolos en un arreglo
  *
  * @return array blackfoxgdl <ruben.alonso21@gmail.com>
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function days()
	{
		for($i=0; $i<32; $i++)
		{
			if($i === 0)
			{
				$dias['dia'] = "Día";
			}
			else
			{
				if(strlen($i) == 1)
				{
					$dias['0'.$i] = $i;
				}
				else
				{
					$dias[$i] = $i;
				}
			}
		}
		return $dias;
	}
	
 /**
  * Meotod de meses, los cuales los
  * coloca en un arreglo para 
  * mostrarlos en el registro
  *
  * @return array, valores de los meses
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function month()
	{
		$meses = array('0'=>'Mes',
					   '01'=>'Enero',
					   '02'=>'Febrero',
					   '03'=>'Marzo',
					   '04'=>'Abril',
					   '05'=>'Mayo',
					   '06'=>'Junio',
					   '07'=>'Julio',
					   '08'=>'Agosto',
					   '09'=>'Septiembre',
					   '10'=>'Octubre',
					   '11'=>'Noviembre',
					   '12'=>'Diciembre');
		return $meses;
    }

 /**
  * Metodo para obtener los años en
  * un arreglo, comenzando desde 
  * 1904 hasta 2011 en forma descendente
  *
  * @return array con datos de los años
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function year()
	{
		for($i=1997; $i>1904; $i--)
		{
			if($i === 1997)
			{
				$valor['ano'] = "Año";
			}
			$valor[$i] = $i;
		}
		return $valor;
    }

  /**
   * Helper que se usa para poder obtener las horas cada
   * 30 minutos, la cual se usara para poder crear las horas
   * en las cuales se podran seleccionar las horas que se
   * desean para poder seleccionar el inicio del plan
   *
   * @return array con datos de las horas
   * @author blackfoxgdl <ruben.alonso21@gmail.com
   **/
  function hours()
  {
      $p = array('12:00 pm' => '12:00 pm',
                 '12:30 pm' => '12:30 pm',
                 '1:00 pm' => '1:00 pm',
                 '1:30 pm' => '1:30 pm',
                 '2:00 pm' => '2:00 pm',
                 '2:30 pm' => '2:30 pm',
                 '3:00 pm' => '3:00 pm',
                 '3:30 pm' => '3:30 pm',
                 '4:00 pm' => '4:00 pm',
                 '4.30 pm' => '4:30 pm',
                 '5:00 pm' => '5:00 pm',
                 '5:30 pm' => '5:30 pm',
                 '6:00 pm' => '6:00 pm',
                 '6:30 pm' => '6:30 pm',
                 '7:00 pm' => '7:00 pm',
                 '7:30 pm' => '7:30 pm',
                 '8:00 pm' => '8:00 pm',
                 '8:30 pm' => '8:30 pm',
                 '9:00 pm' => '9:00 pm',
                 '9:30 pm' => '9:30 pm',
                 '10:00 pm' => '10:00 pm',
                 '10:30 pm' => '10:30 pm',
                 '11:00 pm' => '11:00 pm',
                 '11:30 pm' => '11:30 pm',
                 '12:00 am' => '12:00 am',
                 '12:20 am' => '12:30 am',
                 '1:00 am' => '1:00 am',
                 '1:30 am' => '1:30 am',
                 '2:00 am' => '2:00 am',
                 '2:30 am' => '2:30 am',
                 '3:00 am' => '3:00 am',
                 '3:30 am' => '3:30 am',
                 '4:00 am' => '4:30 am',
                 '5:00 am' => '5:00 am',
                 '5:30 am' => '5:30 am',
                 '6:00 am' => '6:00 am',
                 '6:30 am' => '6:30 am',
                 '7:00 am' => '7:00 am',
                 '7:30 am' => '7:00 am',
                 '8:00 am' => '8:00 am',
                 '8:30 am' => '8:30 am',
                 '9:00 am' => '9:00 am',
                 '9:30 am' => '9:30 am',
                 '10:00 am' => '10:00 am',
                 '10:30 am' => '10:30 am',
                 '11:00 am' => '11:00 am',
                 '11:30 am' => '11:30 am');
      return $p;
  }

 /**
  * Metodo para poder obtener 
  * los años del usuario y 
  * mostrar los datos en perfil
  *
  * @params date, fecha de nacimiento
  * @return int, edad obtenida
  * @author blackfoxgdl <ruben.alonso21@gmail.com>
  **/
  function edad_usuario($fecha)
	{
		$actualY = date('Y');
		$actualD = date('d');
		$actualM = date('m');
		$fecha = explode(' ',$fecha);
		$nacimiento = explode('-',$fecha[0]);
		$edad = $actualY - $nacimiento[0];
		if($actualM < $nacimiento[1])
		{
			$edad = $edad - 1;
			return $edad;
		}
		if($actualM > $nacimiento[1])
		{
			return $edad;
		}
		if($nacimiento[1] == $actualM)
		{
			if($actualD < $nacimiento[2])
			{
				$edad = $edad - 1;
				return $edad;
			}
			else
			{
				return $edad;
			}
		}
	}
 
  /**
   * Metodo para saber si es
   * el usuario mayor de edad
   * o si es menor de edad
   *
   * @params string fecha de nacimiento
   * @return flag Verdadero exito
   *			  Falso no exito
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function mayor_edad($ano, $mes, $dia)
  {
  		$actualY = date('Y');
		$actualD = date('d');
		$actualM = date('m');
		$edad = $actualY - $ano;
		if($edad < 13)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
  }

  /**
   * Crea o acomoda la fecha en un formato corto para poder mostrarlo en
   * la parte de estados de cuenta o en cualquier otra parte sin hacer
   * la cadena tan larga y dejarla de manera corta
   *
   * @params string fecha de unix a human
   * @return string fecha
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function fecha_acomodo_corto($data)
  {
        $valor = explode(" ", $data);
        $corte = explode("-", $valor[0]);
        if($corte[1] == '1')
        {
            $mes = "Ene";
        }
        if($corte[1] == '2')
        {
            $mes = "Feb";
        }
        if($corte[1] == '3')
        {
            $mes = "Mar";
        }
        if($corte[1] == '4')
        {
            $mes = "Abr";
        }
        if($corte[1] == '5')
        {
            $mes = "May";
        }
        if($corte[1] == '6')
        {
            $mes = "Jun";
        }
        if($corte[1] == '7')
        {
            $mes = "Jul";
        }
        if($corte[1] == '8')
        {
            $mes = "Ago";
        }
        if($corte[1] == '9')
        {
            $mes = "Sep";
        }
        if($corte[1] == '10')
        {
            $mes = "Oct";
        }
        if($corte[1] == '11')
        {
            $mes = "Nov";
        }
        if($corte[1] == '12')
        {
            $mes = "Dic";
        }
        $fecha = $corte[2] . '-' . $mes . '-' . $corte[0];
        return $fecha;
  }

  /**
   * Crea o acomoda la fecha que se esta sacando de la
   * base de datos para que se le de un formato entendible
   * para el usuario y no solo nuemros.
   * Se puede usar en cualquier modulo del sistemas, solo
   * se necesita primero tener la fecha en formato string y
   * despues se pasa como parametro en la funcion
   *
   * @params string fecha de unix a human
   * @return string fecha
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function fecha_acomodo($data)
  {
        $valor = explode(" ", $data);
        $corte = explode("-", $valor[0]);
        if($corte[1] == '1')
        {
            $mes = "Enero";
        }
        if($corte[1] == '2')
        {
            $mes = "Febrero";
        }
        if($corte[1] == '3')
        {
            $mes = "Marzo";
        }
        if($corte[1] == '4')
        {
            $mes = "Abril";
        }
        if($corte[1] == '5')
        {
            $mes = "Mayo";
        }
        if($corte[1] == '6')
        {
            $mes = "Junio";
        }
        if($corte[1] == '7')
        {
            $mes = "Julio";
        }
        if($corte[1] == '8')
        {
            $mes = "Agosto";
        }
        if($corte[1] == '9')
        {
            $mes = "Septiembre";
        }
        if($corte[1] == '10')
        {
            $mes = "Octubre";
        }
        if($corte[1] == '11')
        {
            $mes = "Noviembre";
        }
        if($corte[1] == '12')
        {
            $mes = "Diciembre";
        }
        $fecha = $corte[2] . ' de ' . $mes . ' de ' . $corte[0];
        return $fecha;
  }

  /** Crea o acomoda la fecha junto con la hora de la
   * base de datos para que se le de un formato entendible
   * para el usuario y no solo nuemros.
   * Se puede usar en cualquier modulo del sistemas, solo
   * se necesita primero tener la fecha en formato string y
   * despues se pasa como parametro en la funcion
   *
   * @params string fecha de unix a human
   * @return string fecha
   * @author jorge Leon
   **/
  function fecha_hora_acomodo($data)
  {
        $valor = explode(" ", $data);
        $corte = explode("-", $valor[0]);
        $hora = explode(" ", $valor[1]);
        $amPm = explode(" ",$valor[2]);
        if($corte[1] == '1')
        {
            $mes = "enero";
        }
        if($corte[1] == '2')
        {
            $mes = "febrero";
        }
        if($corte[1] == '3')
        {
            $mes = "marzo";
        }
        if($corte[1] == '4')
        {
            $mes = "abril";
        }
        if($corte[1] == '5')
        {
            $mes = "mayo";
        }
        if($corte[1] == '6')
        {
            $mes = "junio";
        }
        if($corte[1] == '7')
        {
            $mes = "julio";
        }
        if($corte[1] == '8')
        {
            $mes = "agosto";
        }
        if($corte[1] == '9')
        {
            $mes = "septiembre";
        }
        if($corte[1] == '10')
        {
            $mes = "octubre";
        }
        if($corte[1] == '11')
        {
            $mes = "noviembre";
        }
        if($corte[1] == '12')
        {
            $mes = "diciembre";
        }
        $fecha = $corte[2] . ' de ' . $mes . ' de ' . $corte[0].' '.$hora[0].' '.$amPm[0];
        return $fecha;
  }

  /**
   * Se obtienen la ciudad del usuario dependiendo el
   * id de la ciudad que tenga registrada en la base de datos,
   * se obtiene solo mandando a llamar esta funcion
   *
   * @params int id de la ciudad
   * @return string nombre de la ciudad a la que pertenece
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function ciudad_usuario($id)
  {
      $CI =& get_instance();
      $CI->db->select('*')
             ->from('estado')
             ->where('id',$id);
      $ciudad = $CI->db->get();
      $nombreCiudad = $ciudad->row();
      return  $nombreCiudad->nombre;
    }

  /**
   * Se obtienen los datos del pais del usuario dependiendo
   * el id del pias quje se tenga registrada en su perfil, se obtiene
   * mandando a llamar esta funcion.
   *
   * @params int id del pais del usuario
   * @return string nombre del pais
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function pais_usuario($id)
  {
      $CI =& get_instance();
      $CI->db->select('*')
             ->from('pais')
             ->where('id', $id);
      $query = $CI->db->get();
      $nombrePais = $query->row();
      return $nombrePais->nombre;
  }

  /**
   * Se obtiene el estado civil del usuario para mostrarlo
   * en sus datos personales al momento de que el usuario
   * vea el perfil del mismo.
   *
   * @params int id del estado civil
   * @return string status del estado civil
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function estado_civil_usuario($id)
  {
      $CI =& get_instance();
      $CI->db->select('*')
             ->from('estadocivil')
             ->where('id',$id);
      $estado = $CI->db->get();
      $estadoCivil = $estado->row();
      return $estadoCivil->nombre;
  }

  /**
   * Helper con el cual podre obtener el giro
   * del negocio y asi poder mostrarlo cuando
   * un usuario visite mi perfil
   *
   * @params int id del giro del negocio
   * @return string nombre del giro
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function get_giro_negocio($id)
  {
      $CI =& get_instance();
      $CI->db->select('*')
             ->from('giro')
             ->where('id',$id);
      $query = $CI->db->get();
      if($query->num_rows() != 0)
      {
          $nombre = $query->row();
          return $nombre->nombre;
      }
      else
      {
          return "";
      }
  }

  /**
   * Helper que se usa para acomodar o dar
   * formatos a una fecha en especifico, esto con el
   * motivo de que la fecha aparesca con el mes expresado
   * en formato de cadena y no como numero. Ademas de dar formato
   * a la fecha que se pase como parametro
   *
   * @params string fecha a manipular
   * @return fecha con formato
   * @author blackfoxgdl <ruben.alonso21@gmail.com>
   **/
  function fecha_con_formato($str)
  {
      $fecha = explode("-", $str);
      switch($fecha[1])
      {
          case '01': $val = "Enero";
          case '02': $val = "Febrero";
          case '03': $val = "Marzo";
          case '04': $val = "Abril";
          case '05': $val = "Mayo";
          case '06': $val = "Junio";
          case '07': $val = "Julio";
          case '08': $val = "Agosto";
          case '09': $val = "Septiembre";
          case '10': $val = "Octubre";
          case '11': $val = "Noviembre";
          case '12': $val = "Diciembre";
      }
      $fecha_final = $fecha[0] . " de " . $val . " de " . $fecha[2];
      return $fecha_final;
  }

  /*busqueda de descripcion negocio*/
  function descripcion_negocio($negid){
	  $CI=& get_instance();
	  $CI->db->select('*')
		   ->from('negocios')
		   ->where('negocioUsuarioId',$negid);
	  $dene= $CI->db->get();
	  $descNegocio = $dene->row();
	  return $descNegocio->negocioDescripcion;
  }
  
 //sacar seguidor 
  function pulzos_seguidor($id){
	  $CI=& get_instance();
	  $CI->db->select('*')
		   ->from('seguidores')
		   ->where('seguidorUsuarioId',$id);
	  $seguidor= $CI->db->get();
	  $id = $seguidor->row();
	  return $id;
  }
  
  /**
   **/
  function pulzos_negocios($id){
	  $CI=& get_instance();
	  $CI->db->select('*')
		   ->from('negocios')
		   ->where('negocioId',$id);
	  $seguidor= $CI->db->get();
	  $id = $seguidor->row();
	  return $id;
  }
