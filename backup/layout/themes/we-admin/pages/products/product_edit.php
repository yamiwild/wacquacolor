<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Cadastro de Produto</b>
                </div>
            </div>
            <div class="portlet-body form">
                <?php if(isset($msg)){echo $msg;};?>
                <?php if(isset($product) && !is_null($product)) : ?>
                <!-- BEGIN FORM-->
                <form id="form_sample_1" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Categoria
                                <span class="required">	* </span>
                            </label>
                            <div class="col-md-6">
                                <select name="pca_cod" class="form-control select2me">
                                    <?php
                                    if(isset($categories) && count($categories) > 0):
                                        foreach($categories as $c):
                                            $selected = '';
                                            if($product->PCA_COD == $c->PCA_COD)
                                                $selected = 'selected';
                                            echo '<option value="'. $c->PCA_COD . '" ' . $selected . '>' . $c->PCA_NAME . '</option>';
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Nome do Produto
                                <span class="required">	* </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="pr_name" class="form-control" value="<?=$product->PR_NAME?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Código do Produto
                                <span class="required">	* </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="pr_cod_ref" class="form-control" value="<?=$product->PR_COD_REF?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Dimensões</label>
                            <div class="col-md-6">
                                <input type="text" name="pr_dimension" class="form-control" value="<?=$product->PR_DIMENSION?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Imagens</label>
                            <div class="col-md-6">
                                <input type="file" name="pg_image[]" class="form-control" multiple>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-6">
                                <?php if((int) $product->G_QTD > 0 && isset($gallery)): ?>
                                    <table class="table table-hover">
                                        <tbody>
                                        <?php foreach($gallery as $g): ?>
                                        <tr>
                                            <td><?=$g->PG_IMAGE?></td>
                                            <td>
                                                <a href="<?=base_url()?>products/gallery/delete/<?=$g->PG_COD?>/<?=$g->PR_COD?>" class="btn default btn-xs red">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <a href="<?=base_url_project()?>public/products/<?=$g->PR_COD?>/<?=$g->PG_IMAGE?>" target="_blank" class="btn default btn-xs blue">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Descrição</label>
                            <div class="col-md-9">
                                <textarea name="pr_description" class="ckeditor form-control">
                                    <?=$product->PR_DESCRIPTION?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Salvar</button>
                            </div>
                        </div>
                </form>
                <!-- END FORM-->
                <?php endif; ?>
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>