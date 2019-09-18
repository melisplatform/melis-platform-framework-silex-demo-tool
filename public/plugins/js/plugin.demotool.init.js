function demoTool_init(pluginId){
    // declaring parameters variable for old / cross browser compatability
    if(typeof pluginId === "undefined") pluginId = null;

	// Checking if the plugin is not null
	if(pluginId == null || !$("#"+pluginId).length){
		return false;
	}
	
}

$(function(){
    demoTool_init("cms-slider");
})