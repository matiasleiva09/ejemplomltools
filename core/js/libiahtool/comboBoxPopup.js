/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
function ComboBoxPopup()
{
	this.id = "";
	this.label = "";
	this.idInput = "";
	this.parametros = "";
	this.pagina = "";
	this.obligatorio = false;
	this.request = null;
	this.mostrarSoloValor=false;
	this.datos = new Array();
		this.obtenerValor = (function()
	{
		return $("#" + this.idInput).val();
	});
	
	this.obtenerId = (function()
	{
		var res =  $("#" + this.idInput).val();
		if(!this.mostrarSoloValor)
		{		
		   return $.trim(res.split("-")[0]);
		}
		else
		{
			return res;
		}
		
	});

	this.construirRapido=
	(
		function(xLabel,xId,xIdInput,xParametros,xPagina,xObligatorio,xMostrarSoloValor)
		{
			this.id=xId;
			this.label=xLabel;
			this.idInput=xIdInput;
			this.parametros=xParametros;
			this.pagina=xPagina;
			this.obligatorio=xObligatorio;
			this.mostrarSoloValor=xMostrarSoloValor;
			this.render();
		}
	);
	
	
	this.pasarEstadoOk = (function()
	{
		$("#group" + this.idInput).removeClass("has-error").addClass("has-success");
		$("#" + this.id + '_' + this.idInput + "grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
		this.seleccionado = true;
	});
	this.pasarEstadoError = (function()
	{
		$("#group" + this.idInput).removeClass("has-success").addClass("has-error");
		$("#" + this.id + '_' + this.idInput + "grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
		this.seleccionado = false;
	});
	this.valor = (function(xValor)
	{
		if (this.obligatorio)
		{
			if ((!this.mostrarVacio && $.trim(xValor) != "") || (this.mostrarVacio && this.textoVacio != $.trim(xValor) && $.trim(xValor) != ""))
			{
				var encontrado=false;
				var i=0;
				while(i<this.datos.length && !encontrado)
				{
					if($.trim(this.datos[i].split("-")[0])==xValor)
					{
					  encontrado=true;
					  $("#" + this.idInput).val(this.datos[i]);
					}
					i++;
				}
				if(encontrado)
				    this.pasarEstadoOk();
			}
			else
			{
				this.pasarEstadoError();
			}
		}
		else
		{
			var encontrado=false;
			var i=0;
			while(i<this.datos.length && !encontrado)
			{
				if(this.datos[i].split("-")[0]==xValor)
				{
					encontrado=true;
					$("#" + this.idInput).val(this.datos[i]);
				}
			    i++;
			}
		}
		
	});
	this.desactivar=
	(
	   function()
	   {
		   document.getElementById(this.idInput).disabled = true;
	   }
	);
	this.activar=
	(
	   function()
	   {
		    document.getElementById(this.idInput).disabled = false;
	   }
	);
	this.render = (function()
	{
		var instancia = this;
		var sourceUrl = "";
		if (this.parametros != "")
		{
			sourceUrl = this.pagina + "&" + this.parametros;
		}
		else
		{
			sourceUrl = this.pagina;
		}
		this.request = $.ajax(
		{
			type : "POST",
			async : false,
			url : this.pagina,
			data : this.parametros,
			dataType : "json",
		});
		this.request.done(function(data)
		{
			var datostemp = data["registros"];
			var strhtml = "";
			if (datostemp.length > 0)
			{
				for (var i = 0; i < datostemp.length; i++)
				{
					if(!instancia.mostrarSoloValor)
					   instancia.datos[i] = datostemp[i]["iditem"] + " - " + datostemp[i]["valor"];
					else
					    instancia.datos[i] = datostemp[i]["valor"]; 
				}
				if(datostemp.length == 1 && instancia.obligatorio)
				{
					 instancia.pasarEstadoOk();
				}
				  
			}
			else
			{
				
			}
		});
		this.request.error(function(XMLHttpRequest, textStatus, errorThrown)
		{
			
		});
		
		var strHtml = "";
		
	    	strHtml='<div id="group'+ this.idInput+'" class="form-group';
	    	if(this.obligatorio)
	    		strHtml+=' has-error has-feedback';
	    	strHtml+='">';
			
			strHtml+='<label for="'+this.idInput+'" control-label">'+ this.label +'</label>';
			strHtml+='<input type="text" data-provide="typeahead"  class="typeahead form-control input-sm" id="'+this.idInput+'" />';
		    	if(this.obligatorio)
		    	     strHtml+='<span class="glyphicon glyphicon-remove form-control-feedback" id="'+this.id+ '_' + this.idInput +'grafic"></span>';	
		    	strHtml+='</div>';
				strHtml+="</div>";
		
			
		
		
		$('#' + this.id).html(strHtml);
		
		var arabicPhrases = new Bloodhound(
		{
			datumTokenizer : Bloodhound.tokenizers.whitespace,
			queryTokenizer : Bloodhound.tokenizers.whitespace,
			local : instancia.datos
		});
		$('#' + this.idInput).typeahead(
		{
			hint : true,
			highlight : true
		},
		{
			source : arabicPhrases
		});
		
		$("#" + this.idInput).change(function()
		{
	
			//if ((instancia.obtenerValor() != instancia.textoVacio) && (instancia.obtenerValor() != ""))
			if($(this).val().length > 0)
			{
				instancia.pasarEstadoOk();
			}
			else
			{
				instancia.pasarEstadoError();
			}
		});
		$("#" + this.idInput).click(function()
		{
	
		//	if ((instancia.obtenerValor() != instancia.textoVacio) && (instancia.obtenerValor() != ""))
		    if($(this).val().length > 0)
			{
				instancia.pasarEstadoOk();
			}
			else
			{
				instancia.pasarEstadoError();
			}
		});
	});
}