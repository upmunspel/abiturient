var PSN = PSN || {}; 
PSN.schoolLink = {};
PSN.koatuuLink = {};
PSN.KOATUUCode = "0000000000";
PSN.KOATUUSchoolCode = "0000000000";

PSN.Init = function(){
      $(".datepicker").datepicker({'format':"dd.mm.yyyy"});
      $('#toggle_sameschool').on('switch-change', function (e, data) {
           var status = data.value;
           if (status){
                $("#scholladdr").hide()
                PSN.updateSchools(PSN.KOATUUCode);
            } else {
                $("#scholladdr").show();
                PSN.updateSchools(PSN.KOATUUSchoolCode);
            }
      });
     $('#personSave').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        $.ajax(
        
    
        );
        setTimeout(function() {
            btn.button('reset'); // call the reset function
        }, 3000);
    });
    $('#myModal').on('show', function () {
       
    });
    
    $(".series").keyup(function(){
        var val = $(this).val();
        val = val.toUpperCase();
        $(this).val(val);
    });
    
   
   
}



PSN.KOATUUChange = function(obj, level){
    var id = $(obj," :selected").val();
    $.ajax({
    url: PSN.koatuuLink ,
    dataType : "json",
    data: "id="+id+"&level="+level,
    success: function (data) { 
        var koatuu2 = $("#Person_KOATUUCodeL2ID");
        var koatuu3 = $("#Person_KOATUUCodeL3ID");
        if (level == 3) {
            PSN.KOATUUCode = data.Code;    
            if ($("#sameschooladdr").prop("checked")) PSN.updateSchools(PSN.KOATUUCode);
            return;
        }
       
        if (!$.isEmptyObject(data.Level2)) {
            koatuu2.empty();
            koatuu2.parent().parent().show();
            $.each(data.Level2, function(i, val) {    // обрабатываем полученные данные
                koatuu2.append("<option value='"+i+"'>"+val+"</option>");
            });
        } else {
            if (level == 1){
            koatuu2.empty();
            koatuu2.empty().parent().parent().hide(); 
            }
        }
        if (!$.isEmptyObject(data.Level3)) {
           koatuu3.empty();
           $.each(data.Level3, function(i, val) {    // обрабатываем полученные данные
                    koatuu3.append("<option value='"+i+"'>"+val+"</option>");
           });
           
           koatuu3.parent().parent().show();
        } else {
           koatuu3.empty();
           koatuu3.empty().parent().parent().hide();
        }
        PSN.KOATUUCode = data.Code;
        //alert( PSN.KOATUUCode+ "  "+$("sameschooladdr").prop("checked"));
        if ($("#sameschooladdr").prop("checked")) PSN.updateSchools(PSN.KOATUUCode);
      
    } 
    });
}

PSN.KOATUUSchoolChange = function(obj, level){
    var id = $(obj," :selected").val();
    $.ajax({
    url: PSN.koatuuLink ,
    dataType : "json",
    data: "id="+id+"&level="+level,
    success: function (data) { 
        var koatuu2 = $("#KOATUU2");
        var koatuu3 = $("#KOATUU3");
        if (level === 3) {
            PSN.KOATUUSchoolCode = data.Code;    
            if (!$("#sameschooladdr").prop("checked")) PSN.updateSchools(PSN.KOATUUSchoolCode);    
            return;
        }
       
        if (!$.isEmptyObject(data.Level2)) {
            koatuu2.empty();
            koatuu2.parent().parent().show();
            $.each(data.Level2, function(i, val) {    // обрабатываем полученные данные
                koatuu2.append("<option value='"+i+"'>"+val+"</option>");
            });
        } else {
            if (level == 1){
            koatuu2.empty();
            koatuu2.empty().parent().parent().hide(); 
            }
        }
        if (!$.isEmptyObject(data.Level3)) {
           koatuu3.empty();
           $.each(data.Level3, function(i, val) {    // обрабатываем полученные данные
                    koatuu3.append("<option value='"+i+"'>"+val+"</option>");
           });
           
           koatuu3.parent().parent().show();
        } else {
           koatuu3.empty();
           koatuu3.empty().parent().parent().hide();
        }
        PSN.KOATUUSchoolCode = data.Code;    
        if (!$("#sameschooladdr").prop("checked")) PSN.updateSchools(PSN.KOATUUSchoolCode);    
    } 
    });
};
PSN.updateSchools = function(code){
       
    $.ajax({
    url: PSN.schoolLink,
    dataType : "json",
    data: "code="+code,
    success: function (data) { 
        //alert(code);
            var schools = $("#SchoolID");
            
            if (!$.isEmptyObject(data)) {
                schools.empty();
                //schools.parent().parent().show();
                $.each(data, function(i, val) {    // обрабатываем полученные данные
                    schools.append("<option value='"+i+"'>"+val+"</option>");
                });
                
//                 //$(".combobox-container").remove();
//                  $("#SchoolID").show();
//                 alert();
                 $("#SchoolID").combobox("clearElement");
                 $("#SchoolID").combobox("refresh");
                   $("#SchoolID").combobox("clearElement");
               
            } else {
                schools.empty();
            }
        }
    });
};
/**
 * BENEFITS CODE
 */
PSN.addBenefit = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#benefit-modal-holder").load(url,function() {
        //alert("ok");//
        btn.button('reset');
        $("#benefitModal").modal("show");
    });
 };
PSN.appendBenefit= function(obj, link){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#benefit-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    'type':'POST',
    success: function (data) { 
            
            var obj = jQuery.parseJSON(data);
           
            if (obj.result === "success") {
               $("#benefitModal").modal("hide");
               $("#benefits").html(obj.data);
            } else {
               $("#benefit-modal-body").html(obj.data);  
            }
            btn.button('reset'); 
        }
    });
   
 };
 PSN.editBenefit = function(obj){
    var btn = $(obj);
    //btn.button('loading');
    
    $("#benefit-modal-holder").load($(obj).attr("href"),function() {
        //btn.button('reset');
        $("#benefitModal").modal("show");
    });
    return false;
 };
 PSN.delBenefit = function(obj, link){
 if (confirm("Ви впевнені, що бажаєте видалити документ?")){
     $.ajax({
             'url': link,
             success: function (data) { 
                    var obj = jQuery.parseJSON(data);
                   
                    if (obj.result === "success") {
                        $("#benefits").html(obj.data);
                    } else {
                        alert(obj.data);  
                    }
                 
                }
        });
        
     }
 };




//PSN.addBenefit = function(obj, url){
//    var btn = $(obj);
//    btn.button('loading'); // call the loading function
//    //var data = $("#benefit-form").serialize(); 
//    $("#new-benefit").load(url,function() {
//        btn.button('reset');
//        $("#benefitModal").modal("show");
//    });
// };
//PSN.appendBenefit = function(obj, link){
//    var btn = $(obj);
//    btn.button('loading'); // call the loading function
//    var fdata = $("#benefit-form-modal").serialize(); 
//    $.ajax({
//    'url': link,
//    'data': fdata,
//    success: function (data) { 
//            var obj = jQuery.parseJSON(data);
//            if (obj.result === "success") {
//          
//               $("#benefitModal").modal("hide");
//               $("#benefits").html(obj.data);
//               
//            } else {
//              $("#new-benefit").html(obj.data);  
//            }
//            btn.button('reset'); 
//        }
//    });
//   
// };
//PSN.addBenefitDoc = function(obj, url){
//    var btn = $(obj);
//    btn.button('loading'); // call the loading function
//    var data = $("#benefit-form-modal").serialize(); 
//    $("#new-benefit").load(url,data,function(){ btn.button('reset'); });
//};
//PSN.delBenefitDoc = function(obj, url){
//    var data = $("#benefit-form-modal").serialize(); 
//    $("#new-benefit").load(url,data,function(){});
//};
//PSN.reloadBenefit = function(obj, url){
//    var btn = $(obj);
//    btn.button('loading'); // call the loading function
//    var data = "reload=1";
//    $("#benefits").load(url,data, function() {btn.button('reset');});
//};
//PSN.deleteBenefit = function(obj, url){
//    if (confirm("Ви впевнені, що бажаєте видалити пільгу?")){
//    //$("#benefits").load(url);
//    $.ajax({
//             'url': url,
//             success: function (data) { 
//                    var obj = jQuery.parseJSON(data);
//                    if (obj.result === "success") {
//                        $("#benefits").html(obj.data);
//                    } else {
//                        alert(obj.data);  
//                    }
//                 
//                }
//        });
//    }
//};
/**
 * ZNO CODE
 */
PSN.addZno = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#new-zno").load(url,function() {
        btn.button('reset');
        $("#znoModal").modal("show");
      
        
    });
 };

PSN.appendZno= function(obj, link){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#zno-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    
    success: function (data) { 
            var obj = jQuery.parseJSON(data);
            if (obj.result === "success") {
          
               $("#znoModal").modal("hide");
               $("#znos").html(obj.data);
               
            } else {
               $("#zno-modal-body").html(obj.data);  
            }
            btn.button('reset'); 
        }
    });
   
 };
PSN.deleteZno= function(obj, url){
     if (confirm("Ви впевнені, що бажаєте видалити сертивікат ЗНО?")){
         $.ajax({
             'url': url,
             success: function (data) { 
                    var obj = jQuery.parseJSON(data);
                   
                    if (obj.result === "success") {
                        $("#znos").html(obj.data);
                    } else {
                        alert(obj.data);  
                    }
                 
                }
        });
        
     }
};
PSN.addZnoSubject = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var data = $("#zno-form-modal").serialize(); 
    $("#zno-modal-body").load(url, data, function(){ btn.button('reset'); });
};
PSN.delZnoSubject = function(obj, url){
    //var data = $("#zno-form-modal").serialize(); 
    //$("#new-zno").load(url,data,function(){});
    $(obj).parent().parent().parent().hide().find(".deleted").val(1);
};
PSN.editZno = function(obj, url){
     var btn = $(obj);
    $("#new-zno").load(url,function(){
       // btn.button('reset');
        $("#znoModal").modal("show");
      
    });
};
/**
 *  Doc code
 */
PSN.addDoc = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#doc-modal-holder").load(url,function() {
        //alert("ok");//
        btn.button('reset');
        $("#docModal").modal("show");
    });
 };
PSN.appendDoc= function(obj, link){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#doc-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    'type':'POST',
    success: function (data) { 
            //alert(data);
            var obj = jQuery.parseJSON(data);
            //alert(obj.result);
            if (obj.result === "success") {
               $("#docModal").modal("hide");
               $("#docs").html(obj.data);
            } else {
               $("#doc-modal-body").html(obj.data);  
            }
            btn.button('reset'); 
        }
    });
   
 };
 PSN.editDoc = function(obj){
    var btn = $(obj);
    //btn.button('loading');
    
    $("#doc-modal-holder").load($(obj).attr("href"),function() {
        //btn.button('reset');
        $("#docModal").modal("show");
    });
    return false;
 };
 PSN.delDoc = function(obj){
 if (confirm("Ви впевнені, що бажаєте видалити документ?")){
     $.ajax({
             'url': $(obj).attr("href"),
             success: function (data) { 
                    var obj = jQuery.parseJSON(data);
                   
                    if (obj.result === "success") {
                        $("#docs").html(obj.data);
                    } else {
                        alert(obj.data);  
                    }
                 
                }
        });
        
     }
 };
 
/**
 * SPEC CODE
 */
PSN.addSpec = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#spec-modal-holder").load(url,function() {
        //alert("ok");//
        btn.button('reset');
        $("#specModal").modal("show");
    });
 };
PSN.onFacChange = function(obj, id , url){
    var fid = $(obj," :selected").val();
    data = "idFacultet="+fid;
    $(id).load(url, data);
 };
PSN.appendSpec= function(obj, link){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#spec-form-modal").serialize(); 
    $.ajax({
    'url': link,
    'data': fdata,
    success: function (data) { 
            //alert(data);
            var obj = jQuery.parseJSON(data);
            //alert(obj.result);
            if (obj.result === "success") {
               $("#specModal").modal("hide");
               $("#specs").html(obj.data);
            } else {
               $("#spec-modal-body").html(obj.data);  
            }
            btn.button('reset'); 
        }
    });
   
 };
 PSN.delSpec = function(obj){
 var link = $(obj).attr("href");
 if (confirm("Ви впевнені, що бажаєте видалити спеціальність?")){
     $.ajax({
             'url': link,
             success: function (data) { 
                    var obj = jQuery.parseJSON(data);
                   
                    if (obj.result === "success") {
                        $("#specs").html(obj.data);
                    } else {
                        alert(obj.data);  
                    }
                 
                }
        });
        
     }
 };
 PSN.editSpec = function(obj){
    var link = $(obj).attr("href");
    var btn = $(obj);
    //btn.button('loading');
    $("#spec-modal-holder").load(link,function() {
        //btn.button('reset');
        $("#specModal").modal("show");
    });
 };
/**
* EntranceType Change
*/
 PSN.changeEntranceType = function(obj){
    var EntranceType =  parseInt($(obj,":selected").val());
    switch (EntranceType) {
        case 1:
           $(".examsujects select :first").attr("selected","selected");
           $(".examsujects input").val("").attr("disabled","disabled");
           $(".examsujects select").val("").attr("disabled","disabled");
           $(".znosubjects select").removeAttr('disabled');
           $(".causality").attr("disabled","disabled");
           $(".causality [value='']").attr("selected", "selected");
          
        break;
        case 2:
           
           $(".znosubjects select").attr("disabled","disabled");
           $(".znosubjects select :selected").removeAttr("selected", "");
           $(".znosubjects select [value='']").attr("selected", "selected");
           $(".examsujects input").removeAttr('disabled');
           $(".examsujects select").removeAttr('disabled');
           $(".causality :first").attr("selected","selected");
           $(".causality").removeAttr('disabled');
           $(".causality select [value='']").attr("selected", "selected");
          
        break;
      
        default:
           
           $(".znosubjects select").removeAttr('disabled');
           $(".examsujects input").removeAttr('disabled');
           $(".examsujects select").removeAttr('disabled');
           $(".causality").removeAttr('disabled');
           $(".causality [value='']").attr("selected", "selected");
        
        
    }
 }
 /**
  * Sepciality change
  */
 PSN.changeSpeciality = function(obj, url){
     var Sepciality = $(obj,"selected").val();
     var data = "specialityid="+Sepciality;
     $("#subjects-holder").load(url,data);
     
 }
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
 PSN.changeFIO = function(){

    $("#FirstName").keyup(function(){
        var FirstName = $("#FirstName").val();
          FirstName = FirstName.capitalize();
        $("#FirstName").val(FirstName);
        $("#FirstNameR").val(FirstName);
    });
    $("#LastName").keyup(function(){
        var LastName = $("#LastName").val();
        LastName = LastName.capitalize();
        $("#LastName").val(LastName);
        $("#LastNameR").val(LastName);
    });
    $("#MiddleName").keyup(function(){
        var MiddleName = $("#MiddleName").val();
        MiddleName = MiddleName.capitalize();
        $("#MiddleName").val(MiddleName);
        $("#MiddleNameR").val(MiddleName);
    });
 }
$(document).ready(function(){
    PSN.Init();
    PSN.changeFIO();
});
