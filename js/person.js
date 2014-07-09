var PSN = PSN || {};

PSN.Init = function() {
    $(".datepicker").datepicker({'format': "dd.mm.yyyy"});
    $('#toggle_sameschool').on('switch-change', function(e, data) {
        var status = data.value;
        if (status) {
            $("#scholladdr").hide()
            PSN.updateSchools(PSN.KOATUUCode, 4);
        } else {
            $("#scholladdr").show();
            PSN.updateSchools(PSN.KOATUUSchoolCode, 2);
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
    $('#myModal').on('show', function() {

    });

    $(".series").keyup(function() {
        var val = $(this).val();
        val = val.toUpperCase();
        $(this).val(val);
    });



}
PSN.copySchool = function() {
    var key = parseInt($("#Person_SchoolID").val());
    if (key > 0) {
        $("#Documents_entrantdoc_Issued").val($("#s2id_Person_SchoolID .select2-chosen").text());
    }
}
PSN.printSpec = function(obj) {
//    var url = $(obj).attr("href");
//    //alert(parseInt(url));
//    if (!isNaN(parseInt(url))) {
//        $(obj).attr("href",url+"&iframe=true&width=1024&height=450");
//    }
}
PSN.updatePersonPhote = function(obj, link) {
    var btn = $(obj);
    $.ajax({
        'url': link,
        'type': 'POST',
        success: function(data) {
            $("#person-photo").html(data);
            btn.button('reset');


        }
    });
}

PSN.reloadPersonPhote = function(obj, link) {
    var btn = $(obj);
    $.ajax({
        'url': link,
        'type': 'POST',
        success: function(data) {
            var obj = jQuery.parseJSON(data);

            if (obj.result === "SUCCESS") {
                $("#existing-photo").attr("src", obj.data + "?timestamp=" + new Date().getTime());
                btn.button('reset');
            } else {
                btn.button('reset');
                alert(obj.data);
            }

        }
    });
}



/**
 * BENEFITS CODE
 */
PSN.addBenefit = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#benefit-modal-holder").load(url, function() {
        //alert("ok");//
        btn.button('reset');
        $("#benefitModal").modal("show");
    });
};
PSN.appendBenefit = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#benefit-form-modal").serialize();
    $.ajax({
        'url': link,
        'data': fdata,
        'type': 'POST',
        success: function(data) {
            //alert(data);
            var obj = jQuery.parseJSON(data);

            if (obj.result === "success") {
                $("#benefitModal").modal("hide");
                $("#benefits").html(obj.data);
            } else {
                $("#benefit-modal-body").html(obj.data);
            }

            btn.button('reset');
            refreshBenefits();
            //alert("ParseOK");
        }
    });

};
PSN.editBenefit = function(obj) {
    var btn = $(obj);
    //btn.button('loading');

    $("#benefit-modal-holder").load($(obj).attr("href"), function() {
        //btn.button('reset');
        $("#benefitModal").modal("show");
    });
    return false;
};
PSN.delBenefit = function(obj, link) {
    if (confirm("Ви впевнені, що бажаєте видалити документ?")) {
        $.ajax({
            'url': link,
            success: function(data) {
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



/**
 * ZNO CODE
 */
PSN.addZno = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#new-zno").load(url, function() {
        btn.button('reset');
        $("#znoModal").modal("show");


    });
};

PSN.appendZno = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#zno-form-modal").serialize();
    if (fdata == "") {
        $("#znoModal").modal("hide");
        return;
    }
    $.ajax({
        'url': link,
        'data': fdata,
        success: function(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.result === "success") {

                $("#znoModal").modal("hide");
                $("#znos").html(obj.data);

            } else {
                $("#zno-modal-body").html(obj.data);
            }
            btn.button('reset');
            refreshDocuments();
        }
    });

};
PSN.deleteZno = function(obj, url) {
    if (confirm("Ви впевнені, що бажаєте видалити сертивікат ЗНО?")) {
        $.ajax({
            'url': url,
            success: function(data) {
                var obj = jQuery.parseJSON(data);

                if (obj.result === "success") {
                    $("#znos").html(obj.data);
                } else {
                    alert(obj.data);
                }
                refreshDocuments();
            }
        });

    }
};
PSN.addZnoSubject = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var data = $("#zno-form-modal").serialize();
    $("#zno-modal-body").load(url, data, function() {
        btn.button('reset');
    });
};
PSN.delZnoSubject = function(obj, url) {
    //var data = $("#zno-form-modal").serialize(); 
    //$("#new-zno").load(url,data,function(){});
    $(obj).parent().parent().parent().hide().find(".deleted").val(1);
};
PSN.editZno = function(obj, url) {
    var btn = $(obj);
    $("#new-zno").load(url, function() {
        // btn.button('reset');
        $("#znoModal").modal("show");

    });
};
/**
 *  Doc code
 */

PSN.edboZnoUpdate = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function

    $.ajax({
        'url': link,
        'async': false,
        'type': 'POST',
        success: function(data) {

            btn.button('reset');
            refreshZnos();
            refreshDocuments();

        }
    });
};
PSN.edboAnDocUpdate = function(obj) {
    var link = $(obj).attr("href");
    $.ajax({
        'url': link,
        'async': "false",
        'type': 'POST',
        success: function(data) {
            refreshDocuments();
            refreshZnos();
        }
    });
};
PSN.edboDocUpdate = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function

    $.ajax({
        'url': link,
        'async': "false",
        'type': 'POST',
        success: function(data) {

            btn.button('reset');
            refreshDocuments();
            refreshZnos();
        }
    });
};

PSN.edboBenefitsUpdate = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    $.ajax({
        'url': link,
        'async': "false",
        'type': 'POST',
        success: function(data) {


            btn.button('reset');
            refreshBenefits();

        }
    });
};
PSN.edboSpecsUpdate = function(obj) {
    var link = $(obj).attr("href");
    $.ajax({
        'url': link,
        'async': "false",
        'type': 'POST',
        success: function(data) {

            refreshSpecs();

        }
    });
};

PSN.addDoc = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#doc-modal-holder").load(url, function() {
        //alert("ok");//
        btn.button('reset');
        $("#docModal").modal("show");
    });
};
PSN.appendDoc = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#doc-form-modal").serialize();

    if (fdata == "") {
        $("#docModal").modal("hide");
        return;
    }
    $.ajax({
        'url': link,
        'data': fdata,
        'type': 'POST',
        success: function(data) {
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
PSN.editDoc = function(obj) {
    var btn = $(obj);
    //btn.button('loading');

    $("#doc-modal-holder").load($(obj).attr("href"), function() {
        //btn.button('reset');
        $("#docModal").modal("show");
    });
    return false;
};
PSN.delDoc = function(obj) {
    if (confirm("Ви впевнені, що бажаєте видалити документ?")) {
        $.ajax({
            'url': $(obj).attr("href"),
            success: function(data) {
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
PSN.addSpec = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    //var data = $("#benefit-form").serialize(); 
    $("#spec-modal-holder").load(url, function() {
        //alert("ok");//
        btn.button('reset');
        $("#specModal").modal("show");
    });
};
PSN.addSpec_electron = function(obj, url) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var data = $("#idRequest").val(); 
    if (data === "") {
        alert("Вкажіть ідентифікатор заявки!");
        btn.button('reset');
        return false;
    }
    url=url+"&idRequest="+data;
    $("#spec-modal-holder").load(url, function() {
        //alert("ok");//
        btn.button('reset');
        $("#specModal").modal("show");
    });
    
    
};
PSN.onFacChange = function(obj, id, url) {
    var fid = $("#idFacultet :selected").val();
    var formid = $("#Personspeciality_EducationFormID :selected").val();
    var qid = $("#QualificationID :selected").val();
    var base = $("#Personspeciality_EntrantDocumentID :selected").val();
    data = "idFacultet=" + fid + "&idEducationForm=" + formid + "&QualificationID=" + qid+"&BaseSpecID="+base;
    $(id).load(url, data);
};
PSN.appendSpec = function(obj, link) {
    var btn = $(obj);
    btn.button('loading'); // call the loading function
    var fdata = $("#spec-form-modal").serialize();
    $.ajax({
        'url': link,
        'data': fdata,
        success: function(data) {
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
PSN.delSpec = function(obj) {
    var link = $(obj).attr("href");
    if (confirm("Ви впевнені, що бажаєте видалити спеціальність?")) {
        $.ajax({
            'url': link,
            success: function(data) {
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
PSN.editSpec = function(obj) {
    var link = $(obj).attr("href");
    var btn = $(obj);
    //btn.button('loading');
    $("#spec-modal-holder").load(link, function() {
        //btn.button('reset');
        $("#specModal").modal("show");
    });
};
/**
 * EntranceType Change
 */
PSN.changeEntranceType = function(obj, link, link1) {
    var EntranceType = parseInt($(obj, ":selected").val());
    $.ajax({
        'url': link1,
        'data': 'id=' + EntranceType,
        'type': 'GET',
        success: function(data) {
            $("#Personspeciality_CausalityID").html(data);
        }
    });
    switch (EntranceType) {
        case 1:
            $(".examsujects select :first").attr("selected", "selected");
            $(".examsujects input").val("").attr("disabled", "disabled");
            $(".examsujects select").val("").attr("disabled", "disabled");
            $(".znosubjects select").removeAttr('disabled');
            $(".causality").attr("disabled", "disabled");
            $(".causality [value='']").attr("selected", "selected");

            break;
        case 2:

            $(".znosubjects select").attr("disabled", "disabled");
            $(".znosubjects select :selected").removeAttr("selected", "");
            $(".znosubjects select [value='']").attr("selected", "selected");
            $(".examsujects input").removeAttr('disabled');
            $(".examsujects select").removeAttr('disabled');
            $(".causality :first").attr("selected", "selected");
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
    PSN.changeSpeciality(obj, link);
}
/**
 * Sepciality change
 */
PSN.changeSpeciality = function(obj, link) {

    var fdata = $("#spec-form-modal").serialize();
    $.ajax({
        'url': link,
        'data': fdata,
        'type': 'POST',
        success: function(data) {
            $("#subjects-holder").html(data);
        }
    });

}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
PSN.changeFIO = function() {

    $("#FirstName").keyup(function() {
        var FirstName = $("#FirstName").val();
        //FirstName = FirstName.capitalize();
        $("#FirstName").val(FirstName);
        $("#FirstNameR").val(FirstName);
    });
    $("#LastName").keyup(function() {
        var LastName = $("#LastName").val();
        //LastName = LastName.capitalize();
        $("#LastName").val(LastName);
        $("#LastNameR").val(LastName);
    });
    $("#MiddleName").keyup(function() {
        var MiddleName = $("#MiddleName").val();
        //MiddleName = MiddleName.capitalize();
        $("#MiddleName").val(MiddleName);
        $("#MiddleNameR").val(MiddleName);
    });
}
$(document).ready(function() {
    PSN.Init();
    PSN.changeFIO();
});
