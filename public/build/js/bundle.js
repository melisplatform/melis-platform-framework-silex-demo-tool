$(function(){
    var body = $("body");

    body.on("click", '#meliscodeexamplesilex_tool_new_album', function(){
        var modalUrl = "/melis/silex-create-album";
        melisHelper.createModal('','',false,[],modalUrl,function() {
            melisCoreTool.done("button#meliscodeexamplesilex_tool_new_album");
        });
    });

});