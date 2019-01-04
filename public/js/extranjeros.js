$(document).ready(function(){
   var valor = $("#nacionalidad").val();
   if(valor == 'E'){
      $(".CURP").css("display", "none");
      $("#curp_alumno").val("XAXX010101MDFXXX01");
      $("#lugar_nac").css("display", "none");
      $(".typeahead").css("display", "block");
   }else{
      $(".CURP").css("display", "block");
      $("#curp_alumno").val("");
      $("#lugar_nac").css("display", "block");
      $(".typeahead").css("display", "none");
   }
   $("#nacionalidad").click(function(evento){
      var nac = $(this).val();
      if(nac == 'E'){
         $(".CURP").css("display", "none");
         $("#curp_alumno").val("XAXX010101MDFXXX01");
         $("#lugar_nac").css("display", "none");
         $(".typeahead").css("display", "block");
      }else{
         $(".CURP").css("display", "block");
         $("#curp_alumno").val("");
         $("#lugar_nac").css("display", "block");
         $(".typeahead").css("display", "none");
      }
   });
});
