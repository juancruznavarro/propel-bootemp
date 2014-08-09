<?php
/**
 * Clase Upload
 *
 * @author Luis Marcelo Sosa <marcelo@puentedigital.com>
 * @access public
 */
class PdUpload{
	/**
	 * Objeto de tipo $_FILES
	 *
	 * @access private
	 * @var File
	 */
	private $_file;
	/**
	 * Nombre de la extension del archivo
	 *
	 * @access private
	 * @var String
	 */
	private $_extension;
	/**
	 * Nombre con el que se guardara el archivo
	 *
	 * @access private
	 * @var String
	 */
	private $_nameSave;
	/**
	 * Nombre de referencia del archivo
	 *
	 * @access private
	 * @var String
	 */
	private $_nameRef;
	/**
	 * Mime Type del archivo
	 *
	 * @access private
	 * @var String
	 */
	private $_mime;
	/**
	 * Tamaño en bytes del archivo
	 *
	 * @access private
	 * @var Integer
	 */
	private $_size;
	/**
	 * Ruta al directorio donde se guardara el archivo
	 *
	 * @access private
	 * @var String
	 */
	private $_pathSave;
	/**
	 * Extensiones por defecto permitidas para guardar
	 *
	 * @access private
	 * @var Array
	 */
	private $_allowExtensions = array(
									'jpg',
									'png',
									'gif',
									'pdf',
									'txt',
									'csv',
									'doc',
									'docx',
									'xls',
									'xlsx',
									'ods',
									'odt',
									'zip',
									'7z',
									'rar'
	);
	/**
	 * En caso de error se carga con un mensaje descriptivo
	 *
	 * @access private
	 * @var String
	 */
	private $_error;
	/**
	 * Tamaño maximo que puede tener el archivo
	 *
	 * @access private
	 * @var Integer
	 */
	private $_maxSize;

	/**
	 * Constructor de la clase, donde podemos definir el objeto
	 * $_FILES que contiene el archivo, y la ruta en la que se
	 * guardara
	 *
	 * @access public
	 * @param File $file
	 * @param String $savePath='./'
	 */
	public function __construct($file=null, $savePath='./'){
		$this->setPathSave($savePath);
		if(!empty($file)) $this->setFile($file);
	}

	/**
	 * Definicion del objeto $_FILES que contiene el archivo
	 *
	 * @access public
	 * @param File $file
	 */
	public function setFile($file){
		$this->_file = $file;

		$nameSave = $file['name'];
		$tmp = explode('.',$nameSave);
		if(count($tmp)>1){
			$p = count($tmp)-1;
			$ext = $tmp[$p];
			$nameSave = str_replace('.'.$ext, '', $nameSave);
				
			$this->_extension = $ext;
		}
		$this->_nameSave = $nameSave;
		$this->_nameRef = $nameSave;
	}

	/**
	 * Devuelve el objeto $_FILES
	 *
	 * @access public
	 * @return $_FILES
	 */
	public function getFile(){
		return $this->_file;
	}

	/**
	 * Definicion de las extensiones permitidas por la clase,
	 *
	 * Ejemplo:
	 * <code>
	 * <?php
	 * $up = new Upload($_FILES['imagen'],'dir_upload');
	 * $up->setAllowExtensions(array('doc','xls'));
	 * $up->save();
	 * ?>
	 * </code>
	 *
	 * @access public
	 * @param String[] $allowExtensions
	 */
	public function setAllowExtensions($allowExtensions = array()){
		$this->_allowExtensions = $allowExtensions;
	}

	/**
	 * Devuelve una matriz de las extensiones permitidas, sin el punto
	 *
	 * @access public
	 * @return String[]
	 */
	public function getAllowExtensions(){
		return $this->_allowExtensions;
	}

	/**
	 * Definicion del nombre con el cual sera guardado el archivo,
	 * puede o no contener la extension, en caso de no tenerla, sera completada
	 * con la correspondiente al mime type del archivo
	 *
	 * @access public
	 * @param String $nameSave
	 */
	public function setNameSave($nameSave){
		$tmp = explode('.',$nameSave);

		if(count($tmp)>1){
			$p = count($tmp)-1;
			$ext = $tmp[$p];
			$nameSave = str_replace('.'.$ext, '', $nameSave);
				
			$this->_extension = $ext;
		}else{
			$this->_extension = $this->_getMime();
		}
		$this->_nameSave = $nameSave;
	}

	/**
	 * Devuelve el nombre del archivo que se guardó o guardará
	 *
	 * @access public
	 * @return String
	 */
	public function getNameSave(){
		return $this->_nameSave;
	}

	/**
	 * Definicion del directorio donde se guardara el archivo,
	 * puede o no contener la barra final, ej: "/var/uploads" o "/var/uploads/"
	 *
	 * @access public
	 * @param String $pathSave
	 */
	public function setPathSave($pathSave){
		$barra = substr($pathSave,-1);
		if($barra!='/') $pathSave .= '/';
		$this->_pathSave = $pathSave;
	}

	/**
	 * Devuelve la ruta en la que se guardó o guardará el archivo
	 *
	 * @access public
	 * @return String
	 */
	public function getPathSave(){
		return $this->_pathSave;
	}

	/**
	 * En caso de error, devuelve una descripcion del mismo
	 *
	 * @access public
	 * @return String
	 */
	public function errorInfo(){
		return $this->_error;
	}

	/**
	 * Metodo para guardar en disco el archivo, si se realizo
	 * correctamente devuelve el nombre del archivo con el que se guardo,
	 * en caso de error devuelve FALSE
	 *
	 * @access public
	 * @return Boolean
	 */
	public function save(){
		if(!$this->_check()) return false;

		$archivo = $this->_nameSave;
		if(!empty($this->_extension))
		$archivo .= '.'.$this->_extension;

		//print_r($this);die;


		if(!copy($this->_file['tmp_name'], $this->_pathSave.$archivo)){
			$this->_error = 'No se pudo copiar el archivo y no pudimos detectar el motivo.';
			return false;
		}
		return $archivo;
	}

	/**
	 * Metodo que controla que se cumplan las condiciones para ser guardado
	 * el archivo
	 *
	 * @access private
	 * @return Boolean
	 */
	private function _check(){
		if(!is_dir($this->_pathSave)){
			$this->_error = '"'.$this->_pathSave.'" no es un directorio válido.';
			return false;
		}
		if(!is_writable($this->_pathSave)){
			$this->_error = '"'.$this->_pathSave.'" no tiene los permisos de escritura necesarios.';
			return false;
		}
		if($this->_getMaxSize()<$this->_file['size']){
			$this->_error = 'El tamaño del archivo es mayor a: "'.ini_get('upload_max_filesize').'".';
			return false;
		}
		if(!is_uploaded_file($this->_file['tmp_name'])){
			$this->_error = 'El archivo no pudo ser subido, error desconocido.';
			return false;
		}
		$ext = $this->_getMime();
		if(!in_array($ext,$this->_allowExtensions)){
			$this->_error = 'El tipo de archivo "'.$ext.'" no esta permitido, verifique el tipo.';
			return false;
		}
		return true;
	}

	/**
	 * Metodo que obtiene el tamaño maximo permitido por el servidor
	 * para subir archivos, y devuelve el tamaño en BYTES
	 *
	 * @access private
	 * @return Integer
	 */
	private function _getMaxSize(){
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
		return $maxSize;
	}

	/**
	 * Metodo que obtine el mime y devuelve la extension real del archivo que se intenta subir,
	 * sin importar la extension que contenga
	 *
	 * @access private
	 * @return String
	 */
	private function _getMime(){
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$this->_mime = $finfo->file($this->_file['tmp_name']);

		$realExt = null;

		switch($finfo->file($this->_file['tmp_name'])){
			case 'image/jpeg':
				$realExt = 'jpg';
				break;
			case 'image/gif':
				$realExt = 'gif';
				break;
			case 'image/png':
				$realExt = 'png';
				break;
			case 'text/x-php':
				$realExt = 'php';
				break;
			case 'application/pdf':
				$realExt = 'pdf';
				break;
			case 'text/plain':
				$realExt = 'txt';
				break;
			case 'application/vnd.ms-office':
				$tmp = explode('.', $this->_file['name']);
				$p = count($tmp)-1;
				$realExt = $tmp[$p];
				break;
			case 'application/vnd.oasis.opendocument.text':
				$tmp = explode('.', $this->_file['name']);
				$p = count($tmp)-1;
				$realExt = $tmp[$p];
				break;
			case 'application/msword':
				$realExt = 'doc';
				break;
			case 'application/vnd.ms-excel':
				$realExt = 'xls';
				break;
			case 'application/octet-stream':
				$tmp = explode('.', $this->_file['name']);
				$p = count($tmp)-1;
				$realExt = $tmp[$p];
				break;
			case 'application/x-rar':
				$realExt = 'rar';
				break;
			case 'application/zip':
				$realExt = 'zip';
				break;
			default:
				$realExt = 'dat';
		}
		$this->_realExtension = $realExt;

		return $realExt;
	}
}
?>