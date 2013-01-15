var PSN = PSN || {}; 
PSN.KOATUUChange = function(obj, link, level){
    var id = $(obj," :selected").val();
    $.ajax({
    url: link,
    dataType : "json",
    data: "id="+id+"&level="+level,
    success: function (data) { 
        var koatuu2 = $("#Person_KOATUUCodeL2ID");
        var koatuu3 = $("#Person_KOATUUCodeL3ID");
        //$("#Person_KOATUUCode").val(data.Code);
        //$("#Person_idKOATUU").val(data.id);
        if (level == 3) return;
       
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
        
    } 
    });
}
