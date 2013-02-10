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
        if (level == 3) {
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
}

PSN.updateSchools = function(code){
       
    $.ajax({
    url: PSN.schoolLink,
    dataType : "json",
    data: "code="+code,
    success: function (data) { 
        //alert(code);
            var schools = $("#Person_SchoolID");
            
            if (!$.isEmptyObject(data)) {
                schools.empty();
                //schools.parent().parent().show();
                $.each(data, function(i, val) {    // обрабатываем полученные данные
                    schools.append("<option value='"+i+"'>"+val+"</option>");
                });
            } else {
                schools.empty();
            }
        }
    });
}
PSN.addBenefit = function(obj, url){
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    $("#benefits").load(url,function() {btn.button('reset')});
}
$(document).ready(function(){
    PSN.Init();
});
