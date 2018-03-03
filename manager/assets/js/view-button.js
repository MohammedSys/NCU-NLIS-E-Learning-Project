/*
 * id: form ID
 * page:
 *      0 for material-View
 *      1 for exam-View
 *      2 for ann-View
 * 
 * name: form input name
 */
function changeAction( page, id, name, action_name )
{
    var form = document.getElementById( id );
    switch( page )
    {
        case 0:
            if ( $("input[name='" + name + "']:checked").length != 0 )
            {
                if ( action_name == "update" )
                    form.action = "material-Update.php";
                else if( action_name == "del" )
                    form.action = "php/material-Delete.php";
                form.submit();
            }
            else trigger_msg( "至少需要勾選一個項目。" );
            break;
        case 1:
            if ( $("input[name='" + name + "']:checked").length != 0 )
            {
                if ( action_name == "update" )
                    form.action = "exam-Update.php";
                else if( action_name == "del" )
                    form.action = "php/exam-Delete.php";
                form.submit();
            }
            else trigger_msg( "至少需要勾選一個項目。" );
            break;
        case 2:
            if ( $("input[name='" + name + "']:checked").length != 0 )
            {
                if ( action_name == "update" && $("input[name='" + name + "']:checked").length == 1 )
                {
                    form.action = "ann-Update.php";
                    form.submit();
                }
                else if ( action_name == "update" && $("input[name='" + name + "']:checked").length != 1)
                    trigger_msg( "修改公告只能勾選一個項目。" );
                else if( action_name == "del" )
                {
                    form.action = "php/ann-Delete.php";
                    form.submit();
                }
            }
            else trigger_msg( "至少需要勾選一個項目。" );
            break;
    }
}

function trigger_msg( msg )
{
    $("#modalMessage").html( msg );
    //open message dialogue
    $('#Modal').modal( 'show' );
}