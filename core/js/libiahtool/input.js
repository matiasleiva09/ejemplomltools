/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
function Input()
{
	this.label="";
	this.idInput="";
	this.id="";
	this.obligatorio=true;
	this.conDatos=false;
	this.tipo="text";
	this.esDataPicker=false;
	this.dataPickerConHora=false;
	this.tamano=10;
	this.tamanoLabel=2;
	this.activarTamano=false;
	this.validarMail=false;
	this.validarSoloNumero=false;
	this.validarTelefono=false;
	this.activado=true;
	this.construirRapidoDataPicker=
	(
	    function(xLabel,xInput,xId,xObligatorio,conHora,xActivado)
	    {
		   this.label=xLabel;
		   this.idInput=xInput;
		   this.id=xId;
		   this.esDataPicker=true;
		   this.dataPickerConHora=conHora;
		   this.obligatorio=xObligatorio;
		   this.validarSoloNumero=true;
		   this.render();
	    }
	);
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
	this.construirRapidoTexto=
	(
	    function(xLabel,xInput,xId,xObligatorio,xTipo,xValidarMail,xValidarSoloNumero,xValidarTelefono)
		{
			this.label=xLabel;
			this.idInput=xInput;
			this.id=xId;
			this.obligatorio=xObligatorio;
			this.tipo=xTipo;
			this.validarMail=xValidarMail;
			this.validarSoloNumero=xValidarSoloNumero;
			this.validarTelefono=xValidarTelefono;
			this.render();
		}
	);
	this.obtenerValor=
	(
	   function()
	   {
		   if(this.dataPickerConHora)
		   {
			   return $("#"+this.idInput).val() +" " + $("#"+this.idInput + "_hora").val();
		   }
		   else
		   {
		       return $("#"+this.idInput).val();
		   }
	   }
	);
	this.valor=
	(
	  function(xValor)
	   {
		   
		   if($.trim(xValor)!="")
		   {
			   if(this.obligatorio)
			   {
			      $("#group" + this.idInput).removeClass("has-error").addClass("has-success");
			      $("#"+this.id+ '_' + this.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
			   }
			   if(this.dataPickerConHora)
		       {
				   var fechayhora=xValor.split(" ");
				   $("#"+this.idInput).val(fechayhora[0]);
				   $("#"+this.idInput + "_hora").val(fechayhora[1]);
				   $("#"+this.idInput).datepicker('update', xValor);
			   }
			   else
			   {
				    $("#"+this.idInput).val(xValor);
					if(this.esDataPicker)
					  $("#"+this.idInput).datepicker('update', xValor);
			   }
			   this.conDatos=true;
			  
		   }
		   else
		   {
			   if(this.obligatorio)
			   {
			      $("#group" + this.idInput).removeClass("has-success").addClass("has-error");
				  $("#"+this.id+ '_' + this.idInput +"grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
			   }
			   this.conDatos=false;
			   $("#"+this.idInput).val(xValor);
		   }
		   
	   } 
	);
	this.render=
	(
	    function()
	    {
	    	var strHtml="";
	    	strHtml='<div id="group'+ this.idInput+'" class="form-group';
	    	if(this.obligatorio)
	    		strHtml+=' has-error has-feedback';
	    	strHtml+='">';
	    	if(!this.activarTamano)
	    	{
	    		strHtml+='<label for="'+this.idInput+'" control-label">'+ this.label +'</label>';
				if(this.tipo!="textarea")
				{
	    		   
					if(this.dataPickerConHora)
					{
						strHtml+="<div class='row'>";
						strHtml+="<div class='col-lg-8'>";
						strHtml+='<input type="'+this.tipo+'"  class="form-control input-sm" id="'+this.idInput+'" />';
					    strHtml+="</div>";
						strHtml+="<div class='col-lg-4'>";
						strHtml+='<input type="input" class="form-control input-sm" id="'+this.idInput+'_hora" value="00:00:00" />';
						strHtml+="</div>";
						strHtml+="</div>";
					}
					else
					{
						 strHtml+='<input type="'+this.tipo+'" class="form-control input-sm" id="'+this.idInput+'" />';
					}
				}
			    else
				     strHtml+='<textarea class="form-control input-sm" id="'+this.idInput+'" rows="10"></textarea>';
					 
		    	if(this.obligatorio)
		    	     strHtml+='<span class="glyphicon glyphicon-remove form-control-feedback" id="'+this.id+ '_' + this.idInput +'grafic"></span>';	
		    	strHtml+='</div>';
				strHtml+="</div>";
	    	}
	    	else
	    	{
	    		strHtml+='<label for="'+this.idInput+'" class="col-sm-'+this.tamanoLabel+' control-label">'+ this.label +'</label>';
	    		strHtml+='<div class="col-sm-'+this.tamano+'">';
	    		//strHtml+='<input type="'+this.tipo+'" class="form-control" id="'+this.idInput+'">';
				if(this.tipo!="textarea")
				{
	    		    strHtml+='<input type="'+this.tipo+'" disabled class="form-control input-sm" id="'+this.idInput+'" />';
					if(this.dataPickerConHora)
					{
						strHtml+='<input type="time" class="form-control input-sm" id="'+this.idInput+'_hora" />';
					}
				}
			    else
				     strHtml+='<textarea class="form-control input-sm" id="'+this.idInput+'" rows="10"></textarea>';
		    	if(this.obligatorio)
		    	     strHtml+='<span class="glyphicon glyphicon-remove form-control-feedback" id="'+this.id+ '_' + this.idInput +'grafic"></span>';	
		    	strHtml+='</div>';
				strHtml+="</div>";
	    	}
	    	  
	    	
		
	    	
	    	$("#" + this.id).html(strHtml);
			var instancia=this;
			if(this.esDataPicker)
			{
				$("#" + this.idInput).datepicker(
				{
                   dateFormat: "dd/mm/yyyy",
                   language: "es",
				   autoclose:true,
                }
				);
				if(this.dataPickerConHora)
				{
				  $( "#" + this.idInput + "_hora").change
				  (
				     function()
				     {
					       if($(this).val().length > 0)
						   {
							   $("#group" + instancia.idInput).removeClass("has-error").addClass("has-success");
							   $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
							   instancia.conDatos=true;
						   }
						   else
						   {
							   $("#group" + instancia.idInput).removeClass("has-success").addClass("has-error");
							   $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
							   instancia.conDatos=false;
						   }
				      }
				  );
				}
				$( "#" + this.idInput).change(
				  function()
				  {
					  if($(this).val().length > 0)
						   {
							   $("#group" + instancia.idInput).removeClass("has-error").addClass("has-success");
							   $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
							   instancia.conDatos=true;
						   }
						   else
						   {
							   $("#group" + instancia.idInput).removeClass("has-success").addClass("has-error");
							   $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
							   instancia.conDatos=false;
						   }
				  }
				);
			}
			else
			{
				
			}
			 var instancia = this;
			 if(this.dataPickerConHora)
			 {
				 $("#"+ this.idInput + "_hora").keydown
				(
				    function(e) 
					{
						if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 111, 190]) !== -1 ||
                                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                                    (e.keyCode >= 35 && e.keyCode <= 40)) 
							     {
                                     return;
                                 }
      
                                  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) 
						         {
                                     e.preventDefault();
                                 } 
					}
				);
			 }
				$("#"+ this.idInput).keydown
				(
				    function(e) 
					{
                          if(instancia.esDataPicker)
						  {
							  
                              e.preventDefault(); 
						  }
						  else
						  {
						      if(instancia.validarSoloNumero)
						      {   
							     if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                                    (e.keyCode >= 35 && e.keyCode <= 40)) 
							     {
                                     return;
                                 }
      
                                 if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) 
						         {
                                     e.preventDefault();
                                 } 
						      }
							  else if(instancia.validarTelefono)
							  {
								 if ($.inArray(e.keyCode, [56,109,32,57,189,16,46, 8, 9, 27, 13]) !== -1 ||
                                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                                    (e.keyCode >= 35 && e.keyCode < 40)) 
							     {
                                     return;
                                 }
      
                                 if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) 
						         {
                                     e.preventDefault();
                                 } 
							  }
						  }
                    }
				);
			
			if(this.obligatorio)
			{	
				$("#"+this.idInput).keyup(
			    		function(e)
			    		{ 
						   if($(this).val().length > 0)
						   {
							   if(instancia.validarMail)
							   {
								    var expresion=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
									if (expresion.test($(this).val()))
									{
                                        $("#group" + instancia.idInput).removeClass("has-error").addClass("has-success");
							            $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
							            instancia.conDatos=true;
                                    } 
							   }
							   else
							   {
							       $("#group" + instancia.idInput).removeClass("has-error").addClass("has-success");
							       $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
								   instancia.conDatos=true;
							   }
						   }
						   else
						   {
							   $("#group" + instancia.idInput).removeClass("has-success").addClass("has-error");
							   $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
							   instancia.conDatos=false;
						   }
				        }
			    );
	       }
		   else
		   {
			     $("#"+this.idInput).keyup
			    (
			    	function(e)
			    	{ 
			                if(instancia.validarMail)
			                {
				                 var expresion=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
								if (expresion.test($(this).val()))
				                {
                                    $("#group" + instancia.idInput).removeClass("has-error").addClass("has-success");
					                $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
								   
									instancia.conDatos=true;
                                } 
				                else
				                {
					                $("#group" + instancia.idInput).removeClass("has-success").addClass("has-error");
					                $("#"+instancia.id+ '_' + instancia.idInput +"grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
					                instancia.conDatos=false;
				                }
							}
			         }
	           );
		   }
		}
	);  
}