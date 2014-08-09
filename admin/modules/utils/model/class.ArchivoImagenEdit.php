<?php
/**
 * Modelo de Utilidades - class.ArchivoImagenResize.php
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
 * include ArchivoImagen
 *
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
require_once('class.ArchivoImagen.php');

/**
 * include ArchivoControl
 *
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
require_once('interface.ArchivoControl.php');

/**
 * Short description of class ArchivoImagenResize
 *
 * @access public
 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
 */
class ArchivoImagenEdit
implements ArchivoControl
{

	/**
	 * Short description of attribute _archivoImagenOriginal
	 *
	 * @access private
	 * @var ArchivoImagen
	 */
	private $_archivoImagenOriginal = null;

	/**
	 * Short description of attribute _archivoImagenDestino
	 *
	 * @access private
	 * @var ArchivoImagen
	 */
	private $_archivoImagenDestino = null;

	/**
	 * Short description of attribute _error
	 *
	 * @access private
	 * @var String
	 */
	private $_error = null;

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
		if(empty($this->_archivoImagenOriginal)){
			$this->_error .= 'No se definió el archivo original.';
			return false;
		}
		if(empty($this->_archivoImagenDestino)){
			$this->_error .= 'No se definió el archivo destino.';
			return false;
		}
		if(!function_exists('gd_info')){
			$this->_error .= 'No se encontró instalada la biblioteca GD.';
			return false;
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
		if(!is_writable($this->_archivoImagenDestino->getPath())){
			$this->_error .= 'El directorio "'.$this->_archivoImagenDestino->getPath().'" no tiene permisos de escritura.';
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
		if(!file_exists($this->_archivoImagenDestino->getPath())){
			$this->_error .= 'El dirctorio "'.$this->_archivoImagenDestino->getPath().'" no existe.';
			return false;
		}
		return true;
	}

	/**
	 * Constructor de clase, ejemplo de uso:
	 *
	 * <code>
	 * $archivoImagenDestino = new ArchivoImagen([archivoDestino],[directorioDestino],[ancho], [alto]);
	 * $archivoImagenOriginal = new ArchivoImagen([archivoOrigen],[directorioOrigen]);
	 * $archivoImagenOriginal->setExtension([extensionArchivoOrigen]);
	 * $crop = new ArchivoImagenEdit();
	 * $crop->setArchivoImagenDestino($archivoImagenDestino);
	 * $crop->setArchivoImagenOriginal($archivoImagenOriginal);
	 * $rs = $crop->crop([coordenadaX], [coordenadaY]);
	 * if(!$rs){
	 * 		echo $crop->errorInfo();die;
	 * }
	 * </code>
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param ArchivoImagen archivoImagenOriginal=null Archivo original a modificar
	 * @param ArchivoImagen archivoImagenDestino=null Archivo destino, el que se guardará
	 * @return mixed
	 */
	public function __construct(ArchivoImagen $archivoImagenOriginal=null, ArchivoImagen $archivoImagenDestino=null)
	{
		$this->_archivoImagenDestino = new ArchivoImagen();
		$this->_archivoImagenOriginal = new ArchivoImagen();
		 
		if(!empty($archivoImagenDestino))
		$this->setArchivoImagenDestino($archivoImagenDestino);
		if(!empty($archivoImagenOriginal)){
			$this->setArchivoImagenOriginal($archivoImagenOriginal);
			$this->_archivoImagenDestino->setMimeType($archivoImagenOriginal->getMimeType());
			$this->_archivoImagenDestino->setExtension($archivoImagenOriginal->getExtension());
		}
	}

	/**
	 * Short description of method setArchivoImagenOriginal
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  ArchivoImagen archivoImagenOriginal
	 * @return mixed
	 */
	public function setArchivoImagenOriginal(ArchivoImagen $archivoImagenOriginal)
	{
		$data = getimagesize($archivoImagenOriginal->getFullPath());
		 
		if($archivoImagenOriginal->getAlto()!='')
		$this->_archivoImagenOriginal->setAlto($archivoImagenOriginal->getAlto());
		else
		$this->_archivoImagenOriginal->setAlto($data[1]);
		 
		if($archivoImagenOriginal->getAncho()!='')
		$this->_archivoImagenOriginal->setAncho($archivoImagenOriginal->getAncho());
		else
		$this->_archivoImagenOriginal->setAncho($data[0]);
		 
		if($archivoImagenOriginal->getMimeType()!='')
		$this->_archivoImagenOriginal->setMimeType($archivoImagenOriginal->getMimeType());
		else
		$this->_archivoImagenOriginal->setMimeType($data['mime']);
		 
		if($archivoImagenOriginal->getNombre()!='')
		$this->_archivoImagenOriginal->setNombre($archivoImagenOriginal->getNombre());
		 
		if($archivoImagenOriginal->getPath()!='')
		$this->_archivoImagenOriginal->setPath($archivoImagenOriginal->getPath());
		 
		if($archivoImagenOriginal->getSize()!='')
		$this->_archivoImagenOriginal->setSize($archivoImagenOriginal->getSize());
		else
		$this->_archivoImagenOriginal->setSize(filesize($archivoImagenOriginal->getFullPath()));
		 
		if($archivoImagenOriginal->getExtension()!=''){
			$this->_archivoImagenOriginal->setExtension($archivoImagenOriginal->getExtension());
			if($this->_archivoImagenDestino->getExtension()=='')
			$this->_archivoImagenDestino->setExtension($archivoImagenOriginal->getExtension());
		}
	}

	/**
	 * Short description of method getArchivoImagenOriginal
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return ArchivoImagen
	 */
	public function getArchivoImagenOriginal()
	{
		return $this->_archivoImagenOriginal;
	}

	/**
	 * Short description of method setArchivoImagenDestino
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @param  ArchivoImagen archivoImagenDestino
	 * @return mixed
	 */
	public function setArchivoImagenDestino(ArchivoImagen $archivoImagenDestino)
	{
		if($archivoImagenDestino->getAlto()!='')
		$this->_archivoImagenDestino->setAlto($archivoImagenDestino->getAlto());
		if($archivoImagenDestino->getAncho()!='')
		$this->_archivoImagenDestino->setAncho($archivoImagenDestino->getAncho());
		if($archivoImagenDestino->getMimeType()!='')
		$this->_archivoImagenDestino->setMimeType($archivoImagenDestino->getMimeType());
		if($archivoImagenDestino->getNombre()!='')
		$this->_archivoImagenDestino->setNombre($archivoImagenDestino->getNombre());
		if($archivoImagenDestino->getPath()!='')
		$this->_archivoImagenDestino->setPath($archivoImagenDestino->getPath());
		if($archivoImagenDestino->getSize()!='')
		$this->_archivoImagenDestino->setSize($archivoImagenDestino->getSize());
		if($archivoImagenDestino->getExtension()!='')
		$this->_archivoImagenDestino->setExtension($archivoImagenDestino->getExtension());
	}

	/**
	 * Short description of method getArchivoImagenDestino
	 *
	 * @access public
	 * @author L. Marcelo Sosa, <marcelo@msosa.com.ar>
	 * @return ArchivoImagen
	 */
	public function getArchivoImagenDestino()
	{
		return $this->_archivoImagenDestino;
	}

	/**
	 * Recorta la imagen y devuelve true en caso exitoso o false de lo
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @param  Integer cropX=0 Coordenada x del punto de origen.
	 * @param  Integer cropY=0 Coordenada y del punto de origen.
	 * @param  Integer quality=100 Establece la calidad de la imagen resultante, de 0 a 100
	 * @return Boolean
	 */
	public function crop($cropX=0, $cropY=0, $quality=100)
	{
		if(!$this->_check()) return false;
		$imgTarget= @imagecreatetruecolor($this->_archivoImagenDestino->getAncho(), $this->_archivoImagenDestino->getAlto());
		if(!$imgTarget){
			$this->_error .= 'No fue posible crear el flujo de imagen GD.';
			return false;
		}
		 
		$targetPath = $this->_archivoImagenDestino->getPath().'/';
		$targetNombre = $this->_archivoImagenDestino->getNombre();
		 
		switch($this->_archivoImagenOriginal->getMimeType()){
			case 'image/jpg':
				$imgOrig = @imagecreatefromjpeg($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/jpeg':
				$imgOrig = @imagecreatefromjpeg($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/png':
				$imgOrig = @imagecreatefrompng($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/gif':
				$imgOrig = @imagecreatefromgif($this->_archivoImagenOriginal->getFullPath());
				break;
		}
		if(!$imgOrig){
			$this->_error .= 'No fue posible crear el archivo de imagen GD.';
			return false;
		}
		 
		$origenAncho = $this->_archivoImagenOriginal->getAncho();
		$origenAlto = $this->_archivoImagenOriginal->getAlto();
		 
		$destAncho = $this->_archivoImagenDestino->getAncho();
		$destAlto = $this->_archivoImagenDestino->getAlto();
		 
		$imgCopy = @imagecopyresampled($imgTarget, $imgOrig, 0, 0, $cropX, $cropY, $destAncho, $destAlto, $destAncho, $destAlto);
		if(!$imgCopy){
			$this->_error .= 'No fue posible realizar el redimensionado.';
			return false;
		}
		 
		switch($this->_archivoImagenOriginal->getMimeType()){
			case 'image/jpg':
				$fileTarget = @imagejpeg($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/jpeg':
				$fileTarget = @imagejpeg($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/png':
				$fileTarget = @imagepng($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/gif':
				$fileTarget = @imagegif($imgTarget, $this->_archivoImagenDestino->getFullPath());
				break;
		}
		if(!$fileTarget){
			$this->_error .= 'Error al crear el archivo final.';
			return false;
		}
		@imagedestroy($imgTarget);
		@imagedestroy($imgOrig);
		 
		return true;
	}

	/**
	 * Redimensiona la imagen y devuelve true en caso exitoso o false de lo
	 *
	 * @access public
	 * @author Marcelo Sosa, <marcelo@puentedigital.com>
	 * @param  Integer quality=100 Establece la calidad de la imagen resultante, de 0 a 100
	 * @return Boolean
	 */
	public function redim($quality=100)
	{
		if(!$this->_check()) return false;
		$destAncho = $this->_archivoImagenDestino->getAncho();
		$destAlto = $this->_archivoImagenDestino->getAlto();
		if(empty($destAlto) && empty($destAncho)){
			$this->_error .= 'No se definio ni el ancho ni el alto de la imagen de destino.';
			return false;
		}

		if(empty($destAlto)){
			// Obtener proporcion del alto de la imagen original
			$porcentaje = $this->_archivoImagenOriginal->getAlto()*100/$this->_archivoImagenOriginal->getAncho();
			$destAlto = round($this->_archivoImagenDestino->getAncho()*$porcentaje/100);
		}
		if(empty($destAncho)){
			// Obtener proporcion del ancho de la imagen original
			$porcentaje = $this->_archivoImagenOriginal->getAncho()*100/$this->_archivoImagenOriginal->getAlto();
			$destAncho = round($this->_archivoImagenDestino->getAlto()*$porcentaje/100);
		}

		$imgTarget= @imagecreatetruecolor($destAncho, $destAlto);
		if(!$imgTarget){
			$this->_error .= 'No fue posible crear el flujo de imagen GD.';
			return false;
		}

		switch($this->_archivoImagenOriginal->getMimeType()){
			case 'image/jpg':
				$imgOrig = @imagecreatefromjpeg($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/jpeg':
				$imgOrig = @imagecreatefromjpeg($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/png':
				$imgOrig = @imagecreatefrompng($this->_archivoImagenOriginal->getFullPath());
				break;
			case 'image/gif':
				$imgOrig = @imagecreatefromgif($this->_archivoImagenOriginal->getFullPath());
				break;
		}
		if(!$imgOrig){
			$this->_error .= 'No fue posible crear el archivo de imagen GD.';
			return false;
		}

		$imgCopy = @imagecopyresampled($imgTarget, $imgOrig, 0, 0, 0, 0, $destAncho, $destAlto, $this->_archivoImagenOriginal->getAncho(), $this->_archivoImagenOriginal->getAlto());
		if(!$imgCopy){
			$this->_error .= 'No fue posible realizar el redimensionado.';
			return false;
		}

		switch($this->_archivoImagenOriginal->getMimeType()){
			case 'image/jpg':
				$fileTarget = @imagejpeg($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/jpeg':
				$fileTarget = @imagejpeg($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/png':
				$fileTarget = @imagepng($imgTarget, $this->_archivoImagenDestino->getFullPath(), $quality);
				break;
			case 'image/gif':
				$fileTarget = @imagegif($imgTarget, $this->_archivoImagenDestino->getFullPath());
				break;
		}
		if(!$fileTarget){
			$this->_error .= 'Error al crear el archivo final.';
			return false;
		}
		@imagedestroy($imgTarget);
		@imagedestroy($imgOrig);
		 
		return true;
	}
}
?>