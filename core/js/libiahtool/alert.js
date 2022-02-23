// JavaScript Document
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
function Alert(xId)
{
    this.id=xId;
	this.tipo="";
	this.titulo="";
	this.descripcion="";
	this.show=
	(
		function(xTipo,xTitulo,xDescripcion)
		{
			this.tipo=xTipo;
			this.titulo=xTitulo;
			this.descripcion=xDescripcion;
			this.render();
		}
	);
	this.render=
	(
	    function()
		{
			var strHtml="";
			var classAlerta="";
			if(this.tipo=="OK")
			   classAlerta="alert alert-success";
			else if(this.tipo=="INFO")
			   classAlerta="alert alert-info";
		    else if(this.tipo=='ERROR')
			   classAlerta="alert alert-danger";
			strHtml='<div class="'+classAlerta+'">';
			strHtml+="<strong>"+this.titulo+"</strong>&nbsp;";
			strHtml+=this.descripcion;
			strHtml+="</div>";
			$("#"+this.id).html(strHtml);  
			var id=this.id;
			window.setTimeout
			(
			    function () 
				{ 
                   $("#"+id).html("");              
                }
			, 3000);     
		}
	);
};