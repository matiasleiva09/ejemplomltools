/*
 *  CONTIENE LOS SCRIPT PARA
 *  REALIZAR LAS LLAMADAS POR AJAX
 *  matias leiva
 */
/*
 * tener en cuenta a la hora de pasar el tipo de datos
 * el error SyntaxError: Unexpected token <, el mismo sucede cuando
 * estas recibiendo un json puro, si se recibe un json directamente poner xml
 */
function Ajax()
{
	this.request = null;
	this.asincronico = true;
	this.metodo = "POST";
	this.pagina = "";
	this.parametros = "";
	this.id = "";
	this.serializable = false;
	this.arraySerializable = null;
	this.tipoDeDatos = "html";
	this.resultado = null;
	this.parametrosForm=null;

	this.cargarEnDiv = (function()
	{
		var div = $("#" + this.id);
		div.html("<center><img src='libiahtool/images/cargando.gif' height='25px' width='25px' /></center>");
		this.request = $.ajax(
		{
			type : this.metodo,
			url : this.pagina,
			data : this.parametros,
			dataType : this.tipoDeDatos
		});
		this.request.done(function(data)
		{
			div.html(data);
		});
		this.request.fail(function(jqXHR, textStatus)
		{
			div.html(textStatus);
		});
		// this.request.always
		// (
		// function()
		// {
		// 	            	 
		// }
		// );
	});

	this.obtenerDatos = (function()
	{
		var resultado = null;
		this.request = $.ajax(
		{
			async : this.asincronico,
			type : this.metodo,
			url : this.pagina,
			data : this.parametros,
			dataType : this.tipoDeDatos,
		});
		this.request.done(function(data)
		{
			resultado = data;
		});
		this.request.error(function(XMLHttpRequest, textStatus, errorThrown)
		{
			resultado = errorThrown;
		});
		return resultado;
	});

	this.obtenerDatosUpload=
	(
		function()
        {
		    
		var resultado = null;
		this.request = $.ajax(
		{
			async : this.asincronico,
			type : this.metodo,
			url : this.pagina,
			data : this.parametrosForm,
			dataType : this.tipoDeDatos,
            contentType: false,
            processData: false
		});
		this.request.done(function(data)
		{
			resultado = data;
		});
		this.request.error(function(XMLHttpRequest, textStatus, errorThrown)
		{
			resultado = errorThrown;
		});
		return resultado;
		}
	);

};

// REALIZAMOS AJAX VIA GET
