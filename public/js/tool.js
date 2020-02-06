$(function() {
    var body = $("body");

        body.on("click", '#meliscodeexamplesilex_tool_new_album', function(){
            //disabling the new album button on the upper right of the view once clicked
            melisCoreTool.pending('button#meliscodeexamplesilex_tool_new_album');

            //calling the create form modal.
            var modalUrl = "/melis/silex-album-form";
            melisHelper.createModal(null,null,false,[],modalUrl,function() {
                melisCoreTool.done("button#meliscodeexamplesilex_tool_new_album");
            });
        });

        body.on("submit", "form#melis_silex_album_form", function(e) {
            //getting the Id of the form
            var formId   = "form#" + $(this).attr("id");

            //getting all the form inputs
            var formData = $(this).serializeArray();

            //disabling all input and buttons once save button is clicked
            $(formId + " input, button").not("input#alb_id").attr("disabled", "disabled");

            //ajax request for saving the item
            $.ajax({
                type        : 'POST',
                url         : '/melis/silex-save-album',
                data        : $.param(formData),
                dataType    : 'json',
                encode		: true,
            }).done(function(data){
                if(data.success) {
                    //reloading the table to update with the deleted file
                    $("#silexDemoToolAlbumTable").DataTable().ajax.reload();

                    //hiding the create form modal once saving is successful
                    $(".modal").modal("hide");

                    //zone reload
                    melisHelper.zoneReload("id_melisplatformsilexdemotool_content","MelisPlatformFrameworkSilexDemoTool_content");

                    //adding notification  message for successful saving of data
                    melisHelper.melisOkNotification(data.title, data.message);
                }
                else {
                    //adding notification  message for failure saving of data
                    melisHelper.melisKoNotification(data.title, data.message, data.errors, 0);

                    //highlight fields with error
                    melisCoreTool.highlightErrors(data.success, data.errors, "melis_silex_album_form");
                }

                //re-enable all inputs and buttons once the all the action is done failed or success
                $(formId + " input, button").not("input#alb_id").removeAttr("disabled");
                melisCore.flashMessenger();
            }).fail(function() {
                alert( translations.tr_meliscore_error_message );
            });

            e.preventDefault();
        });

        //Delete Album
        body.on("click", '.btn_meliscodeexamplesilex_delete', function(){
            //disable the delete buttons once the delete button is pressed
            melisCoreTool.pending('button.btn_meliscodeexamplesilex_delete');

            //getting the item ID from the table row element
            var id = $(this).closest("tr").attr("id");

            //confirmation modal that will pop up whenever the delete button is clicked
            melisCoreTool.confirm(
                translations.tr_meliscore_common_yes, // translation for "yes" taken from melis translations.
                translations.tr_meliscore_common_no, // translation for "no" taken from melis translations.
                translations.tr_melisplatformsilexdemotool_plugin_name, // translation for the confirmation title taken from SILEX translations.
                translations.tr_meliscodeexamplesilex_album_delete_confirm, // translation for the confirmation message taken from SILEX translations.
                function() {
                    //ajax request for deleting data.
                    $.ajax({
                        type        : 'POST',
                        url         : '/melis/silex-delete-album',
                        data        : {id : id},
                        dataType    : 'json',
                        encode		: true,
                    }).done(function(data){
                        if(data.success) {
                            //reloading the table to update with the deleted file
                            $("#silexDemoToolAlbumTable").DataTable().ajax.reload();

                            //adding notification message for successful deletion of data
                            melisHelper.melisOkNotification(data.title, data.message);

                            //zone reload
                            melisHelper.zoneReload("id_melisplatformsilexdemotool_content","MelisPlatformFrameworkSilexDemoTool_content");
                        }
                        else {
                            //adding notification  message for failure deletion of data
                            melisHelper.melisKoNotification(data.title, data.message, [], 0);
                        }
                        melisCore.flashMessenger();
                    }).fail(function() {
                        alert( translations.tr_meliscore_error_message );
                    });
                }
            );

            //re-enable delete buttons after deleting the item
            melisCoreTool.done("button.btn_meliscodeexamplesilex_delete");
        });

        //Edit Album
        body.on("click", '.btn_meliscodeexamplesilex_edit', function(){

            //disable edit buttons before the completion of request
            melisCoreTool.pending('button.btn_meliscodeexamplesilex_edit');

            //getting the item ID from the table row element
            var id = $(this).closest("tr").attr("id");

            //ajax request for getting data of the item to be edited.
            $.ajax({
                type        : 'POST',
                url         : '/melis/silex-edit-album',
                data        : {id : id},
                dataType    : 'json',
                encode		: true,
            }).done(function(data){
                if(data.success) {
                    var modalUrl = "/melis/silex-album-form";
                    //calling the edit modal
                    melisHelper.createModal(null,null,false,data.album,modalUrl,function() {
                        //re-enable edit buttons after editing the item
                        melisCoreTool.done("button.btn_meliscodeexamplesilex_edit");
                    });
                }
            }).fail(function() {
                alert( translations.tr_meliscore_error_message );
            });
        });

        //Table Refresh button
        body.on("click", '.silexDemoToolAlbumTableRefreshBtn', function(){
            $("#silexDemoToolAlbumTable").DataTable().ajax.reload();
            melisHelper.zoneReload("id_melisplatformsilexdemotool_content","MelisPlatformFrameworkSilexDemoTool_content");
        });
});