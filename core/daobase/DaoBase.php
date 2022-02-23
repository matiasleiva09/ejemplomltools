<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
abstract class DaoBase
{
	private $selectAll="select *";
	private $selectCol="select ";
	private $update="update ";
	private $insert="insert into ";
	private $delete="delete from ";
	private $tabla;
	private $inners=null;
	private $sesion=null;
	
	public function __construct($xTabla)
	{
		$this->selectAll.=" from ".$xTabla->getNombre();
		$this->update.=$xTabla->getNombre();
		$this->insert.=$xTabla->getNombre();
		$this->delete.=$xTabla->getNombre();
		$this->tabla=$xTabla;
	}
	
	public function getBuscarPorId($xId)
	{
		$vSQL=$this->selectAll." where ".$this->tabla->getObtenerId()."=".$xId;
		$dato=Sql::encontrar($vSQL);
		if($dato!=null)
		{
			$nombreClase=$this->tabla->getClase();
		    $res = new $nombreClase();
			foreach($this->tabla->getColumnasReales() as $columna)
			{
				call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			}
			return $res;
		}
		else
		{
			return null;
		}
	}
	
	public function getBuscarPorIdTabla($xId,$xTablaBase)
	{
		$vSQL="select * from ".$xTabla->getNombre()." where ".$this->tabla->getObtenerId()."=".$xId;
		$dato=Sql::encontrar($vSQL);
		if($dato!=null)
		{
			$nombreClase=$xTabla->getClase();
			$res = new $nombreClase();
			foreach($xTabla->getColumnasReales() as $columna)
			{
				call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			}
			return $res;
		}
		else
		{
			return null;
		}
	}
	
	public function getBusquedaManual($xPatronBusqueda)
	{
		$vSQL=$this->selectAll." ".$xPatronBusqueda;
		$dato=Sql::encontrar($vSQL);
		if($dato!=null)
		{
			$nombreClase=$this->tabla->getClase();
			$res = new $nombreClase();
			foreach($this->tabla->getColumnasReales() as $columna)
			{
				call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			}
			return $res;
		}
		else
		{
			return null;
		}
	}
	
	public function getBuscarPor($xBusqueda)
	{
		$vSQL=$this->selectAll." where ".$xBusqueda;
		$dato=Sql::encontrar($vSQL);
		if($dato!=null)
		{
			$nombreClase=$this->tabla->getClase();
			$res = new $nombreClase();
			foreach($this->tabla->getColumnasReales() as $columna)
			{
				call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			}
			return $res;
		}
		else
		{
			return null;
		}
	}

	public function getListarPor($xPatron)
	{
		$datos=Sql::consultar($this->selectAll ." ".$xPatron);
		$listaFinal=array();
		if($datos!=null)
		{
			$i=0;
			foreach($datos as $dato)
			{
			     $nombreClase=$this->tabla->getClase();
				 $res = new $nombreClase();
			     foreach($this->tabla->getColumnasReales() as $columna)
			     {
					call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			     }
			     $listaFinal[$i]=$res;
			     $res=null;
			     $i++;
			     
			}
			return $listaFinal;
		}
		else
		{
			return null;
		}
	}

	public function getListarTodas()
	{
		$datos=Sql::consultar($this->selectAll);
		$listaFinal=array();
		if($datos!=null)
		{
			$i=0;
			foreach($datos as $dato)
			{
			     $nombreClase=$this->tabla->getClase();
				 $res = new $nombreClase();
			     foreach($this->tabla->getColumnasReales() as $columna)
			     {
					call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$columna->getColumna()]));
			     }
			     $listaFinal[$i]=$res;
			     $res=null;
			     $i++;
			     
			}
			return $listaFinal;
		}
		else
		{
			return null;
		}
	}
	
	public function guardar($xObjeto)
	{
		$vSQL=$this->insert;
		$vSQL.=" (";
		$cantidad=count($this->tabla->getColumnasReales());
		$i=0;
		$columnas=$this->tabla->getColumnasReales();
		while($i<$cantidad)
		{
			if(!$columnas[$i]->getEsPk())
			{
				$vSQL.=$columnas[$i]->getColumna();
				$i++;
				if($i<$cantidad)
					$vSQL.=",";
			}
			else
				$i++;
		}
		$vSQL.=")";
		$vSQL.=" values (";
		$i=0;
		$metodo="";
		while($i<$cantidad)
		{
			if(!$columnas[$i]->getEsPk())
			{
				$metodo=$columnas[$i]->getMetodo();
				if($columnas[$i]->getTipo()=='STRING' || $columnas[$i]->getTipo()=='DATE')
					$vSQL.="'".call_user_func_array(array($xObjeto,"get".$metodo),array(null))."'";
				else
					$vSQL.=call_user_func_array(array($xObjeto,"get".$metodo),array(null));
				$i++;
				if($i<$cantidad)
					$vSQL.=",";
			}
			else
			{
                $i++;
			}
		/*	else
			{
				//$metodo=$columnas[$i]->getTablaBase()->getObtenerMetodoId();
				$metodo=$columnas[$i]->getMetodo();
				//if($columnas[$i]->getTablaBase()=='STRING' || $columnas[$i]->getTipo()=='DATE')
					//$vSQL.="'".call_user_func_array(array($xObjeto,"get".$metodo),array(null))."'";
				//else
				$vSQL.=call_user_func_array(array($xObjeto,"get".$metodo),array(null));
				$i++;
				if($i<$cantidad)
					$vSQL.=",";
			}*/
		}
		$vSQL.=")";
		Sql::ejecutar($vSQL);
	}
	
	public function eliminar($xObjeto)
	{
		$vSQL="";
		$vSQL=$this->delete;
		$vSQL.=" where ".$this->tabla->getObtenerId()."=".call_user_func_array(array($xObjeto,"get".$this->tabla->getObtenerMetodoId()),array(null));
		Sql::ejecutar($vSQL);
	}
	
	private function getStrSelectInner()
	{
		$vSQL="select ";
		//PRIMERO TODAS LAS COLUMNAS DE LA TABLA PRINCIPAL
		foreach($this->tabla->getColumnasReales() as $columna)
		{
			if(!$columna->getEsFk())
			{
			    $vSQL.=$columna->getColumna()." as '".$this->tabla->getDiminutivo().".".$columna->getColumna()."'";
			   // if($i<$cantidad)
			    $vSQL.=",";
			}
		}
		//----------------------------------------------------------------------------------------
		//AHORA LA DE LOS INNER
		$inners=$this->getInners();
		$i=0;
		$j=0;
		$cantidad=count($inners);
		$cantidadColInner=null;
		$tabla=null;
		$vSQLinner="";
		
		while($i<$cantidad)
		{
			$tabla=$inners[$i]->getTablaBase();
			$cantidadColInner=count($tabla->getColumnasReales());
			$vSQLinner.=" inner join ".$tabla->getNombre()." as ".$tabla->getDiminutivo();
			$vSQLinner.=" on ".$tabla->getDiminutivo().".".$inners[$i]->getColumnaFk();
			$vSQLinner.="=".$this->tabla->getDiminutivo().".".$inners[$i]->getColumna();
			while($j<$cantidadColInner)
			{
				$cols=$tabla->getColumnasReales();
				$vSQL.=$cols[$j]->getColumna()." as '".$tabla->getDiminutivo().".".$cols[$j]->getColumna()."'";
				$j++;
				if(($j<$cantidadColInner) && ($i<$cantidad))
					$vSQL.=",";
			}
			$i++;
			$tabla=null;
			$cantidadColInner=null;
			$j=0;
		}
		$vSQL.=" from ".$this->tabla->getNombre()." as ".$this->tabla->getDiminutivo();
		$vSQL.=$vSQLinner;
		//----------------------------------------------------------------------------------------
		return $vSQL;
	}
	
	public function getListarJoinDeUnoaUno($xWhere)
	{
		$vSQL=$this->getStrSelectInner();
		$dato=null;
		if($xWhere!=null && $xWhere!="")
		{
		   $vSQL.=" ".$xWhere;
		   $datos=Sql::consultar($vSQL);
		}
		else
		{
		    $vSQL.=" order by 1 asc";
		    echo $vSQL;
			$datos=Sql::consultar($vSQL);
		}
		$listaFinal=array();
		$inners=getInners();
		if($datos!=null)
		{
			$i=0;
			foreach($datos as $dato)
			{
				$nombreClase=$this->tabla->getClase();
				$res = new $nombreClase();
				foreach($this->tabla->getColumnasReales() as $columna)
				{
					if(!$columna->getEsFk())
					{
						call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$this->tabla->getDiminutivo().".".$columna->getColumna()],$columna->getTablaBase()));
					}
				}
				
				foreach($inners as $inner)
				{
					$nombreClaseInner=$inner->getTablaBase()->getClase();
					$joinClase= new $nombreClaseInner();
					$indice=0;
					if($dato[$inner->getTablaBase()->getDiminutivo().".".$inner->getObtenerId()]!=null 
				    && $dato[$inner->getTablaBase()->getDiminutivo().".".$inner->getTablaBase()->getObtenerId()]!="")
				    {
				    	
				    	foreach($inner->getTablaBase()->getColumnasReales() as $coljoin)
				    	{
				    	   if(!$coljoin->getEsFk())
					       { 
						      call_user_func_array(array($joinClase,"set".$coljoin->getMetodo()),array($dato[$inner->getTablaBase()->getDiminutivo().".".$coljoin->getColumna()]));
					       }
				    	}
				    	call_user_func_array(array($res,"set".$inner->getMetodo()),array($joinClase));
				    }
				}
				$listaFinal[$i]=$res;
				$res=null;
				$i++;
	
			}
			return $listaFinal;
		}
		else
		{
			return null;
		}
	}
	
	public function getListarJoinDeUnoaMuchos($xWhere)
	{
		$vSQL=$this->getStrSelectInner();
		$datos=null;
		if($xWhere!=null && $xWhere!="")
		{
		   $vSQL.=" ".$xWhere;
		   $datos=Sql::consultar($vSQL);
		}
		else
		{
		    $vSQL.=" order by 1 asc";
			$datos=Sql::consultar($vSQL);
		}
		$listaFinal=array();
		$inners=$this->getInners();
		$listaInners=array();
		$listaObjetosIner=array();
		$primero=true;
		$tieneInner=false;
		foreach($inners as $in)
		{
			$listaInners[$in->getTablaBase()->getClase()]=array();
		}
		$res=null;
		$nombreClase=$this->tabla->getClase();
		if($datos!=null)
		{
			$i=0;
			foreach($datos as $dato)
			{
				if($primero || (($res->getId()!=$dato[$this->tabla->getDiminutivo().".".$this->tabla->getObtenerId()])))
				{
					if($primero)
				     {
				     	$primero=false;
				     	$res = new $nombreClase();
				     	foreach($this->tabla->getColumnasReales() as $columna)
				     	{
				     		if(!$columna->getEsFk())
				     		{
				     			call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$this->tabla->getDiminutivo().".".$columna->getColumna()]));
				     		}
				     	}
				     }
				     else 
				     {
				     	foreach($inners as $in)
				     	{
				     	   // echo $res->getId()." contra ".$dato[$this->tabla->getDiminutivo().".".$this->tabla->getObtenerId()]."<br />";
				     		call_user_func_array(array($res,"set".$in->getMetodo()),array($listaInners[$in->getTablaBase()->getClase()]));
				     		$listaInners[$in->getTablaBase()->getClase()]=array();
				     	}
				     	$listaFinal[$i]=$res;
				     	$res=null;
				     	$i++;
				     	$tieneInner=false;
				     	$res = new $nombreClase();
				     	foreach($this->tabla->getColumnasReales() as $columna)
				     	{
				     		if(!$columna->getEsFk())
				     		{
				     			call_user_func_array(array($res,"set".$columna->getMetodo()),array($dato[$this->tabla->getDiminutivo().".".$columna->getColumna()]));
				     		}
				     	}
				     }
				     
				     
				}
				
				foreach($inners as $inner)
				{
					$nombreClaseInner=$inner->getTablaBase()->getClase();
					$joinClase= new $nombreClaseInner();
					$indice=0;
					if($dato[$inner->getTablaBase()->getDiminutivo().".".$inner->getTablaBase()->getObtenerId()]!=null
					&& $dato[$inner->getTablaBase()->getDiminutivo().".".$inner->getTablaBase()->getObtenerId()]!="")
					{
						$tieneInner=true;
						foreach($inner->getTablaBase()->getColumnasReales() as $coljoin)
						{
							if(!$coljoin->getEsFk())
							{
								call_user_func_array(array($joinClase,"set".$coljoin->getMetodo()),array($dato[$inner->getTablaBase()->getDiminutivo().".".$coljoin->getColumna()]));
							}
						}
						
					}
					$listaInners[$inner->getTablaBase()->getClase()][]=$joinClase;
				}
				
	
			}
			if($tieneInner)
			{
				foreach($inners as $in)
				{
					call_user_func_array(array($res,"set".$in->getMetodo()),array($listaInners[$in->getTablaBase()->getClase()]));
				}
				$listaFinal[$i]=$res;
				$res=null;
				$i++;
			}
			return $listaFinal;
		}
		else
		{
			return null;
		}
	}
	
	private function getInners()
	{
		if($this->inners==null)
		{
		    $this->inners=array();
		    $i=0;
			foreach($this->tabla->getColumnas() as $columna)
		    {
			    if($columna->getEsFk())
			    {
			    	$this->inners[$i]=$columna;
			    	$i++;
			    }
		    }
		}
		return $this->inners;
	}
	
	public function updatear($xObjeto)
	{
		$vSQL="";
		$vSQL=$this->update;
		$vSQL.=" set ";
		$cantidad=count($this->tabla->getColumnasReales());
		$columnas=$this->tabla->getColumnasReales();
		$i=0;
		while($i<$cantidad)
		{
			if(!$columnas[$i]->getEsPk())
			{
				$vSQL.=$columnas[$i]->getColumna();
			    $vSQL.="=";
				if($columnas[$i]->getTipo()=='STRING'||$columnas[$i]->getTipo()=='DATE')
				   $vSQL.="'".call_user_func_array(array($xObjeto,"get".$columnas[$i]->getMetodo()),array(null))."'";
			    else
				   $vSQL.=call_user_func_array(array($xObjeto,"get".$columnas[$i]->getMetodo()),array(null));
				   $i++;
			   if($i<$cantidad)
				$vSQL.=",";
			}
			else
			{
                $i++;
			}
		/*	else
			{
				  $vSQL.=call_user_func_array(array($xObjeto,"get".$columnas[$i]->getTablaBase()->getObtenerMetodoId()),array(null));
			}*/
			
		}
		$vSQL.=" where ".$this->tabla->getObtenerId()."=".call_user_func_array(array($xObjeto,"get".$this->tabla->getObtenerMetodoId()),array(null));
		Sql::ejecutar($vSQL);
	}
}
?>