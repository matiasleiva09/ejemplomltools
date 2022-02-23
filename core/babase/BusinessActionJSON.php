<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
class BusinessActionJSON
{
	private $resultadoJSON=null;
	
	public function getResultadoJSON()
	{
		if($this->resultadoJSON!=null)
		    return $this->resultadoJSON;
		else
		{
			$json["cantidad"]="0";
		    $json["registros"]=array();
		    $this->resultadoJSON=json_encode($json);
			return $this->resultadoJSON;
		}
	}

	public function setResultadoEstadoJSON($dato)
	{
		$json = array();
	    if($dato)
		  $json["estado"]="ok";
		else
		  $json["estado"]="error";
		  $this->resultadoJSON=json_encode($json);
		  return $this->resultadoJSON;
	}

	public function setResultadoObjetoAJSON($datos)
	{
	   $json = array();
	   $registroFinal = array();
	   $i=0;
	   foreach($datos as $dato)
	   {
		  $registroFinal[$i]=$dato->generarJson();
		  $i++;
	   }
	   $json["cantidad"]=count($datos);
	   $json["registros"]=$registroFinal;
	   $this->resultadoJSON=json_encode($json);
	   
	}

	public function setObjetoResultadoUnicoJSON($datos)
	{
		if($datos!=null)
		{
			$registros=array();
			$registros[]=$datos;
			$json = array();
			$json["cantidad"]="1";
			$json["registros"]=$registros;
			$this->resultadoJSON=json_encode($json);
		}
	}

	public function getMensajeRespuestaJSON($xEstado,$xMensaje)
	{
		$registro=array();
		$registro["estado"]=$xEstado;
		$registro["mensaje"]=$xMensaje;
		$this->resultadoJSON=json_encode($registro);
	}
	
	public function setResultadoJSON($xSQL)
	{
		$datos=Sql::consultar($xSQL);
		$json=array();
		$json["cantidad"]=count($datos);
		$json["registros"]=$datos;
		$this->resultadoJSON=json_encode($json);
	}
	
	public function getEjecutarJSON($xSQL)
	{
		try
		{
           
		}
		catch(Exception $ex)
		{

		}
	}

	protected function accion()
	{

	}

	public function realizar()
	{
		Sql::conectar();
		Sql::beginTransaction();
		$this->accion();
		Sql::commit();
		//$this->desconectar();
	}
}
?>