<!-- BEGIN EXAMPLE TABLE PORTLET-->
<?php if(isset($msg)){echo $msg;} ?>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Listagem de Categorias
        </div>
        <div class="tools">
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th># SYS COD</th>
                <th># COD</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Imagens</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($products) && count($products) > 0 && $products != 0):
                foreach ($products as $p):
                    echo '<tr>';
                    echo '<td># '.$p->PR_COD.'</td>';
                    echo '<td># '.$p->PR_COD_REF.'</td>';
                    echo '<td>'.$p->PR_NAME.'</td>';
                    echo '<td>'.$p->PCA_NAME.'</td>';
                    echo '<td>'.$p->G_QTD.'</td>';
                    echo '<td>';
                    echo '<a href="'.base_url().'products/edit/'.$p->PR_COD.'" class="btn default btn-xs blue"><i class="fa fa-edit"></i> Editar </a>';
                    echo '<a class="btn default btn-xs red" data-toggle="modal" href="#remove'.$p->PR_COD.'"><i class="fa fa-trash-o"></i> Excluir </a>';
                    echo '</td>';
                    echo '</td>';
                    echo '</tr>';
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="remove<?=$p->PR_COD?>" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Exclusão de Produtos</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Atenção, este registro será apagado e não ficará mais disponível. Todos os outros registros dependentes deste, serão apagados também.</p>
                                    <p>Deseja prosseguir com a exclusão?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                                    <a href="<?php echo base_url().'products/delete/'.$p->PR_COD ?>" class="btn blue">Continuar</a>
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