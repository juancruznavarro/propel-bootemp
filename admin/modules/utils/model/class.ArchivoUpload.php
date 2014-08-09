<?php
/**
 * Modelo de Utilidades - class.ArchivoUpload.php
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
 * include ArchivoControl
 *
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
require_once('interface.ArchivoControl.php');

/**
 * Short description of class ArchivoUpload
 *
 * @access public
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
class ArchivoUpload
implements ArchivoControl
{

	/**
	 * Short description of attribute _archivoOrigen
	 *
	 * @access private
	 * @var Archivo
	 */
	private $_archivoOrigen = null;

	/**
	 * Short description of attribute _archivoDestino
	 *
	 * @access private
	 * @var Archivo
	 */
	private $_archivoDestino = null;

	/**
	 * Matriz de mimeTypes permitidos
	 *
	 * @access private
	 * @var String[]
	 */
	private $_allowMimeTypes = null;

	/**
	 * Matriz de mimeTypes no permitidos.
	 *
	 * @access private
	 * @var String[]
	 */
	private $_disallowMimeTypes = null;

	/**
	 * Short description of attribute _error
	 *
	 * @access private
	 * @var String
	 */
	private $_error = null;

	/**
	 * Short description of attribute _maxSize
	 *
	 * @access private
	 * @var Integer
	 */
	private $_maxSize = null;

	/**
	 * Guarda el archivo en disco.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Boolean
	 */
	public function save()
	{
		if(!$this->_check()) return false;
		if(!copy($this->_archivoOrigen->getPath().'/'.$this->getArchivoOrigen()->getNombre(), $this->_archivoDestino->getFullPath())){
			$this->_error .= 'Error al copiar el archivo.';
			return false;
		}
		return true;
	}

	/**
	 * Devuelve el mensaje descripivo del error ocurrido.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String
	 */
	public function errorInfo()
	{
		return $this->_error;
	}

	/**
	 * Realiza las comprobaciones se cumplan.
	 *
	 * @access private
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Boolean
	 */
	private function _check()
	{
		if(empty($this->_archivoOrigen)){
			$this->_error .= 'No se especificó el archivo de origen.';
			return false;
		}
		if(empty($this->_archivoDestino)){
			$this->_error .= 'No se especificó el archivo destino.';
			return false;
		}
		$this->_getMaxSize();
		if($this->_archivoOrigen->getSize()>$this->_maxSize){
			$this->_error .= 'El archivo es mayor al maximo permitido de: '.$this->_maxSize.'KB.';
			return false;
		}
		if(count($this->_allowMimeTypes)>0){
			if(!in_array($this->_archivoOrigen->getMimeType(), $this->_allowMimeTypes)){
				$this->_error .= 'El tipo de archivo "'.$this->_archivoOrigen->getMimeType().'" no esta en los permitidos.';
				return false;
			}
		}
		if(count($this->_disallowMimeTypes)>0){
			if(in_array($this->_archivoOrigen->getMimeType(), $this->_disallowMimeTypes)){
				$this->_error .= 'El tipo de archivo "'.$this->_archivoOrigen->getMimeType().'" esta en los no permitidos.';
				return false;
			}
		}
		$rs = $this->_isExist();
		if($rs) $rs = $this->_isWritable();
		return $rs;
	}

	/**
	 * Verifica que el destino sea posible escribir.
	 *
	 * @access private
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Boolean
	 */
	private function _isWritable()
	{
		if(!is_writable($this->_archivoDestino->getPath())){
			$this->_error .= 'El directorio "'.$this->_archivoDestino->getPath().'" no tiene permisos de escritura.';
			return false;
		}
		return true;
	}

	/**
	 * Verifica que el directorio destino existe.
	 *
	 * @access private
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Boolean
	 */
	private function _isExist()
	{
		if(!file_exists($this->_archivoDestino->getPath())){
			$this->_error .= 'El directorio "'.$this->_archivoDestino->getPath().'" no existe.';
			return false;
		}
		return true;
	}

	/**
	 * Constructor de clase, ejemplo de uso:
	 *
	 * <code>
	 * $up = new ArchivoUpload();
	 * $up->setFileUpload($_FILES['archivo']);
	 * $up->setArchivoDestino(new Archivo('test','temp'));
	 * $rs = $up->save();
	 * if(!$rs){
	 * 		echo $up->errorInfo();die;
	 * }
	 * </code>
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return mixed
	 */
	public function __construct()
	{
		$this->_allowMimeTypes = array();
		$this->_disallowMimeTypes = array();
		$this->_archivoDestino = new Archivo();
		$this->_archivoOrigen = new Archivo();
	}

	/**
	 * Short description of method setArchivoOrigen
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  Archivo archivoOrigen
	 * @return mixed
	 */
	public function setArchivoOrigen(Archivo $archivoOrigen)
	{
		$this->_archivoOrigen = $archivoOrigen;
	}

	/**
	 * Short description of method getArchivoOrigen
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Archivo
	 */
	public function getArchivoOrigen()
	{
		return $this->_archivoOrigen;
	}

	/**
	 * Short description of method setArchivoDestino
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  Archivo archivoDestino
	 * @return mixed
	 */
	public function setArchivoDestino(Archivo $archivoDestino)
	{
		if($archivoDestino->getExtension()!='')
		$this->_archivoDestino->setExtension($archivoDestino->getExtension());
		if($archivoDestino->getMimeType()!='')
		$this->_archivoDestino->setMimeType($archivoDestino->getMimeType());
		if($archivoDestino->getNombre()!='')
		$this->_archivoDestino->setNombre($archivoDestino->getNombre());
		if($archivoDestino->getPath()!='')
		$this->_archivoDestino->setPath($archivoDestino->getPath());
		if($archivoDestino->getSize()!='')
		$this->_archivoDestino->setSize($archivoDestino->getSize());
	}

	/**
	 * Short description of method getArchivoDestino
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Archivo
	 */
	public function getArchivoDestino()
	{
		return $this->_archivoDestino;
	}

	/**
	 * Establece los mimeTypes permitidos.
	 *
	 * <code>
	 * $allowMimeTypes = array('image/jpg','text/plain','application/pdf');
	 * </code>
	 *
	 * MimeTypes:
	 * <ul>
	 * <li>image/jpg</li>
	 * <li>image/jpeg</li>
	 * <li>image/png</li>
	 * <li>image/gif</li>
	 * <li>text/plain</li>
	 * <li>application/pdf</li>
	 * </ul>
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  String[] allowMimeTypes
	 * @return mixed
	 */
	public function setAllowMimeTypes(array $allowMimeTypes)
	{
		$this->_allowMimeTypes = $allowMimeTypes;
	}

	/**
	 * Devuelve los mimeTypes permitidos.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String[]
	 */
	public function getAllowMimeTypes()
	{
		return $this->_allowMimeTypes;
	}

	/**
	 * Establece los mimeTypes no permitidos.
	 *
	 * <code>
	 * $disallowMimeTypes = array('application/sh','application/octet-stream');
	 * </code>
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  String[] disallowMimeTypes
	 * @return mixed
	 */
	public function setDisallowMimeTypes(array $disallowMimeTypes)
	{
		$this->_disallowMimeTypes = $disallowMimeTypes;
	}

	/**
	 * Devuelve los mimeTypes no permitidos.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return String[]
	 */
	public function getDisallowMimeTypes()
	{
		return $this->_disallowMimeTypes;
	}

	/**
	 * Asignamos un objetos de tipo $_FILES directamente.
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param $_FILES fileUpload
	 * @return mixed
	 */
	public function setFileUpload($fileUpload)
	{
		if($fileUpload['error']){
			$this->_error .= 'Error al subir el archivo, verifique que el tamaño no supere los: "'.round($this->_getMaxSize()/1024/1024).'MB"';
			return false;
		}
		$data = pathinfo($fileUpload['tmp_name']);
		$data2 = pathinfo($fileUpload['name']);
		 
		$this->_archivoOrigen->setNombre($data['basename']);
		$this->_archivoOrigen->setPath($data['dirname']);
		$this->_archivoOrigen->setSize($fileUpload['size']);
		 
		$this->_archivoDestino->setExtension($data2['extension']);
		 
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		 
		$this->_archivoOrigen->setMimeType($finfo->file($fileUpload['tmp_name']));
	}

	/**
	 * Metodo que obtiene el tamaño maximo permitido por el servidor
	 * para subir archivos, y devuelve el tamaño en BYTES
	 *
	 * @access private
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return Integer
	 */
	private function _getMaxSize()
	{
		$iniMaxSize = ini_get('upload_max_filesize');
		$unidad = strtoupper(substr($iniMaxSize,-1));
		$size = 1;
		$factor = 1;
		 
		switch ($unidad){
			case 'M':
				$factor = 1024*1024;
				$size = (int) substr($iniMaxSize,0,-1);
				break;
			case 'G':
				$factor = 1024*1024*1024;
				$size = (int) substr($iniMaxSize,0,-1);
				break;
			default:
				$size = (int) $iniMaxSize;
		}
		$maxSize = $size*$factor;
		$this->_maxSize = $maxSize;
		return $maxSize;
	}
}
?>
