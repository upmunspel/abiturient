/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var PRC = PRC || {}; 
PRC.editStudprice = function(obj){
    var link = $(obj).attr("href");
    var btn = $(obj);
    $("#studprice-modal-holder").load(link,function() {
        $("#studpriceModal").modal("show");
    });
 };
PRC.editStudpric = function(obj, url){
     var btn = $(obj);
     //url = url + btn.val(); 
    $("#studprice-modal-holder").load(url,function(){
       // btn.button('reset');
        $("#studpriceModal").modal("show");
      
    });
};
PRC.appendStudprice= function(obj, link){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#person-form").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    'type':'POST',
    success: function (data) { 
            //alert(data);
            var obj = jQuery.parseJSON(data);
            //alert(obj.result);
            if (obj.result === "success") {
               $("#studpriceModal").modal("hide");
               $("#studprices").html(obj.data);
            } else {
               $("#studprice-modal-body").html(obj.data);  
            }
            btn.button('reset'); 
        }
    });
   
 };
PRC.onPriceChange = function(obj, id , url){
    var fid = $("#idPrices :selected").val();
    var formid = $("#Personspeciality_EducationFormID :selected").val();
    
    data = "idFacultet="+fid+"&idEducationForm="+formid;
    $(id).load(url, data);
 };
PRC.changePrice = function(obj, link){ 
   var fdata = $("#price-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    'type':'POST',
    success: function (data) { 
            $("#subjects-holder").html(data);
        }
    });   
 };
PRC.onFacChanges = function(obj, id , url){
    var fid = $("#idFacultet :selected").val();
    var formid = $("#idEducationForm :selected").val();
    var mid= $("#QualificationID :selected").val();
    data = "idFacultet="+fid+"&idEducationForm="+formid+"&QualificationID="+mid;
    alert(data);
    $(id).load(url, data);
 };
  PRC.changeSpeciality = function(obj, link){
     
   var fdata = $("#spec-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    'type':'POST',
    success: function (data) { 
            $("#subjects-holder").html(data);
        }
    });
     
 }