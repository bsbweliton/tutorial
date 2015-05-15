/**
 * 
 */

$(document).ready(function() {

    $('#corpo').hide();
    $('#decdoc').hide();
    $('#botoes').hide();
    $('#destino').hide();
    $('#emissor').hide();   
	$('#entidade1').hide();   
	$('#entidade2').hide();   
    $('#autoridade').hide();
    $('#fechofieldset').hide();
	
	$("#nomerecept").tokenInput3("../../sisgeof/documento/getautocompleteautoridade?queryParam=q" + "&idreceptor=",{ 
		onAdd: function (item) {  
			if (typeof item.id_autoridade_receptor === 'undefined') 
			{
				$("#idautoridadereceptor").val("");
				$("#nomerecept").tokenInput3("removefromcache");				
			}else	
				$("#idautoridadereceptor").val(item.id_autoridade_receptor);
			
			if($.trim($("#nomerecept").val()).length == 0)
			{
				$("#idautoridadereceptor").val("");
				$("#cargorecept").val("");
				$("#genero").val("");
				$("#logra").val("");
				$("#cep").val("");
				$("#cidade").val("");
				$("#estado").val("");	
				$("#vocativoinput").val("");
				$("#enderecamento").val("");				
			}
			else
			{		
				$("input,select").save({
						url: "../../sisgeof/oficio/atualizaautoridade",
						method: "post",
						grouped: true,//send data for all fields with the autosave
						success: function(datajson) {//on a successful update...
					
							var jsondata = JSON.parse(datajson);
							
							if(jsondata.idendereco != "n")
							{
								$("#logra").val(jsondata.logradouro);
								$("#cep").val(jsondata.cep);
								$("#cidade").val(jsondata.cidade);				            				            	

								$("#estado option").each(function(){
									if($(this).val() == jsondata.estado){
										$(this).attr('selected',true);
									}							
								});							
							}							
							if(jsondata.genero !== null)
							{
								$("#idautoridadereceptor").val(jsondata.idautoridadereceptor);							
								$("#cargorecept").val(jsondata.cargorecept);
								$("#genero option").each(function(){
									if($(this).val() == jsondata.genero){
										$(this).attr('selected',true);
									}
								});								
								$('#decdoc').show();
								$('#botoes').show();
								$('#emissor').show();    	
								$('#fechofieldset').show();		
								verificaAutoridade();								
							}
																		
						},
						send: function(){//on a save...						

						},			
						dataType: "html"
				});	
			}
			
		}			
	});		

	
	
	$("#entrecept").tokenInput2("../../sisgeof/documento/getautocomplete",{
		 onAdd: function (item) {  
		 
			if (typeof item.id_receptor === 'undefined') 
			{
				$("#idreceptor").val("");
				//$('#entidade2').hide('slow', function() {});
			}
			else
			{				
				$("#idreceptor").val(item.id_receptor);
				$('#entidade2').show('slow', function() {});
			}	
			if($.trim($("#entrecept").val()).length == 0)
			{
				$("#idreceptor").val("");
				$("#logra").val("");
				$("#cep").val("");
				$("#cidade").val("");
				$("#estado").val("");
				$("#vocativoinput").val("");
				$("#enderecamento").val("");
				
			}else
			{
				$("input,select").save({
						url: "../../sisgeof/oficio/atualizaendreceptor",
						method: "post",
						grouped: true,//send data for all fields with the autosave
						success: function(datajson) {//on a successful update...
					
							var jsondata = JSON.parse(datajson);	
							$("#idreceptor").val(jsondata.idreceptor);		
							
							if(jsondata.idendereco != "n")
							{							
								$("#logra").val(jsondata.logradouro);
								$("#cep").val(jsondata.cep);
								$("#cidade").val(jsondata.cidade);				            				            	

								$("#estado option").each(function(){
									if($(this).val() == jsondata.estado){
										$(this).attr('selected',true);
									}							
								});								
							}
																		
						},
						send: function(){//on a save...

						},			
						dataType: "html"
				});
			}			
			$("#nomerecept").tokenInput3("clear");
			$("#cargorecept").val("");
			$("#genero").val("");
		}
	        
   	});	
	
	$("input,select").not("#entrecept").not("#nomerecept").not("#token-input-entrecept").not("#token-input-nomerecept").autosave({
		url: "../../sisgeof/oficio/salvarrascunho",
		method: "post",
		grouped: true,//send data for all fields with the autosave
		success: function(datajson) {//on a successful update...

			var jsondata = JSON.parse(datajson);
			$('#iddoc').val(jsondata.iddocumento);	 			
										   				
		},
		send: function(){//on a save...
			$("#corposemformat").val(tinymce.activeEditor.getBody().innerHTML);

		},
		dataType: "html"
	});	

	
	function formataCorpoVisualizacao()
	{			
		var ed = tinymce.activeEditor;
		var cloneEditor = ed.getDoc().cloneNode(true);
		var e = cloneEditor.getElementsByTagName('p');
		var n = e.length;
		var contParagrafo = 1;
		
			//Código para eliminar os parágrafos vazios
			for (var i=0; i<cloneEditor.getElementsByTagName('p').length; i++) 
			{
				if(e[i].parentNode.tagName != 'TD')
				{				
					var html = e[i].innerHTML;

					html = html.replace(/&nbsp;/g,'');
					html = html.replace(/[<]br[^>]*[>]/gi,'');
					e[i].innerHTML = html;						
					
					if(i < (cloneEditor.getElementsByTagName('p').length))
					{
						if($.trim(e[i].innerHTML).length < 5)
						{
								var nodoAnterior = e[i].previousSibling;
								var nodoPosterior = e[i].nextSibling;
								
								if((nodoAnterior != null)&&(nodoPosterior != null))
								{
									if((nodoAnterior.nodeName != e[i].nodeName)&&(nodoPosterior.nodeName != e[i].nodeName))
									{
										e[i].outerHTML = "<BR />";
										i--;
									}
									else
									{
										e[i].parentNode.removeChild(e[i]);
										i--;											
									}
								}else
								{
									e[i].parentNode.removeChild(e[i]);
									i--;								
								}
						}

					}
				
				}	
			
			}			

		n = cloneEditor.getElementsByTagName('p').length;	
		//Código para contar os parágrafos válidos
		var pValidos = 0;
		for (var c=0; c<n; c++)
		{ 
			if(e[c].parentNode.tagName != 'TD')
				pValidos++;
		}			
		
		//Código para adicionar o número do parágrafo caso o texto tenha pelo menos 2 parágrafos válidos
		if(pValidos > 2)
		{
			for (var i=0; i < n; i++) 
			{
				if(e[i].parentNode.tagName != 'TD')
				{
					html = e[i].innerHTML;
					e[i].innerHTML = '<span style="width: 105px; display: inline-block;">'+(contParagrafo)+'.</span>'+html;																	
					contParagrafo++;
				}							
			}
		}else
		{
				//Código para formatar os parágrafos caso o texto tenha menos 3 parágrafos válidos
				for (var i=0; i < n; i++) 
				{
					if(e[i].parentNode.tagName != 'TD')
					{
						e[i].style.textIndent='105px';
					}					
				}
			
		}

		var linhasTabela = cloneEditor.getElementsByTagName('TD');
		
		for (var linha=0; linha<linhasTabela.length; linha++) 
		{
			linhasTabela[linha].removeAttribute("width");
			linhasTabela[linha].style.width = 'auto';			
		}					

		var allElements = e[0].parentNode.childNodes;
		var posUltElementovalido = 0;
		for (var a=0; a<allElements.length; a++)
		{
			//Remover o estilo das tabelas
			if(allElements[a].tagName == "TABLE")
			{
				//allElements[a].removeAttribute("data-mce-style");
				allElements[a].removeAttribute("width");
				allElements[a].style.width = 'auto';
				allElements[a].style.marginLeft='105px';
				allElements[a].style.borderCollapse='collapse';	
				posUltElementovalido = a;

			}else
			{
				if(!allElements[a].hasAttribute('data-mce-bogus'))
				{
					//Não aplicar o estilo oficio às tabelas e aos elementos do Tinymce, o usuário poderá deixar as tabelas no estilo que achar melhor				
					posUltElementovalido = a;
					allElements[a].className = 'oficio';
					allElements[a].style.textAlign = 'justify';					
					if((allElements[a].tagName != "P")&&(allElements[a].parentNode.tagName == "BODY"))
					{
						allElements[a].style.marginLeft='105px';					
					}
				}
			}
			
		}
		
		//Código para não deixar parágrafo órfão, jogando o fecho, o nome e o cargo para a próxima página juntamente com o último parágrafo
		if((e[0].parentNode.lastChild.tagName == 'P')||(e[0].parentNode.lastChild.tagName == 'DIV')||(e[0].parentNode.lastChild.tagName == 'SPAN'))
		{
			allElements[posUltElementovalido].outerHTML = '<div style="page-break-inside: avoid;width=100%;">'+allElements[posUltElementovalido].outerHTML+
			'<div class="oficio" style="text-indent:105px;" >'+$('#fechoinput').val()+
			'<br><br><br><div style="width: 100%;text-indent:0px;text-align:center;">'+ucwords_improved($('#nomeemis').val().toLowerCase())+
			'<br>'+ucwords_improved($('#cargoemis').val().toLowerCase())+
			'</div></div>'+
			'</div>';
			
		}else
		{
			allElements[posUltElementovalido].outerHTML += 
			'<p class="oficio" style="text-indent:105px;" ></p><div class="oficio" style="page-break-inside: avoid;text-indent:105px;" >'+$('#fechoinput').val()+
			'<br><br><br><div style="width: 100%;text-indent:0px;text-align:center;">'+ucwords_improved($('#nomeemis').val().toLowerCase())+
			'<br>'+ucwords_improved($('#cargoemis').val().toLowerCase())+
			'</div></div>';			
		}		
				
		$("#corpodocvis").val(e[0].parentNode.innerHTML);
		
		if($("#tipodestinogrupo").val() == 'n')
		{
				//cabeçalho para ofício que não seja resposta
				$('#cabecalhohidden').val($('#enderecamento').val()+'<br>'+$('#cargorecept').val()+'<br>'+($('#nomerecept').val()?$('#nomerecept').val()+'<br>':'')+$('#entrecept').val()+'<br>'+$('#logra').val()+'<br>'+$('#cep').val()+' - '+$('#cidade').val()+'/'+$('#estado').val().toUpperCase());
				$('#cabecalhohidden').val($('#cabecalhohidden').val()+'<br><br>'+'Assunto: '+$('#assunto').val()+($('#referencia').val()?'<br>Referência: '+$('#referencia').val():'')); 								
		}else{
			if($("#tipodestinogrupo").val() == 'e')
			{
				//Cabeçalho para ofício de resposta, nesse caso inclui-se o "NESTA"
				$('#cabecalhohidden').val($('#enderecamento').val()+'<br>'+$('#cargorecept').val()+'<br>'+($('#nomerecept').val()?$('#nomerecept').val()+'<br>':'')+$('#entrecept').val()+'<br>N E S T A');
				$('#cabecalhohidden').val($('#cabecalhohidden').val()+'<br><br>'+'Assunto: '+$('#assunto').val()+($('#referencia').val()?'<br>Referência: '+$('#referencia').val():''));
			}else
			{
				$('#cabecalhohidden').val($('#enderecamento').val()+'<br>'+($('#nomerecept').val()?$('#nomerecept').val()+'<br>':'')+$('#logra').val()+'<br>'+$('#cep').val()+' - '+$('#cidade').val()+'/'+$('#estado').val().toUpperCase());
				$('#cabecalhohidden').val($('#cabecalhohidden').val()+'<br><br>'+'Assunto: '+$('#assunto').val()+($('#referencia').val()?'<br>Referência: '+$('#referencia').val():''));
			}
		}							
	}	
    

	$("#formular").validationEngine('attach',{
		onValidationComplete: function(form, status){
			if(status){
				formataCorpoVisualizacao();
				if(confirm('Favor conferir todos os dados pois o sistema não permite a\n alteração de documentos salvos. Deseja confirmar a operação?'))
				{					
					$("#formular").validationEngine('detach');
					$("#formular").submit().block({ 
				        message: '<h3>Gerando documento...</h3>' 
				    });
				}
			}					
		}
	});

	$('#cargorecept').bind('change', function() {
		verificaAutoridade();
	});

	$('#cargorecept').bind('blur', function() {
		verificaAutoridade();
	});	
	
	$('#genero').bind('change', function() {
		verificaAutoridade();
    	$('#decdoc').show();
    	$('#botoes').show();
    	$('#emissor').show();    	
    	$('#fechofieldset').show();		
	});	
	
	var rascunhoVocativo = "";
	
	function verificaAutoridade()
	{
		var generoAutoridade = $('#genero').val();
					
		if(generoAutoridade != 0)
		{

	     	$.get(
		 	           '../../sisgeof/oficio/atualizacampos',
		 	          {cargoAutoridade: $('#cargorecept').val(), genero: generoAutoridade, lotacao: $('#idLotacao').val()},
		 	            function(data){

				        	var jsondata = JSON.parse(data);

				 	        if(jsondata.permissao != 0)
				 	        {							
								if(rascunhoVocativo == "")
								{
									if($("#tipodestinogrupo").val() != "p")
										$("#vocativoinput").val( jsondata.tratgenero + " " + $('#cargorecept').val() + ",");
									else
										$("#vocativoinput").val( jsondata.tratgenero + " " + $('#nomerecept').val() + ",");									
								
								}else
									rascunhoVocativo = "";
					            $("#fechoinput").val( jsondata.trathiera);	
					            $("#enderecamento").val( jsondata.tratend);	
				 	        }else
				 	        {
				            	$('#corpo').hide();
				            	$('#decdoc').hide();				            
				            	$('#botoes').hide();
				            	$('#destino').hide();
				            	$('#emissor').hide();
				            	$('#autoridade').hide();
				            	$('#fechofieldset').hide();
				            	$("#idLotacao").val( 0);
				            	$("#cargorecept").val( "");
				            	$("#genero").val( "");
				            	$("#num").html("");		           
				            	
				 	        	loadPopup("Você não tem permissão para o envio de ofício à autoridade informada");
				 	        }			        	
		 	});						
			
				
	     	$('#corpo').show();	
		}else
		{
			$('#corpo').hide();
		}		
	}		
	
	$('#idLotacao').bind('change', function() {
		atualizaSelectLotacao();
	});	
	
	function atualizaSelectLotacao()
	{
		lotacao = $('#idLotacao').val();
		if(lotacao != 0)
		{
			verificaAutoridade();			
			$.post("../../sisgeof/oficio/verificaautdoc", 
					{idtipo_documento: 1, idlotacao: lotacao},
					   function(data) {
			            
			            var jsondata = JSON.parse(data);

 		 	            $selectcargo = $("select[name='cargoemis']");
 		 	          	$selectcargo.empty(); 

 		 	         	$("<option value='"+jsondata.tratamentogestor+"'>"+jsondata.tratamentogestor+"</option>").appendTo($selectcargo); 		 	        	 	
 		 	         	$("<option value='"+jsondata.tratamentogestor+" SUBSTITUT"+jsondata.sexo+"'>"+jsondata.tratamentogestor+" SUBSTITUT"+jsondata.sexo+"</option>").appendTo($selectcargo);			          
			            $("#nomeemis").tokenInput("clear");
			            $("#nomeemis").tokenInput("add", {idPessoa: jsondata.idpessoa, nome: jsondata.nomegestor});
			            
			            if(jsondata.autorizacao == 1)
			            {			           			            	
			            	$('#autoridade').show();
			            	$('#documento').html("Ofício");
							$("#num").html(jsondata.htmlproxnum);
							$("#proxNum").mask("9999");
							
			            	
			            }else
			            {
			            	$('#corpo').hide();
			            	$('#decdoc').hide();				            
			            	$('#botoes').hide();
			            	$('#destino').hide();
			            	$('#emissor').hide();
			            	$('#fechofieldset').hide();
			            	$('#autoridade').hide();
							$("#num").html("");
							$("#idLotacao").val(0);
			            	loadPopup("Geração de ofício não permitida");
			            }    
			                       
			});					
		}else
		{
        	$('#corpo').hide();
        	$('#decdoc').hide();				            
        	$('#botoes').hide();
        	$('#destino').hide();
        	$('#emissor').hide();
			$('#entidade1').hide();
			$('#entidade2').hide();
        	$('#autoridade').hide();
        	$('#fechofieldset').hide();        		
        	$('#documento').html("Ofício");		
		}						
	}

	function confirmDelete()
	{
		return confirm('Obs: O sistema não permite a alteração de documentos salvos. Deseja confirmar a operação?');
	}
	
	$('#visualizar').click(function(e) {
		    e.preventDefault();
		    var validForm = $('#formular');
		   
		    formataCorpoVisualizacao();
		    
		    validForm.attr("action", "../../sisgeof/oficio/visualizar");
		    tinyMCE.triggerSave();
		      
		    validForm.nyroModal({
                callbacks: {
                    beforeShowCont: function (nm) {
						$('.nyroModalCont').css('overflowY', 'auto');
						$('.nyroModalCont').css('overflowX', 'hidden');						
                    }					
                }
            }).nmCall();

	 });
	$('#salvar').click(function(e) {
	    e.preventDefault();

	    var validForm = $('#formular');

		validForm.unbind('submit.nyroModal');
		tinyMCE.triggerSave();
 
	    validForm.attr("action", "../../sisgeof/oficio/geraroficio");  
	    	    
		
	    validForm.submit();
	    
 	});

	$("#cep").mask("00.000-000");
 		 
	$("#nomeemis").tokenInput("../../sisgeof/documento/getautocompleteemissor", {
        onAdd: function (item) {
			if((typeof item.idPessoa != "undefined")&&(item.idPessoa != 0))
			{
    	     	$.get(
 		 	           '../../sisgeof/memorando/atualizacargoemissor',
 		 	           {idPessoa: item.idPessoa, idLotacao: $('#idLotacao').val()},
 		 	            function(data){

	 		 	            var jsondata = JSON.parse(data);
	 		 	            $selectcargo = $("select[name='cargoemis']");
	 		 	         	$selectcargo.empty(); 	 		 	              
	 		 	         	$("<option value='"+jsondata.tratamentogestor+"'>"+jsondata.tratamentogestor+"</option>").appendTo($selectcargo); 		 	        	 	
	 		 	         	$("<option value='"+jsondata.tratamentogestor+" SUBSTITUT"+jsondata.sexo+"'>"+jsondata.tratamentogestor+" SUBSTITUT"+jsondata.sexo+"</option>").appendTo($selectcargo);
	 	        	 	
 		 		});            	
			}
        }
	});		

	$.blockUI({ 
        message: '<h3>Carregando página...</h3>' 
    });
	setTimeout($.unblockUI, onload); 
	
	function setTipoDestino(valor)
	{
		if(valor == 'n')
		{
	        	$('#destino').show('slow', function() {});
				$('#entidade2').removeClass('align-esq').addClass('align-dir');

				if($('#idreceptor').val() == "")
					$('#entidade2').hide('slow', function() {});				
				$('#entidade1').show('slow', function() {});		
				if($("#tipodestinogrupo").val() == "p")
				{
					$("#nomerecept").tokenInput3("clear");
					$("#cargorecept").val("");
					$("#vocativoinput").val("");										
				}
				$("#tipodestinogrupo").val("n");
				
		}else
		{
			if(valor == 'e')
			{
	        	$('#destino').hide('slow', function() {}); 			
				$('#entidade2').removeClass('align-esq').addClass('align-dir');
				if($('#idreceptor').val() == "")
					$('#entidade2').hide('slow', function() {});
				$('#entidade1').show('slow', function() {});							
				
				if($("#tipodestinogrupo").val() == "p")
				{
					$("#nomerecept").tokenInput3("clear");								
					$("#cargorecept").val("");
					$("#vocativoinput").val("");					
				}
				$("#tipodestinogrupo").val("e");
			}else
			{
				if(valor == 'p')
				{	
					$('#destino').show('slow', function() {});	
					$('#entidade1').hide('slow', function() {});
					$('#entidade2').removeClass('align-dir').addClass('align-esq');	
					$('#entidade2').show('slow', function() {});				
					
					$('#idreceptor').val('');
					
					$("#entrecept").tokenInput2("clear");
					$("#nomerecept").tokenInput3("clear");
					$("#cargorecept").val("");
					$("#vocativoinput").val("");					
					$("#tipodestinogrupo").val("p");

				}else
				{
					$('#entidade1').hide();
					$('#entidade2').hide();				
				}
			}
		}				
	}
    
	$( "button.btn" ).on( "click", function() {
		setTipoDestino($(this).val());
	});
});	