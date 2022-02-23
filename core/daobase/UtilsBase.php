<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
abstract class UtilsBase
{
	public static function getArmarTabla($pathArchivoJson)
	{
		$tabla = new TablaBase();
		$strDatosJson = file_get_contents($pathArchivoJson);
		$json = json_decode($strDatosJson,true);
		if($json!=null)
		{
			$tabla->setClase($json["clase"]);
			$tabla->setNombre($json["tabla"]);
			$tabla->setDiminutivo($json["diminutivo"]);
			$columnas =array();
			$i=0;
			foreach($json["columnas"] as $columna)
			{
			    $columnas[$i] = new ColumnaBase();
			    $columnas[$i]->setColumna($columna["columna"]);
				if($columna["anonima"]=="true")
				   $columnas[$i]->setColumnaAnonima(true);
				else
				   $columnas[$i]->setColumnaAnonima(false); 
			    if($columna["pk"]=="true")
			       $columnas[$i]->setEsPk(true);
			    else 
			       $columnas[$i]->setEsPk(false);
			    $columnas[$i]->setMetodo($columna["metodo"]);
			    $columnas[$i]->setTipo($columna["tipo"]);
			    if($columna["fk"]=="true")
			    {
			    	$columnas[$i]->setEsFk(true);
			    	$columnas[$i]->setColumnaFk($columna["columnafk"]);
			    	$columnas[$i]->setTablaBase(self::getArmarTabla($columna["tablafk"]));
			    }
			    $i++;
			}
			$tabla->setColumnas($columnas);
		}
		return $tabla;
	}
}