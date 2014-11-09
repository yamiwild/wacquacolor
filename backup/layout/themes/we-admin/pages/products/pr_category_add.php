<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Adicionar Categoria
                </div>
            </div>
            <div class="portlet-body form">
                <?php if(isset($msg)){echo $msg;};?>
                <!-- BEGIN FORM-->
                <form id="form_sample_1" class="form-horizontal" method="post">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Nome da Categoria <span class="required">
							* </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="pca_name" class="form-control">
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