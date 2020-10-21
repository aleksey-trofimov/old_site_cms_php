<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="jscript/tiny_mce_3.0.5/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
        mode : "exact",
	elements : "text_content",
	external_link_list_url : "myexternallist.js",
	language: "ru",
	theme : "advanced",
	plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview, zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
	theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,image,cleanup,code,help",
//	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
//	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
//      theme_advanced_disable : "hr, sup, sub, visualaid, removeformat, charmap, anchor",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",


		content_css : "",
		plugi2n_insertdate_dateFormat : "%Y-%m-%d",
		plugi2n_insertdate_timeFormat : "%H:%M:%S",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "myFileBrowserDialog",
		paste_use_dialog : true,
		theme_simple_resizing : true,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : true,
		paste_strip_class_attributes : "all",
		paste_remove_spans : true,
		cleanup_on_startup : true,
		relative_urls : false,
		auto_size:false,
		apply_source_formatting : true,
	        height:"500px",
		width:"725px",


		paste_remove_styles : true
	});
myWin = "";


function myFileBrowserDialog(field_name, url, type, win) {
     myWin = win;
     myPath=window.document.base.dual.value;
     m = window.open('/php/select.php?record_path='+myPath+'&field_name='+field_name+'&file_type='+type,'','width=640,height=480,status=yes,scrollbars=yes,resizable=yes');
     return;
}

function myFileBrowserValueReturn(field_name, url) {
     myPath=window.document.base.dual.value;
     myWin.focus();
     if (myWin.focus == false) {
          alert("No focus");
     }
     myWin.document.forms[0].elements[field_name].value = myPath +'/'+ url;
     return;
}


	// Custom event handler
	function myCustomExecCommandHandler(editor_id, elm, command, user_interface, value) {
		var linkElm, imageElm, inst;

		switch (command) {
			case "mceLink":
				inst = tinyMCE.getInstanceById(editor_id);
				linkElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "a");

				if (linkElm)
					alert("Link dialog has been overriden. Found link href: " + tinyMCE.getAttrib(linkElm, "href"));
				else
					alert("Link dialog has been overriden.");

				return true;

			case "mceImage":
				inst = tinyMCE.getInstanceById(editor_id);
				imageElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "img");

				if (imageElm)
					alert("Image dialog has been overriden. Found image src: " + tinyMCE.getAttrib(imageElm, "src"));
				else
					alert("Image dialog has been overriden.");

				return true;
		}

		return false; // Pass to next handler in chain
	}

	// Custom save callback, gets called when the contents is to be submitted
	function customSave(id, content) {
		//alert(id + "=" + content);
	}
</script>
<!-- /tinyMCE -->

