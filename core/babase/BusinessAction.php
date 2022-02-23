<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
class BusinessAction
{
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