<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
class TablaBase
{
	private $nombre="";
	private $columnas = null;
	private $clase;
	private $diminutivo="";

	public function getNombre()
	{
		return $this->nombre;
	}
	
	public function setNombre($xNombre)
	{
		$this->nombre=$xNombre;
	}
	
	public function setColumnas($xColumnas)
	{
		$this->columnas=$xColumnas;
	}
	
	public function getColumnas()
	{
		return $this->columnas;
	}
	
	public function getColumnasReales()
	{
		$vRes = array();
		$i=0;
		foreach($this->columnas as $columna)
		{
			if(!$columna->getColumnaAnonima())
			{
			   $vRes[$i]=$columna;
			   $i++;
			}
		}
		return $vRes;
	}
	
	public function setClase($xClase)
	{
		$this->clase=$xClase;
	}
	
	public function getClase()
	{
		return $this->clase;
	}
	
	public function setDiminutivo($xDiminutivo)
	{
		$this->diminutivo=$xDiminutivo;
	}
	
	public function getDiminutivo()
	{
		return $this->diminutivo;
	}
	
	public function getObtenerId()
	{
		$res="";
		$cantidad=count($this->columnas);
		$i=0;
		$encontrado=false;
		while($i<$cantidad && !$encontrado)
		{
			if($this->columnas[$i]->getEsPk())
			{
				$res=$this->columnas[$i]->getColumna();
				$encontrado=true;
			}
			$i++;
		}
		$cantidad=null;
		$i=null;
		return $res;
	}
	
	public function getObtenerMetodoId()
	{
		$res="";
		$cantidad=count($this->columnas);
		$i=0;
		$encontrado=false;
		while($i<$cantidad && !$encontrado)
		{
			if($this->columnas[$i]->getEsPk())
			{
				$res=$this->columnas[$i]->getMetodo();
				$encontrado=true;
			}
			$i++;
		}
		$cantidad=null;
		$i=null;
		return $res;
	}
}
?>