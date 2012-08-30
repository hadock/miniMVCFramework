$("#document").ready(function(){
    $("a.showhistory[rel]").overlay({
        effect:"apple",
        onBeforeLoad:function(){
                //<img src="img/loading.gif" width="35px" height="35px" alt="Enviando">
                var a=this.getOverlay().find(".contentWrap");
                a.load(this.getTrigger().attr("href"));
                //a.attr("src",this.getTrigger().attr("href"))
            }
    });
    /*
    $(".showhistory").click(function(){
        
        $("#overlay").overlay({

		mask: 'darkred',
		effect: 'apple',

		onBeforeLoad: function() {

			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");

			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}

	});
        return false;
    });
    */
})


