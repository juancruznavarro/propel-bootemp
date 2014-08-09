<?php
/**
 * Modelo de Utilidades - class.ArchivoImagen.php
 *
 * $Id$
 *
 * This file is part of Modelo de Utilidades.
 *
 * Automatically generated on 17.04.2012, 18:22:36 with ArgoUML PHP module
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */

/**
 * include Archivo
 *
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
require_once('class.Archivo.php');

/**
 * Short description of class ArchivoImagen
 *
 * @access public
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
class ArchivoImagen
extends Archivo
{

	/**
	 * Short description of attribute _ancho
	 *
	 * @access private
	 * @var Integer
	 */
	private $_ancho = null;

	/**
	 * Short description of attribute _alto
	 *
	 * @access private
	 * @var Integer
	 */
	private $_alto = null;

	/**
	 * Short description of method __construct
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @param  String nombre=null Nombre del archivo, puede contener la ruta completa y extension
	 * @param  String path=null Directorio del archivo
	 * @param  Integer ancho=null Ancho de la imagen
	 * @param  Integer alto=null Alto de la imagen
	 * @return mixed
	 */
	public function __construct($nombre=null, $path=null, $ancho=null, $alto=null)
	{
		parent::__construct($nombre, $path);
		$this->setAlto($alto);
		$this->setAncho($ancho);
	}

	/**
	 * Short description of method setAncho
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  Integer ancho
	 * @return mixed
	 */
	public function setAncho($ancho)
	{
		$this->_ancho = $ancho;
	}

	/**
	 * Short description of method getAncho
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Integer
	 */
	public function getAncho()
	{
		return $this->_ancho;
	}

	/**
	 * Short description of method setAlto
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  Integer alto
	 * @return mixed
	 */
	public function setAlto($alto)
	{
		$this->_alto = $alto;
	}

	/**
	 * Short description of method getAlto
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Integer
	 */
	public function getAlto()
	{
		return $this->_alto;
	}
}
?>