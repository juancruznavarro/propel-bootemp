<?php
class PdGenerarClave{
	private $_mayusculas;
	private $_minusculas;
	private $_numeros;
	private $_simbolos;
	private $_usar;
	private $_longitud;

	/**
	 * CONSTRUCTOR
	 *
	 * @param Integer $longitud=16
	 */
	public function __construct($longitud=16){
		$this->_mayusculas = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$this->_minusculas = str_split('abcdefghijklmnopqrstuvwxyz');
		$this->_numeros = str_split('0123456789');
		$this->_simbolos = str_split('+-_!?%&$#()~*<>|@');
		$this->_usar = array();
		$this->_longitud = $longitud;
	}

	/**
	 * Establece el uso de los caracteres en Mayusculas
	 */
	public function usarMayusculas(){
		$this->_usar[] = $this->_mayusculas;
	}

	/**
	 * Establece el uso de los caracteres en Minusculas
	 */
	public function usarMinusculas(){
		$this->_usar[] = $this->_minusculas;
	}

	/**
	 * Establece el uso de caracteres especiales, simbolos
	 */
	public function usarSimbolos(){
		$this->_usar[] = $this->_simbolos;
	}

	/**
	 * Establece el uso de numeros
	 */
	public function usarNumeros(){
		$this->_usar[] = $this->_numeros;
	}

	/**
	 * Establece la longitud de la clave a generar
	 *
	 * @param Integer $longitud
	 */
	public function setLongitud($longitud){
		$this->_longitud = $longitud;
	}

	/**
	 * Devuelve la clave generada aleatoriamente
	 *
	 * @return String
	 */
	public function getClave(){
		$res = NULL;

		if(count($this->_usar)==0)
		$this->_usar = array($this->_mayusculas,$this->_minusculas,$this->_simbolos,$this->_numeros);
		if($this->_longitud==0)
		$this->_longitud = 16;

		$nUsar = count($this->_usar)-1;

		for($i=0;$i<$this->_longitud;$i++){
			$pUsar = rand(0,$nUsar);
			$n = count($this->_usar[$pUsar])-1;
			$p = rand(0,$n);
				
			$res .= $this->_usar[$pUsar][$p];
		}
		return $res;
	}
}
?>