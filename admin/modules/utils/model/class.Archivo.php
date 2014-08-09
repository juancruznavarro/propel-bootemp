<?php
/**
 * Modelo de Utilidades - class.Archivo.php
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
 * Short description of class Archivo
 *
 * @access public
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
class Archivo
{

	/**
	 * Short description of attribute _nombre
	 *
	 * @access private
	 * @var String
	 */
	private $_nombre = null;

	/**
	 * Short description of attribute _path
	 *
	 * @access private
	 * @var String
	 */
	private $_path = null;

	/**
	 * Short description of attribute _size
	 *
	 * @access private
	 * @var Integer
	 */
	private $_size = null;

	/**
	 * Short description of attribute _mimeType
	 *
	 * @access private
	 * @var String
	 */
	private $_mimeType = null;

	/**
	 * Short description of attribute _extension
	 *
	 * @access private
	 * @var String
	 */
	private $_extension = null;

	/**
	 * Constructor
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @param  String nombre=null Nombre del archivo, puede contener la ruta completa y extension
	 * @param  String path=null Directorio del archivo
	 * @return mixed
	 */
	public function __construct($nombre=null, $path=null)
	{
		if(!empty($nombre)){
			$data = pathinfo($nombre);

			if(key_exists('extension', $data)){
				$this->_extension = $data['extension'];
			}
			if(key_exists('dirname', $data)){
				$this->_path = $data['dirname'];
			}
			if(key_exists('filename', $data)){
				$this->_nombre = $data['filename'];
			}
		}else{
			$this->_nombre = $nombre;
		}
		if(!empty($path)) $this->_path = $path;
	}

	/**
	 * Establece el nombre del archivo, puede contener la ruta completa y extension
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  String nombre
	 * @return mixed
	 */
	public function setNombre($nombre)
	{
		$data = pathinfo($nombre);
		 
		if(key_exists('extension', $data)){
			$this->_extension = $data['extension'];
		}
		if(key_exists('dirname', $data)){
			$this->_path = $data['dirname'];
		}
		if(key_exists('filename', $data)){
			$this->_nombre = $data['filename'];
		}
	}

	/**
	 * Devuelve el nombre del archivo sin su extension
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String
	 */
	public function getNombre()
	{
		return $this->_nombre;
	}

	/**
	 * Short description of method setPath
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  String path
	 * @return mixed
	 */
	public function setPath($path)
	{
		$this->_path = $path;
	}

	/**
	 * Short description of method getPath
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String
	 */
	public function getPath()
	{
		return $this->_path;
	}

	/**
	 * Devuelve el nombre y ruta completo del archivo.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String
	 */
	public function getFullPath()
	{
		$path = $this->_path.'/'.$this->_nombre;
		if(!empty($this->_extension)) $path .= '.'.$this->_extension;
		 
		return $path;
	}

	/**
	 * Short description of method setSize
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  Integer size
	 * @return mixed
	 */
	public function setSize($size)
	{
		$this->_size = $size;
	}

	/**
	 * Short description of method getSize
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Integer
	 */
	public function getSize()
	{
		return $this->_size;
	}

	/**
	 * Short description of method setMimeType
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  String mimeType
	 * @return mixed
	 */
	public function setMimeType($mimeType)
	{
		$this->_mimeType = $mimeType;
	}

	/**
	 * Short description of method getMimeType
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String
	 */
	public function getMimeType()
	{
		return $this->_mimeType;
	}

	/**
	 * Establece la extension del archivo.
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @param  String extension
	 * @return mixed
	 */
	public function setExtension($extension)
	{
		$this->_extension = $extension;
	}

	/**
	 * Devuelve la extension del archivo.
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @return String
	 */
	public function getExtension()
	{
		return $this->_extension;
	}
}
?>