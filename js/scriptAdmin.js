/*
jQuery( function( $ ) {

    edButtons[25] = new edButton(
        'ed_ytb'  // id
        ,'Youtube'    // display
        ,'[ytube id="'  // tagStart
        ,'"]' // tagEnd
        ,'2'     // access
    );
    var ytbButton = $( '<input type="button" id="ed_ytb" accesskey="2" class="ed_button" value="Youtube">' );
    ytbButton.click( function() {
        edInsertTag( edCanvas, ytbIdx );
    } );
    // Insert it anywhere you want. This is after the <i> button
    ytbButton.insertAfter( $( '#ed_em' ) );
    // This is at the end of the toolbar
    // h2Button.appendTo( $( '#ed_toolbar' ) );
} );
*/
function ytubebtn() {
	var idvideo = prompt("ID Video","");
	if(idvideo)
		return '[ytube id="'+idvideo+'"]';
}

(function() {

    tinymce.create('tinymce.plugins.ytubebtn', {

        init : function(ed, url){
            ed.addButton('ytubebtn', {
                title : 'Youtube Thumbnail',
                onclick : function() {
                    ed.execCommand(
                        'mceInsertContent',
                        false,
                        ytubebtn()
                        );
                },
                image: url + "/btn.png"
            });
        },

        getInfo : function() {
            return {
                longname : 'Youtube Thumbnail Player',
                author : 'Jodacame',
                authorurl : 'http://nexxuz.com',
                infourl : '',
                version : "0.1"
            };
        }
    });

    tinymce.PluginManager.add('ytubebtn', tinymce.plugins.ytubebtn);
    
})();
