jQuery(document).ready(function($) {

    // Create 'keyup_event' tinymce plugin
    tinymce.PluginManager.add('keyup_event', function(editor, url) {

        // Create keyup event
        editor.on('keyup', function(e) {

            // Get the editor content (html)
            get_ed_content = tinymce.activeEditor.getContent();
            // Do stuff here... (run limit_tinymce_characters() function)
            limit_tinymce_characters(get_ed_content);
        });
    });

    // This is needed for running the keyup event in the text (HTML) view of the editor
    $('#content').on('keyup', function(e) {

        // Get the editor content (html)
        get_ed_content = tinymce.activeEditor.getContent();
        // Do stuff here... (run limit_tinymce_characters() function)
        limit_tinymce_characters(get_ed_content);
    });

    // This function allows the script to run from both locations (visual and text)
    function limit_tinymce_characters(content) {

        // Now, you can further process the data in a single function
        //alert(content);

				//console.log(content);
				console.log("Characters: " + content.length);
				$("#titlewrap").hide()

				var max = 4000;
        var count = content.length;
				if (count <= max) {
					$('.character-limit').remove();
					$('#segment_1_description p.description').after('<span class="character-limit" style="">Character Count: ' + content.length + '</span>');
					//$('#publishing-action .button').removeAttr('disabled');
					$( '#publishing-action .button' ).show();
        }
        if (count > max) {
					$('.character-limit').remove();
					$('#segment_1_description p.description').after('<span class="character-limit" style="">Character Count: ' + content.length + '</span><span class="character-limit" style="color: red; font-weight: bold;"> - Error: Character Limit Exceeded.</span>');
					//$('#publishing-action .button').attr('disabled', 'disabled');
					$( '#publishing-action .button' ).hide();
					//alert("Maximum " + max + " characters allowed.")
					//return false;
        }
    }
});
