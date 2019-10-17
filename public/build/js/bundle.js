


$(function(){

    getSilexTranslation();

    function getSilexTranslation() {
        var silexTrans;
        $.ajax({
            type        : 'POST',
            url         : '/melis/silex-translation',
            dataType    : 'json',
            encode		: true,
        }).done(function(data){
            if(data.success) {
                silexTrans = data.translation;
                silexJs(silexTrans);
            }
        });
    }

    function silexJs(silexTranslations) {
        var body = $("body");

        body.on("click", '#meliscodeexamplesilex_tool_new_album', function(){
            melisCoreTool.pending('button#meliscodeexamplesilex_tool_new_album');
            var modalUrl = "/melis/silex-album-form";
            melisHelper.createModal(null,null,false,[],modalUrl,function() {
                melisCoreTool.done("button#meliscodeexamplesilex_tool_new_album");
            });
        });

        body.on("submit", "form#melis_silex_album_form", function(e) {
            var formId   = "form#" + $(this).attr("id");
            var formData = $(this).serializeArray();

            $(formId + " input, button").not("input#alb_id").attr("disabled", "disabled");

            $.ajax({
                type        : 'POST',
                url         : '/melis/silex-save-album',
                data        : $.param(formData),
            }).done(function(data){
                if(data.success) {
                    $(".modal").modal("hide");
                    melisHelper.melisOkNotification(data.title, data.message);
                }
                else {
                    melisHelper.melisKoNotification(data.title, data.message, data.errors, 0);
                }
                $(formId + " input, button").not("input#alb_id").removeAttr("disabled");
            });

            e.preventDefault();
        });

        body.on("click", '.btn_meliscodeexamplesilex_delete', function(){
            melisCoreTool.pending('button.btn_meliscodeexamplesilex_delete');
            var id = $(this).data("albumid");
            melisCoreTool.confirm(
                translations.tr_meliscore_common_yes,
                translations.tr_meliscore_common_no,
                silexTranslations.tr_melisplatformsilexdemotool_plugin_name,
                silexTranslations.tr_meliscodeexamplesilex_album_delete_confirm,
                function() {
                    $.ajax({
                        type        : 'POST',
                        url         : '/melis/silex-delete-album',
                        data        : {id : id},
                        dataType    : 'json',
                        encode		: true,
                    }).done(function(data){
                        if(data.success) {
                            $(".modal").modal("hide");
                            var albId = "tr#album_"+id;
                            $(albId).remove();
                            melisHelper.melisOkNotification(data.title, data.message);
                        }
                        else {
                            melisHelper.melisKoNotification(data.title, data.message, data.errors, 0);
                        }
                    });
                }
            );

            melisCoreTool.done("button.btn_meliscodeexamplesilex_delete");
        });

        body.on("click", '.btn_meliscodeexamplesilex_edit', function(){
            melisCoreTool.pending('button.btn_meliscodeexamplesilex_edit');
            var id = $(this).data("albumid");
            $.ajax({
                type        : 'POST',
                url         : '/melis/silex-edit-album',
                data        : {id : id},
                dataType    : 'json',
                encode		: true,
            }).done(function(data){
                if(data.success) {
                    var modalUrl = "/melis/silex-album-form";
                    melisHelper.createModal(null,null,false,data.album,modalUrl,function() {
                        melisCoreTool.done("button.btn_meliscodeexamplesilex_edit");
                    });
                }
            });

        });
    }
});

