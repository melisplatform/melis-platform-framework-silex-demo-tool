


$(function(){

    //calling the silex translation function which will also run the album tool's required JS to work properly.
    getSilexTranslation();

    function getSilexTranslation() {
        var silexTrans;

        //ajax request for getting all the silex translation so that it will be accessible in JS just like melis.
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

    // all of the JS for the silex album tool are placed inside this function.
    function silexJs(silexTranslations) {
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
                    //hiding the create form modal once saving is successful
                    $(".modal").modal("hide");

                    //adding notification  message for successful saving of data
                    melisHelper.melisOkNotification(data.title, data.message);
                }
                else {
                    //adding notification  message for failure saving of data
                    melisHelper.melisKoNotification(data.title, data.message, data.errors, 0);
                }

                //re-enable all inputs and buttons once the all the action is done failed or success
                $(formId + " input, button").not("input#alb_id").removeAttr("disabled");
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
                translations.tr_meliscore_common_no, // translation for "mo" taken from melis translations.
                silexTranslations.tr_melisplatformsilexdemotool_plugin_name, // translation for the confirmation title taken from SILEX translations.
                silexTranslations.tr_meliscodeexamplesilex_album_delete_confirm, // translation for the confirmation message taken from SILEX translations.
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
                        }
                        else {
                            //adding notification  message for failure deletion of data
                            melisHelper.melisKoNotification(data.title, data.message, data.errors, 0);
                        }
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
            });

        });

        //Table Refresh button
        body.on("click", '.silexDemoToolAlbumTableRefreshBtn', function(){
            $("#silexDemoToolAlbumTable").DataTable().ajax.reload();
        });

    }
});

