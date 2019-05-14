$(document).ready(function(){
	var d=new Date();
	var val =Math.random().toLocaleString().substring(2,6);
	$('#referenceCode').val(d.getYear()+""+d.getMonth()+""+d.getDate()+""+d.getHours()+""+d.getMinutes()+"-"+val);
	enviar_peticion();
	




	$("#txt_impuesto").change(function(e){
		cal_impuesto(this.value);
	});

	$("#txt_monto").change(function(e){
		$("#spinner").show();
		$("#btnPagar").attr('disabled',true);	
		cal_impuesto($("#txt_impuesto").val());
		
		enviar_peticion();
		

			
	});



});
function enviar_peticion(){
	var data=$("#formPago").serializarFormulario();


		$.ajax({
              type: "POST",
              url: "controlador/controlador.php",
              data: data,
              dataType: "json",
              success: function(rs){
                $("#spinner").hide();	
                $("#btnPagar").attr('disabled',false);	
                console.log(rs);
                $("#txt_signature").val(rs.hash);

              },
              error:function(rs){
                
              },
              
        });
}


   //funcion que extiende Js y serializa un formulario
  $.fn.serializarFormulario = function()
      {
      var o = {};
      console.log(this);

      if(this[0]!=undefined){
        var elementos=this[0].elements;
        for(var e in elementos){
          console.log(elementos[e].required);
          if(elementos[e].required==true && elementos[e].value ==""){
            elementos[e].style.borderColor="blue";
            return false;
          }else if(elementos[e].required!=undefined){
            elementos[e].style.borderColor="";
          }
        }

        var a = this.serializeArray();

        $.each(a, function() {


           if (o[this.name]) {


               if (!o[this.name].push) {
                   o[this.name] = [o[this.name]];
               }
                console.log(this.name);

               o[this.name].push(this.value || '');
           } else {

                o[this.name] = this.value || '';

           }


        });
        return o;
      }else{
        return false;
      }
  };
function cal_impuesto(e){
	if(e > 0){
		$("#txt_retorno_base").val($("#txt_monto").val()-($("#txt_monto").val()*e/100));	
	}else{
		$("#txt_retorno_base").val(0);
	}
	
}