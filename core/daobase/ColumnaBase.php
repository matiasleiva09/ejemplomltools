<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
class ColumnaBase
{
	private $columna="";
	private $metodo="";
	private $esPk=false;
	private $tipo="";
	private $esFk=false;
	private $autoCargaFk=false;
	private $columnaFk="";
	private $tablaBase=null;
	private $columnaAnonima=false;
	
	public function setColumna($xColumna)
	{
		$this->columna=$xColumna;
	}
	
	public function getColumna()
	{
		return $this->columna;
	}
	
	public function setMetodo($xMetodo)
	{
		$this->metodo=$xMetodo;
	}
	
	public function getMetodo()
	{
		return $this->metodo;
	}
	
	public function getEsPk()
	{
		return $this->esPk;
	}
	
	public function setEsPk($xEsPk)
	{
		$this->esPk=$xEsPk;
	}
	
	public function getEsFk()
	{
		return $this->esFk;
	}
	
	public function setEsFk($xesFk)
	{
		$this->esFk=$xesFk;
	}
	
	public function setTipo($xTipo)
	{
		$this->tipo=$xTipo;
	}
	
	public function getTipo()
	{
		return $this->tipo;
	}
	
	public function setAutoCargaFk($xAutoCargaFk)
	{
		$this->autoCargaFk=$xAutoCargaFk;
	}
	
	public function getAutoCargaFk()
	{
		return $this->autoCargaFk;
	}
	
	public function setColumnaFk($xColumnaFk)
	{
		$this->columnaFk=$xColumnaFk;
	}
	
	public function getColumnaFk()
	{
		return $this->columnaFk;
	}
	
	public function setTablaBase($xTablaBase)
	{
		$this->tablaBase=$xTablaBase;
	}
	
	public function getTablaBase()
	{
		return $this->tablaBase;
	}
	
	public function getColumnaAnonima()
	{
		return $this->columnaAnonima;
	}
	
	public function setColumnaAnonima($xColumnaAnonima)
	{
		$this->columnaAnonima=$xColumnaAnonima;
	}
}
?>