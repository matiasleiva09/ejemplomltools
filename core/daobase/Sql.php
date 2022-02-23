<?php
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
abstract class Sql
{
	private static $coneccion;
	private static $host="localhost";
	private static $usuario="test";
	private static $contrasena="1234";
	private static $bd="tienda";
	private static $driver="mysql";
	private static $comenzoTran=false;
	
	//no creo que este bien pero bueno
	private static function getIniciarParametros()
	{
		/*$array_ini=parse_ini_file(getenv('LIBIA_TOOL')."\\libiahtool.ini");
		self::$host=trim($array_ini["host-db"]);
		self::$usuario=trim($array_ini["usuario-db"]);
		self::$contrasena=trim($array_ini["contrasena-db"]);
		self::$bd=trim($array_ini["base-db"]);
		self::$driver=trim($array_ini["driver-db"]);
		$array_ini=null;*/
	}
	public static function conectar()
	{
		//le inicio los parametros que vienen del ini
		self::getIniciarParametros();
		if(!self::$coneccion instanceof PDO)
		{
			try
			{
				self::$coneccion=new PDO(self::$driver.":host=".self::$host.";dbname=".self::$bd,self::$usuario,self::$contrasena,array(PDO::ATTR_PERSISTENT=>true,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				//self::$coneccion->exec("set names utf8");
				
			}
			catch(PDOException $e)
			{
				print "Error!: no se pudo conectar a la base de datos <br/>".$e;
				die();
			}
		}
	}
	public static function beginTransaction()
	{
		self::$coneccion->beginTransaction();
		self::$comenzoTran=true;
	}
	public static function commit()
	{
		self::$coneccion->commit();
		self::$comenzoTran=false;
	}
	// DESCONECTAR ES OBSOLETA APARTIR DE LA VERSION PHP 5.5.0 CUANDO TERMINA DE EJECUTAR EL SCRIPT CIERRA AUTOMATICAMENTE
	// LA CONEXION
	// DEL MANUAL: Normalmente no es necesario usar a mysql_close(),
	// ya que los enlaces abiertos no persistentes son autom�ticamente cerrados al final de la ejecuci�n del script
	// para que queres una sesion persistida si anulas la conexion?
	private static function desconectar()
	{
		// mysql_close($this->coneccion);
		self::$coneccion=null;
	}
	private static function enTransaccion()
	{
		return self::$comenzoTran;
	}
	public static function rollback()
	{
		self::$coneccion->rollBack();
		self::$comenzoTran=false;
	}
	public static function ejecutar($xSql)
	{
		if(self::enTransaccion())
		{
			$resultado=self::$coneccion->exec($xSql); // or die('La consulta fallo');DESDE AFUERA LOCO
		}
		else
		{
			echo "Error, necesita una transaccion";
		}
		return $resultado;
	}
	
	public static function ejecutarParametros($xSQL,$xParametros)
	{
		$resultadoCon=0;
		if(self::enTransaccion())
		{
			try
			{
				$prepare=self::$coneccion->prepare($xSQL);
				$resultadoCon=$prepare->execute($xParametros);
			}
			catch(PDOException $ex)
			{
				print "Error!: No se puede ejecutar la consulta <br/>".$e;
				die();
			}
		
		}
		else
		{
			echo "Error, necesita una transaccion";
		}
		return $resultadoCon;
	}

	public static function encontrar($xSQL)
	{
		if(self::enTransaccion())
		{
			$resultadoCon=self::$coneccion->query($xSQL);
			$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			echo "Error, necesita una transaccion";
		}
		return $resConsulta;
	}
	public static function encontrarParametros($xSQL,$xParametros)
	{
		if(self::enTransaccion())
		{
			$prepare=self::$coneccion->prepare($xSQL,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
			$resultadoCon=$prepare->execute($xParametros);
			$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			echo "Error, necesita una transacci�n";
		}
		return $resConsulta;
	}
	public static function consultar($xSQL="")
	{
		if(self::enTransaccion())
		{
			$resultadoCon=self::$coneccion->query($xSQL);
			$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
			$res=Array();
			$i=0;
			while($resConsulta)
			{
				$res[$i]=$resConsulta;
				$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
				$i++;
			}
			return $res;
		}
		else
		{
			echo "Error, necesita una transacci�n";
		}
	}

	public static function consultarParametros($xSQL,$xParametros)
	{
		if(self::enTransaccion())
		{
			$prepare=self::$coneccion->prepare($xSQL,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
			$resultadoCon=$prepare->execute($xParametros);
			$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
			$res=Array();
			$i=0;
			while($resConsulta)
			{
				$res[$i]=$resConsulta;
				$resConsulta=$resultadoCon->fetch(PDO::FETCH_ASSOC);
				$i++;
			}
			return $res;
		}
		else
		{
			echo "Error, necesita una transaccion";
		}
	}
}
?>
