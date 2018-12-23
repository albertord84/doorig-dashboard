<?php $this->load->view('template/head'); ?>



<table class="easyui-datagrid" title="Nodes"  style="width:auto;height:100%" id="grid_nodes"

			data-options="singleSelect:true,url:'<?php echo base_url() ?>/index.php/nodes/ajaxgrid',method:'post',toolbar:toolbar,autoRowHeight:false,fit:true,fitColumns:true,

				pagination:true,

				onHeaderContextMenu: function(e, field){

					e.preventDefault();

					if (!cmenu){

						createColumnMenu();

					}

					cmenu.menu('show', {

						left:e.pageX,

						top:e.pageY

					});

				},

				multiSort:true,

				pageSize:20">

		<thead>

			<tr>

         <th data-options="field:'name',width:80,sortable:true">Name</th>
         <th data-options="field:'description',width:80,sortable:true">Description</th>
         <th data-options="field:'ip',width:80,sortable:true">IP</th>
         <th data-options="field:'url',width:80,sortable:true">URL</th>


			</tr>

		</thead>

	</table>

	

	<div id="dlg_nodes" class="easyui-dialog" style="width:230px;height:auto;" title="Crear nodes" 

	data-options="	

	modal: true,

	closed:true,

	buttons: [{

					text:'Grabar',

					iconCls:'icon-ok',

					handler:function(){

			 $.messager.progress();

				

             $('#form_nodes').form('submit', {

             url: $('#op').val(),

             onSubmit: function(){

             var isValid = $(this).form('validate');

             if (!isValid){

             $.messager.progress('close');	 

			 $.messager.alert('Error en datos','Hay campos con datos incorrectos','error');

             }

             return isValid;	

             },

             success: function(){

             $.messager.progress('close');

             $.messager.alert('Info', 'Registro guardado correctamente.', 'info');

             $('#dlg_nodes').dialog('close');

             $('#grid_nodes').datagrid('reload');

             }

             });

					}

				},{

					text:'Cancelar',

					handler:function(){

						$('#dlg_nodes').dialog('close');

					}

				}]"

	>

	<div style="padding:5px">

	    <form id="form_nodes" method="post">

	    	<table>

         <tr><td>Name:</td><td><input class='easyui-validatebox' type='text' name='name' data-options='required:true'></input></td></tr>
         <tr><td>Description:</td><td><input class='easyui-validatebox' type='text' name='description' data-options='required:true'></input></td></tr>
         <tr><td>IP:</td><td><input class='easyui-validatebox' type='text' name='ip' data-options='required:true'></input></td></tr>
         <tr><td>URL:</td><td><input class='easyui-validatebox' type='text' name='url' data-options='required:true'></input></td></tr>


	    	</table>

	    </form>

	    </div>	

	

	</div>

	

	<input id="op" type="hidden"/>

	<script type="text/javascript">

		var toolbar = [{

			text:'Nuevo',

			iconCls:'icon-add',

			handler:function(){$('#form_nodes').form('reset');$('#dlg_nodes').dialog('open');$('#op').val('<?php echo base_url() ?>index.php/nodes/save');}

		},{

			text:'Borrar',

			iconCls:'icon-remove',

			handler:function(){

			var row = $('#grid_nodes').datagrid('getSelected');

			var rowSelect = $('#grid_nodes').datagrid('getSelections');

                if(rowSelect.length>0){

			

                        $.messager.confirm('Eliminar', '�Est� seguro de querer borrar este registro?', function(r){

                            if (r){

                                $.ajax( {

                                    type : "POST",

                                    url : '<?php echo base_url(); ?>index.php/nodes/delete/'+row.id,

                                    data : {

                                        

                                    },

                                    success: function (resp){

                                        $.messager.alert('Informaci�n','El registro se elimin� con �xito.','info');

										$('#grid_nodes').datagrid('reload');

                                    },

									error:function(resp)

									{

										var d = resp.responseText;

										$.messager.alert('Error',d,'error');

                            

									}

                                });

                                

                            }

                        });

				}

				

			}

		},'-',{

			text:'Modificar',

			iconCls:'icon-edit',

			handler:function(){

			var row = $('#grid_nodes').datagrid('getSelected');

			$('#form_nodes').form('reset');

            $('#form_nodes').form('load','<?php echo base_url() ?>index.php/nodes/load/'+row.id);

            $('#dlg_nodes').dialog('open');

            $('#op').val('<?php echo base_url() ?>index.php/nodes/update/'+row.id);

			}

		}];

		

		

		var cmenu;

    function createColumnMenu(){

        cmenu = $('<div/>').appendTo('body');

        cmenu.menu({

            onClick: function(item){

                if (item.iconCls == 'icon-ok'){

                    $('#grid_nodes').datagrid('hideColumn', item.name);

                    cmenu.menu('setIcon', {

                        target: item.target,

                        iconCls: 'icon-empty'

                    });

                } else {

                    $('#grid_nodes').datagrid('showColumn', item.name);

                    cmenu.menu('setIcon', {

                        target: item.target,

                        iconCls: 'icon-ok'

                    });

                }

            }

        });

        var fields = $('#grid_nodes').datagrid('getColumnFields');

        for(var i=0; i<fields.length; i++){

            var field = fields[i];

            var col = $('#grid_nodes').datagrid('getColumnOption', field);

            cmenu.menu('appendItem', {

                text: col.title,

                name: field,

                iconCls: 'icon-ok'

            });

        }

    }

	</script>

 <?php $this->load->view('template/footer'); ?>

