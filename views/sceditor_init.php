<script type="text/javascript" charset="utf-8">
/* Wolf's filter switch */
$(function () {

    $('.filter-selector').live('wolfSwitchFilterIn', function (ev, f, elm) {
        if (f == 'sceditor') {
            var language = "<?php echo $language; ?>";
			var sceditor_path = "<?php echo PLUGINS_URI; ?>sceditor/scripts/sceditor/"; 
      
	        // Begin extended commandset
            $.sceditor.setCommand("headers", function (caller) {
                var editor = this,
                    content = $("<div />"),
                    clickFunc = function (e) {
                        editor.execCommand("formatblock", "<h" + $(this).data('sceditor-hsize') + ">");
                        editor.closeDropDown(true);
                        e.preventDefault();
                    };

                for (var i = 1; i <= 6; i++) {
                    content.append(
                    $('<a class="sceditor-header-option" href="#"><h' + i + '>Heading ' + i + '</h' + i + '></a>').data('sceditor-hsize', i).click(clickFunc));
                }

                editor.createDropDown(caller, "header-picker", content);
            }, "Format Headers");

            $.sceditorBBCodePlugin.setCommand("h1", { h1: null }, null, "[h1]{0}[/h1]", "<h1>{0}</h1>");
            $.sceditorBBCodePlugin.setCommand("h2", { h2: null }, null, "[h2]{0}[/h2]", "<h2>{0}</h2>");
            $.sceditorBBCodePlugin.setCommand("h3", { h3: null }, null, "[h3]{0}[/h3]", "<h3>{0}</h3>");
            $.sceditorBBCodePlugin.setCommand("h4", { h4: null }, null, "[h4]{0}[/h4]", "<h4>{0}</h4>");
            $.sceditorBBCodePlugin.setCommand("h5", { h5: null }, null, "[h5]{0}[/h5]", "<h5>{0}</h5>");
            $.sceditorBBCodePlugin.setCommand("h6", { h6: null }, null, "[h6]{0}[/h6]", "<h6>{0}</h6>");
            // End extended commandset
			
            elm.sceditor({
                style: sceditor_path + "jquery.sceditor.default.min.css",
                toolbar: "headers,bold,italic,underline,strike,subscript,superscript,|left,center,right,justify,horizontalrule,|font,size,color,removeformat|cut,copy,paste,pastetext|bulletlist,orderedlist|,undo,redo|table|code,quote|image,email,link,unlink,emoticon,youtube,date,time|print,source",
                locale: language,
                resizeEnabled: true,
                emoticons: {
                    dropdown: {
                        ":)": sceditor_path + "emoticons/smile.png",
                        ":angel:": sceditor_path + "emoticons/angel.png",
                        ":angry:": sceditor_path + "emoticons/angry.png",
                        "8-)": sceditor_path + "emoticons/cool.png",
                        ":'(": sceditor_path + "emoticons/cwy.png",
                        ":ermm:": sceditor_path + "emoticons/ermm.png",
                        ":D": sceditor_path + "emoticons/grin.png",
                        "<3": sceditor_path + "emoticons/heart.png",
                        ":(": sceditor_path + "emoticons/sad.png",
                        ":O": sceditor_path + "emoticons/shocked.png",
                        ":P": sceditor_path + "emoticons/tongue.png",
                        ";)": sceditor_path + "emoticons/wink.png"
                    },
                    more: {
                        ":alien:": sceditor_path + "emoticons/alien.png",
                        ":blink:": sceditor_path + "emoticons/blink.png",
                        ":blush:": sceditor_path + "emoticons/blush.png",
                        ":cheerful:": sceditor_path + "emoticons/cheerful.png",
                        ":devil:": sceditor_path + "emoticons/devil.png",
                        ":dizzy:": sceditor_path + "emoticons/dizzy.png",
                        ":getlost:": sceditor_path + "emoticons/getlost.png",
                        ":happy:": sceditor_path + "emoticons/happy.png",
                        ":kissing:": sceditor_path + "emoticons/kissing.png",
                        ":ninja:": sceditor_path + "emoticons/ninja.png",
                        ":pinch:": sceditor_path + "emoticons/pinch.png",
                        ":pouty:": sceditor_path + "emoticons/pouty.png",
                        ":sick:": sceditor_path + "emoticons/sick.png",
                        ":sideways:": sceditor_path + "emoticons/sideways.png",
                        ":silly:": sceditor_path + "emoticons/silly.png",
                        ":sleeping:": sceditor_path + "emoticons/sleeping.png",
                        ":unsure:": sceditor_path + "emoticons/unsure.png",
                        ":woot:": sceditor_path + "emoticons/w00t.png",
                        ":wassat:": sceditor_path + "emoticons/wassat.png"
                    },
                    hidden: {
                        ":whistling:": sceditor_path + "emoticons/whistling.png",
                        ":love:": sceditor_path + "emoticons/wub.png"
                    }
                }
            });
        }
    });

    $('.filter-selector').live('wolfSwitchFilterOut', function (ev, f, elm) {
        if (f == 'sceditor') {
            elm.data('sceditor').destory();
        }
    });

});
</script>