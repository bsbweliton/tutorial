		tinymce.init({
			// General options
			mode : "exact",
			elements : "corpo_doc",
			theme : "modern",
			relative_urls: false,
			remove_script_host: false,
		
			skin : "lightgray",
			valid_children : "-td[p],-td[div]",
		
			contextmenu: "link image | tableprops inserttable cell row column deletetable | removeformat",
			plugins : ["autolink autosave lists charmap table image responsivefilemanager searchreplace contextmenu paste fullscreen visualchars textcolor autosave searchreplace colorpicker code"],
		
			paste_preprocess: function(plugin, args) {
				args.content = args.content.replace(/<span[^>]+>|<span>/g, "<span class=\'oficio\' >");
				args.content = args.content.replace(/<div[^>]+>|<div>/g, "<p class=\'oficio\' >");
				args.content = args.content.replace(/<p[^>]+>|<p>/g, "<p class=\'oficio\' >");
				args.content = args.content.replace(/<br[^>]+>|<br>/g, "</p><p class=\'oficio\' >");
			},
		
			table_default_styles: {
				fontSize: "12pt"
			},
		
			setup : function(ed) {
				ed.on("init", function(e) {
		
					var funcaoprogramada;
		
					tinymce.activeEditor.on("focus", function(e) {
						tinymce.activeEditor.selection.select(tinymce.activeEditor.dom.get("corpo"));
						funcaoprogramada = setInterval(function(){salvarcorpodoc();},30000);
		
					});
					tinymce.activeEditor.on("blur", function(e) {
						salvarcorpodoc();
						clearInterval(funcaoprogramada);
		
					});
		
				});
		
			},
		
			entity_encoding : "raw",
			language : "pt_BR",
			fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
		
			// Theme options
			toolbar1 : "undo redo | bold italic underline strikethrough | forecolor backcolor alignleft aligncenter alignright alignjustify | fontsizeselect | bullist numlist outdent indent cut copy paste pastetext pasteword",
		
			height : " 580px ",
		
			// Example word content CSS (should be your site CSS) this one removes paragraph margins
			content_css : "../../public/sisgeof/css/word.css",
		
			// Drop lists for link/image/media/template dialogs
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
		
			image_advtab: true ,
		
			invalid_elements : "h1,h2,h3,h4,h5,h6",
		
			external_filemanager_path:"../../sisgeof/filemanager/",
			filemanager_title:"Gerenciador de Arquivos" ,
			external_plugins: { "filemanager" : "../../filemanager/plugin.min.js", "nanospell": "../../nanospell/plugin.js"},
			nanospell_server: "php",
			nanospell_dictionary: "pt_br",
			nanospell_autostart: true,
			nanospell_ignore_words_with_numerals: true,
			nanospell_ignore_block_caps: true,
			nonbreaking_force_tab : true
		});
		
			function salvarcorpodoc()
			{
				$("#corposemformat").val(tinymce.activeEditor.getBody().innerHTML);
		
				$.post(
						"../../sisgeof/oficio/salvarrascunhocorpo",
						{iddoc: $("#iddoc").val(), corpo: $("#corposemformat").val()},
						function(data){});
			}