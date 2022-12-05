	var x=$(document);
	x.ready(iniciar);
	
	function iniciar(){
		var x=$(".cargar");
		x.click(muestrame);
	}
	function muestrame(){
		var pagina=$(this).attr("href");
		var x=$("#contenido");
		x.load(pagina);
		return false;
	}
	function soloNumeros(e)
    {
		var keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum == 8) || (keynum == 46))
		return true;
		 
		return /\d/.test(String.fromCharCode(keynum));
    }
	function verifica(){
		var campos = "";
		if($("#correo").val()==""){
			campos+=" No indic&oacute; el correo electr&oacute;nico.<br />";
		}else{
			var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
			if (!(filter.test($("#correo").val()))){
				campos+=" El correo electr&oacute;nico que indic&oacute; no es valido.";
			}
		}
		if($("#psw").val()==""){
			campos+=" No indic&oacute; el password.<br />";
		}
		if($("#nombre").val()==""){
			campos+=" No indic&oacute; el nombre.<br />";
		}
		if(campos!=""){
			$("#avisos").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong>'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function cancelarCrk(){
		window.location.assign("panel.php");
	}
	function crknusr(){
		$("#crkusr").val("1");	
	}
	function limitaTextarea(elEvento, maximoCaracteres, id) {
	  var elemento = document.getElementById(id);
	
	  // Obtener la tecla pulsada 
	  var evento = elEvento || window.event;
	  var codigoCaracter = evento.charCode || evento.keyCode;
	  // Permitir utilizar las teclas con flecha horizontal
	  if(codigoCaracter == 37 || codigoCaracter == 39) {
		return true;
	  }
	
	  // Permitir borrar con la tecla Backspace y con la tecla Supr.
	  if(codigoCaracter == 8 || codigoCaracter == 46) {
		return true;
	  }
	  else if(elemento.value.length >= maximoCaracteres ) {
		return false;
	  }
	  else {
		return true;
	  }
	}
	function verificaCandidato(){
		var campos = "";
		if($("#mail").val()==""){
			campos+=" No indic&oacute; el correo electr&oacute;nico.<br />";
		}else{
			var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
			if (!(filter.test($("#mail").val()))){
				campos+=" El correo electr&oacute;nico que indic&oacute; no es valido.<br />";
			}
		}
		if($("#nombre").val()==""){
			campos+=" No indic&oacute; el nombre.<br />";
		}
		if($("#edad").val()==""){
			campos+=" No indic&oacute; la edad.<br />";
		}
		if($("#dom").val()==""){
			campos+=" No indic&oacute; el domicilio.<br />";
		}
		if($("#seldesExamen").val()==""){
			campos+=" No indic&oacute; el examen.<br />";
		}
		if($("#curp").val()==""){
			campos+=" No indic&oacute; el CURP.<br />";
		}
		if($("#cv").val()!=""){
			var archivo=$("#cv").val();
			var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
			if(extension!=".pdf"){
				campos+="El formato del CV debe ser .pdf<br />";
			}
		}
		if(campos!=""){
			$("#avisos").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaExamen(){
		var campos = "";
		if($("#nombre").val()==""){
			campos+=" No indic&oacute; el nombre.<br />";
		}
		if($("#seldesExamen").val()==""){
			campos+=" No indic&oacute; el examen.<br />";
		}
		if(campos!=""){
			$("#avisosE").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaDelExamen(){
		var campos = "";
		if($("#SelDelExamen").val()==""){
			campos = "Tiene que seleccionar un examen para eliminar.";
		}
		if(campos!=""){
			$("#avisosE").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaDelSeccion(){
		var campos = "";
		if($("#seldesSeccion").val()==""){
			campos = "Tiene que seleccionar una secci&oacute;n para eliminar.";
		}
		if(campos!=""){
			$("#avisosS").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaDelPregunta(){
		var campos = "";
		if($("#seldesPregunta").val()==""){
			campos = "Tiene que seleccionar una pregunta para eliminar.";
		}
		if(campos!=""){
			$("#avisosP").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaSeccionEditar(){
		var campos = "";
		if($("#nombreSE").val()==""){
			campos+=" No indic&oacute; el nombre.<br />";
		}
		if($("#seldesSeccion").val()==""){
			campos+=" No indic&oacute; el examen.<br />";
		}
		if($("#tiempoSE").val()==""){
			campos+=" No indic&oacute; el tiempo de la secci&oacute;n.<br />";
		}
		if($("#tiempoSE").val()<="0"){
			campos+=" El tiempo de la secci&oacute;n no puede ser 0 o menor a 0.<br />";
		}
		if(campos!=""){
			$("#avisosS").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaSeccionAgr(){
		var campos = "";
		if($("#nombreSA").val()==""){
			campos+=" No indic&oacute; el nombre.<br />";
		}
		if($("#seldesExamenS").val()==""){
			campos+=" No indic&oacute; el examen.<br />";
		}
		if($("#tiempoSA").val()==""){
			campos+=" No indic&oacute; el tiempo de la secci&oacute;n.<br />";
		}
		if($("#tiempoSA").val()<="0"){
			campos+=" El tiempo de la secci&oacute;n no puede ser 0 o menor a 0.<br />";
		}
		if(campos!=""){
			$("#avisosS").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaPregunta(){
		var campos = "";
		var dato = $("#pregunta").val();
		$("#pregunta").val($.trim(dato));
		dato = $("#nr1").val();
		$("#nr1").val($.trim(dato));
		dato = $("#nr2").val();
		$("#nr2").val($.trim(dato));
		dato = $("#nr3").val();
		$("#nr3").val($.trim(dato));
		dato = $("#nr4").val();
		$("#nr4").val($.trim(dato));
		
		if($("#seldesSeccionP").val()==""){
			campos+=" No indic&oacute; la secci&oacute;n.<br />";
		}
		if($("#pregunta").val()==""){
			campos+=" No indic&oacute; la pregunta.<br />";
		}
		if($("#respcor").val()==""){
			campos+=" No selecciono la respuesta correcta.<br />";
		}
		if($("#nr1").val()==""){
			campos+=" Falta respuesta 1.<br />";
		}
		if($("#nr2").val()==""){
			campos+=" Falta respuesta 2.<br />";
		}
		if($("#nr3").val()==""){
			campos+=" Falta respuesta 3.<br />";
		}
		if($("#nr4").val()==""){
			campos+=" Falta respuesta 4.<br />";
		}
		if(campos!=""){
			$("#avisosP").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function verificaEntradaExamen(){
		var campos = "";
		var dato = $("#clave_candidatoE").val();
		$("#clave_candidatoE").val($.trim(dato));
		if($("#clave_candidatoE").val()==""){
			campos = "Debe indicar la <b>clave de candidato</b>.";
			$("footer").html('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Error:</strong><br />'+campos+'</p></div>');
			return false;
		}else{
			return true;
		}
	}
	function divToggleCancelar(iddiv){
		$("#"+iddiv).slideToggle("fast");
	}
	function divToggle(iddiv,btnfrm){
		$("#"+iddiv).removeClass("frmsDivsH");
		$("#"+iddiv).addClass("frmsDivs");
		switch(btnfrm){
			case 'ne':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("nueexa.php");
			break;
			case 'ee':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("editexa.php");
			break;
			case 'de':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("delexa.php");
			break;
			case 'ns':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("nuesec.php");
			break;
			case 'es':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("edisec.php");
			break;
			case 'ds':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("delsec.php");
			break;
			case 'np':
				$("#"+iddiv).html("");
				$("#"+iddiv).css("height","300px");
				$("#"+iddiv).load("nuepre.php");
			break;
			case 'ep':
				$("#"+iddiv).html("");
				$("#"+iddiv).css("height","300px");
				$("#"+iddiv).load("edipre.php");
			break;
			case 'dp':
				$("#"+iddiv).html("");
				$("#"+iddiv).load("delpreg.php");
			break;
		}
		$("#"+iddiv).show("clip");
	}
	function revResp(){
		var respuestas = "";
		if($("#r1").is(":checked")){
			respuestas+="R1_";
		}
		if($("#r2").is(":checked")){
			respuestas+="R2_";
		}
		if($("#r3").is(":checked")){
			respuestas+="R3_";
		}
		if($("#r4").is(":checked")){
			respuestas+="R4_";
		}
		if(respuestas!=""){
			respuestas+="F";
			$("#respcor").val(respuestas);
		}
	}
	function limpiarChecks(){
		for(var i=1;i<5;i++){
			$("#r"+i).prop('checked',false);
		}
	}
	function enviarDatos(id,accion,procedencia){
		if(id!="" && accion!=""){
			var datos = "accion="+accion+"&id="+id;
			$.ajax({
				async:true,
					type:"post",
					dataType:"html",
					contentType: "application/x-www-form-urlencoded",
					url:"admin.php",
					data:datos,
					//beforeSend:,
					success:function (data){
							var dato = data.split('-');
							switch(procedencia){
								case 'frmEditExamenes':
									$("#nombre").val(dato[0]);
									$("#des").val(dato[1]);
								break;
								case 'frmEditSeccion':
									$("#nombreS").val(dato[1]);
									$("#tiempoS").val(dato[2]);
									$("#seldesExamenS").val(dato[0]);
									$("#seldesExamenS").trigger("chosen:updated");
								break;
								case 'frmEditSeccionE':
									$("#nombreSE").val(dato[1]);
									$("#tiempoSE").val(dato[2]);
									$("#seldesExamenS").val(dato[0]);
									$("#seldesExamenS").trigger("chosen:updated");
								break;
								case 'frmEditPregunta':
									//alert(datos+" "+data);
									$("#seldesPregunta").html('<option value=""></option>'+data);
									$("#seldesPregunta").trigger("chosen:updated");
								break;
								case 'frmEditPreguntaE':
									limpiarChecks();
									$("#pregunta").val(dato[0]);
									$("#nr1").val(dato[1]);
									$("#nr2").val(dato[2]);
									$("#nr3").val(dato[3]);
									$("#nr4").val(dato[4]);
									var respuestas = dato[5].toLowerCase();
									var checar = respuestas.split('_');
									for(var i=0;i<checar.length;i++){
										$("#"+checar[i]).prop('checked',true);
									}
								break;
								case 'frmRealizados':
									$("#respuesta").val('');
									$("#respuesta").val(data);
								break;
								case 'frmRealizadosDel':
									alert(data);
									$("#contenido").load("realizados.php");
								break;
							}
						},
					timeout:2000,
					error:function(){
						alert("Problemas en el servidor, intente mas tarde.");
					}
				}).then(function(){
					if(procedencia=='frmRealizados'){
						muestraVentana();
					}
				});
		}
	}
	function examinadoDel(id,accion){
		var respuesta = confirm("Se eliminara el candidaro con ID:"+id+"\nSeguro que desea eliminarlo?");
		if(respuesta == true){
			enviarDatos(id,accion,"frmRealizadosDel");
		}
	}
	function muestraVentana(){
		var data = $("#respuesta").val();
		var dato = data.split('_');
		$("#resultados").html(dato[0]);
		$("#resultados").dialog({
			width: 550,
			closeText: "Cerrar",
			dialogClass: "clasedialog",
			close:function(){
				$( this ).dialog( "destroy" );
				$("#resultados").html("");
			},
			buttons: [
				{
					text: "Datos Generales",
					click: function() {
						$("#resultados").html(dato[0]);
					}
				},
				{
					text: "Resultados",
					click: function() {
						$("#resultados").html(dato[1]);
					}
				},
				{
					text: "Currículum Vítae",
					click: function() {
						var direccionPDF = dato[2];
						if(direccionPDF=="0"){
							$("#resultados").html("<center>Sin curr&iacute;culum V&iacute;tae</center>");
						}else{
							$("#resultados").html("<iframe id='visorPDF' width='100%' height='500px'></iframe>");
							$("#visorPDF").attr("src",direccionPDF);
						}
					}
				},
				{
					text: "Exportar PDF",
					click: function() {
						sHTML = "<iframe id='reportePDF' name='reportePDF' width='100%' height='500px'></iframe>" +
								'<form id="frmReporte" action="admin.php" method="post" target="reportePDF" >' +
								'<input type="hidden" name="accion" value="crearReporte" />'+
								'<input type="hidden" name="datosGenerales" value="'+dato[0]+'" />'+
								'<input type="hidden" name="resultados" value="'+dato[1]+'" />'+
								'</form>';
						$("#resultados").html(sHTML);
						$('#frmReporte').submit();
					}
				},
				{
					text: "Cerrar",
					click: function() {
						$( this ).dialog( "destroy" );
						$("#resultados").html("");
					}
				}
			]
			});
	}