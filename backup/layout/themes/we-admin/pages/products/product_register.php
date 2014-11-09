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
                                                echo '<option value="'. $c->PCA_COD . '">' . $c->PCA_NAME . '</option>';
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
                                    <input type="text" name="pr_name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Código do Produto
                                    <span class="required">	* </span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="pr_cod_ref" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Dimensões</label>
                                <div class="col-md-6">
                                    <input type="text" name="pr_dimension" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Imagens</label>
                                <div class="col-md-6">
                                    <input type="file" name="pg_image[]" class="form-control" multiple>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Descrição</label>
                                <div class="col-md-9">
                                    <textarea name="pr_description" class="ckeditor form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Adicionar</button>
                                </div>
                            </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>