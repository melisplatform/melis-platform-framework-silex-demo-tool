$(function(){
    var body = $("body");

    body.on("click", '#meliscodeexamplesilex_tool_new_album', function(){
        var modalUrl = "/melis/MelisPlatformFrameworkSilexDemoTool/List/renderToolModalContainer";
        melisHelper.createModal('id_melisplatformsilexdemotool_create_album_handler','melisplatformsilexdemotool_create_album_handler',false,[],modalUrl,function() {
            melisCoreTool.done("button#meliscodeexamplesilex_tool_new_album");
        });
    });

});