/*---------------------------------------------------------------------------------------------------*/
var Result = function() {

    /*---------------------------------------------------------------------------------------------------*/

    this.__construct = function() {

        console.log('Result Created');

    };

    /*---------------------------------------------------------------------------------------------------*/


    this.success = function(msg) {

        var dom = $('#success');
        /* If a user has undefined item(s), then let's do something*/
        if (typeof msg === 'undefined') {
            dom.html('Success').fadeIn();

        }
        dom.html(msg).fadeIn();

        /*set a time out to make the message to disappear because this is AJAX  driven*/
        setTimeout(function() {

            dom.fadeOut();
        }, 5000);

    };

    /*---------------------------------------------------------------------------------------------------*/

    /*---------------------------------------------------------------------------------------------------*/


    this.error = function(msg) {

        var dom = $('#error');
        /* If a user has undefined item(s), then let's do something*/
        if (typeof msg === 'undefined') {
            dom.html('Error').fadeIn();

        }

        if (typeof msg === 'object') {

            var output = '<ul>';

            for (var key in msg) {

                output += '<li>' + msg[key] + '</li>';

            }

            output += '</ul>';

            dom.html(output).fadeIn();

        } else {

            dom.html(msg).fadeIn();
        }
        //$("#error").html(msg).fadeIn();
        $("#error").show(msg);

        setTimeout(function() {

            dom.fadeOut();
        }, 5000);
    };

    /*---------------------------------------------------------------------------------------------------*/


    this.__construct();

};