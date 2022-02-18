<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Convênio
            <small>Associar / Adicionar</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Selecione e preencha os campos abaixo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomeempresa">Empresa associada</label>
                                        <select class="form-control required" id="nomeempresa" name="nomeempresa">
                                            <option value="1">EMPRESA_1</option>
											<option value="2">EMPRESA_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsconvenio">Descrição</label>
                                        <input type="text" class="form-control required email" id="dsconvenio" value="<?php echo set_value('dsconvenio'); ?>" name="dsconvenio"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cnpjconvenio">CNPJ</label>
                                        <input type="text" class="form-control required email" id="cnpjconvenio" value="<?php echo set_value('cnpjconvenio'); ?>" name="cnpjconvenio"
                                            maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cdconvenioerp">Código</label>
                                        <input type="text" class="form-control required email" id="cdconvenioerp" value="<?php echo set_value('cdconvenioerp'); ?>" name="cdconvenioerp"
                                            maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tpconvenio">Tipo</label>
                                        <select class="form-control required" id="tpconvenio" name="tpconvenio">
                                            <option value="1">TIPO_CONVENIO_1</option>
											<option value="2">TIPO_CONVENIO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtinicioconvenio">Data de ínicio</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtinicioconvenio'); ?>" id="dtinicioconvenio" name="dtinicioconvenio">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtvigenciaconvenio">Data de vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtvigenciaconvenio'); ?>" id="dtvigenciaconvenio" name="dtvigenciaconvenio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtcriacao">Data de criação</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtcriacao'); ?>" id="dtcriacao" name="dtcriacao">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input id="teste" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Salvar" />
                            <input type="reset" class="btn btn-default" value="Limpar" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
            </div>
        </div>


        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width:100%!important">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>


    </section>
</div>
<script>
    $('#exampleModal').on('click', function(e) {
        e.preventDefault();
        var url = "<?php echo base_url(); ?>principalPlano";
        $(".modal-body").html('<iframe width="1000px" height="500px" allowtransparency="true" src="'+url+'"></iframe>');
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>