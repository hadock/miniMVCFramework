$(document).ready(function(){
    var triggers = $(".modalInput").overlay({

    // la mascara modificable para los mensajes modales
    mask: {
                color: "#ebecff",
                loadSpeed: 200,
                opacity: 0.7
            },

        closeOnClick: false
    });

    /* Simple Modal Box */
    var buttons1 = $("#simpledialog button").click(function(e) {

        // get user input
        var yes = buttons1.index(this) === 0;

        if (yes) {
            // do the processing here
        }
    });

    /* Yes/No Modal Box */
    var buttons2 = $("#yesno button").click(function(e) {

        // get user input
        var yes = buttons2.index(this) === 0;
        

        // do something with the answer
        //triggers.eq(1).html("You clicked " + (yes ? "yes" : "no"));
    });

    /* User Input Prompt Modal Box */
    $("#prompt form").submit(function(e) {

        // close the overlay
        triggers.eq(2).overlay().close();

        // get user input
        var input = $("input", this).val();

        // do something with the answer
        if (input) triggers.eq(2).html(input);

        // do not submit the form
        return e.preventDefault();
    });
});