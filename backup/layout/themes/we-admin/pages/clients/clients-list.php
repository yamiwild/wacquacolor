<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php if(isset($msg)){echo $msg;} ?>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Listagem de Clientes
        </div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th># COD</th>
                <th>Cliente</th>
                <th>CNPJ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($clients) && count($clients) > 0):
                foreach ($clients as $c):
                    echo '<tr>';
                    echo '<td>#'.$c->CLI_COD.'</td>';
                    echo '<td>'.$c->CLI_NAME.'</td>';
                    echo '<td>'.$c->CLI_CNPJ.'</td>';
                    echo '<td>';
                    echo '<a href="'.base_url().'clients/edit/'.$c->CLI_COD.'" class="btn default btn-xs blue"><i class="fa fa-edit"></i> Editar </a>';
                    echo '<a class="btn default btn-xs red" data-toggle="modal" href="#remove'.$c->CLI_COD.'"><i class="fa fa-trash-o"></i> Excluir </a>';
                    echo '</td>';
                    echo '</td>';
                    echo '</tr>';
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="remove<?=$c->CLI_COD?>" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Exclusão de Cliente</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Atenção, este registro será apagado e não ficará mais disponível. Todos os outros registros dependentes deste, serão apagados também.</p>
                                    <p>Deseja prosseguir com a exclusão?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                                    <a href="<?php echo base_url().'clients/delete/'.$c->CLI_COD ?>" class="btn blue">Continuar</a>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- Fim  Modal -->
                <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>

    </div>
</div>