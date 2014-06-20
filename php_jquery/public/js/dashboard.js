/*---------------------------------------------------------------------------------------------------*/
var Dashboard = function() {

    /*---------------------------------------------------------------------------------------------------*/
    this.__construct = function() {

        console.log('Dashboard Created');

        Template = new Template();
        Event    = new Event();
        //Result   = new Result();
        load_todo();
        load_note();
        
        //console.log(Template.todo({todo_id: 1, content: "This is life"}));

    };



    /*---------------------------------------------------------------------------------------------------*/

    var load_todo = function() {
        
        $.get('api/get_todo', function (o){
            
            var output = '';
            /*pass our output into a loop*/
            for (var i = 0; i < o.length; i++){
                
              output += Template.todo(o[i]);
            }
            $('#list_todo').html(output);
            
        }, 'json');


    };

 /*---------------------------------------------------------------------------------------------------*/


    var load_note = function() {
        
        $.get('api/get_note', function (jsonObj){
            
            var output = '';
            for (var i = 0; i < jsonObj.length; i++){
                
                output += Template.note(jsonObj[i]);
            }
            
            $('#list_note').html(output);
        } , 'json');



    };

       /*---------------------------------------------------------------------------------------------------*/

    this.__construct();

};