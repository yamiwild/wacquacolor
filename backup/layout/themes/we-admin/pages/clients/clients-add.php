<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Cadastro de Cliente</b>
                </div>
            </div>
            <div class="portlet-body form">
                <?php if(isset($msg)){echo $msg;};?>
                <!-- BEGIN FORM-->
                <form id="form_sample_1" class="form-horizontal" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Cliente
                                <span class="required">	* </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="cli_name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">CNPJ
                                <span class="required">	* </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="cli_cnpj" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">E-mail
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="cli_email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Telefone
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="cli_telefone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Nome para Contato
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="cli_contact_name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Descrição
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="cli_description"></textarea>
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