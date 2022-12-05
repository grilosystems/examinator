function nextPregunta(){
		revResp();
		var respcor = $("#respcor").val();
		var np = $("#np").val();
		cargarPregunta("revisa","&np="+np+"&resp="+respcor);
		//Siguiente pregunta
		var npNuevo = parseInt(np) + 1;
		cargarPregunta("next","&np="+npNuevo);
		$("#np").val(npNuevo);
	}
	function pararTm(){
		tmpSeccion.Timer.toggle();
		var tmpFinal = $("#countdown").html();
		$("#tiempoFinal").val(tmpFinal);
	}
	function cargarPregunta(ctrl,np){
		var datos = "control="+ctrl+np;
		$.ajax({
				async:true,
					type:"post",
					dataType:"html",
					contentType: "application/x-www-form-urlencoded",
					url:"cargaExamen.php",
					data:datos,
					//beforeSend:espera,
					success:function (data){
							if(ctrl=="next"){
								siguientePregunta(data);
							}else if(ctrl=="revisa"){
								var rcor = $("#respcorrectas").val();
								var nuevoValor = parseInt(rcor)+parseInt(data);
								$("#respcorrectas").val(nuevoValor);
							}else if(ctrl=="obtenTmp"){
								var mili = parseInt(data)*60;
								$("#obTm").val(mili);
								tmpSeccion.resetCountdown();
								tmpSeccion.Timer.toggle();
							}else if(ctrl=="obtenSec"){
								$("#idseccion").val(data);
							}
						},
					timeout:5000,
					error:function(){
						alert("Problemas en el servidor, intente mas tarde.");
					}
				});
	}
	function siguientePregunta(data){
		if(data!="fin"){
			$("#pregunta").html("<h2>"+data+"</h2>");
		}else{
			$("#pregunta").html("<h2>No hay mas preguntas</h2>");
			$("#controles").html("");
			$("#fin").attr("type","submit");
		}
	}
	function irA(pagina){
		window.location.assign(pagina);
	}
	// Codigo para el Timer
	var tmpSeccion = new (function() {
    var $countdown,
        $form, // Form used to change the countdown time
        incrementTime = 70,
        currentTime = 30000,
        updateTimer = function() {
            $countdown.html(formatTime(currentTime));
            if (currentTime == 0) {
                tmpSeccion.Timer.stop();
                timerComplete();
                tmpSeccion.resetCountdown();
                return;
            }
            currentTime -= incrementTime / 10;
            if (currentTime < 0) currentTime = 0;
        },
        timerComplete = function() {
			var np = $("#np").val();
			var npNuevo = parseInt(np) + 1000;
			$("#np").val(npNuevo);
            nextPregunta();
			$("#tiempoFinal").val("00:00:00");
        },
        init = function() {
            $countdown = $('#countdown');
            tmpSeccion.Timer = $.timer(updateTimer, incrementTime, true);
            $form = $('#tmpSec');
            $form.bind('submit', function() {
                tmpSeccion.resetCountdown();
                return false;
            });
        };
    this.resetCountdown = function() {
        var newTime = parseInt($form.find('input[type=hidden]').val()) * 100;
        if (newTime > 0) {currentTime = newTime;}
        this.Timer.stop().once();
    };
    $(init);
});
	function pad(number, length) {
		var str = '' + number;
		while (str.length < length) {str = '0' + str;}
		return str;
	}
	function formatTime(time) {
		var min = parseInt(time / 6000),
			sec = parseInt(time / 100) - (min * 60),
			hundredths = pad(time - (sec * 100) - (min * 6000), 2);
		return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
	}
	//Bloquear boton atras
	function changeHashOnLoad() {
		window.location.href += "#";
	 	setTimeout("changeHashAgain()", "50"); 
	}
	function changeHashAgain() {
		window.location.href += "1";
	}
	var storedHash = window.location.hash;
	window.setInterval(function () {
    	if (window.location.hash != storedHash) {
        	window.location.hash = storedHash;
    	}
	}, 50);
	//Bloquear refrescar
	document.onkeydown = checkKeycode
    function checkKeycode(e) {
        var keycode;
        if (window.event)
            keycode = window.event.keyCode;
        else if (e)
            keycode = e.which;

        // Mozilla firefox
        if ($.browser.mozilla) {
            if (keycode == 116 ||(e.ctrlKey && keycode == 82)) {
                if (e.preventDefault)
                {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }
        } 
        // IE
        else if ($.browser.msie) {
            if (keycode == 116 || (window.event.ctrlKey && keycode == 82)) {
                window.event.returnValue = false;
                window.event.keyCode = 0;
                window.status = "Refresh is disabled";
            }
        }
    }