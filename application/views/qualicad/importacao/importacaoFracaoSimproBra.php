<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Importa FracaoSimproBra
            <small>Importação</small>
        </h1>
    </section>

    <section class="content">

      
<div class="container">
    <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
    ?>
    <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php } ?>
    <?php  
            $success = $this->session->flashdata('success');
            if($success)
            {
        ?>
    <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php } ?>
	
    <div class="row">
		
        <!-- File upload form -->
        <div class="col-md-12" id="importFrm">
            <form action="<?php echo base_url() ?>importaFracaoSimproBra" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <br/>
                <input type="submit" class="btn btn-primary" name="importSubmit" id="importSubmit" value="IMPORTAR">
            </form>
        </div>
        
        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>TbProFat_Cd_ProFat</th>
                    <th>TbFaturamento_Id_Faturamento</th>
                    <th>TbTUSS_Id_Tuss</th>
                    <th>Ds_FracaoSimproBra</th>
                    <th>Ds_Laboratorio</th>
                    <th>Ds_Apresentacao</th>
                    <th>Tp_MatMed</th>
                    <th>Vl_FatorDivisao</th>
                    <th>Qt_Prod</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($infoFracaoSimproBra)){ foreach($infoFracaoSimproBra as $registro){ ?>
                <tr>
                    <td><?php echo $registro->TbProFat_Cd_ProFat ?></td>
                    <td><?php echo $registro->TbFaturamento_Id_Faturamento ?></td>
                    <td><?php echo $registro->TbTUSS_Id_Tuss ?></td>
                    <td><?php echo $registro->Ds_FracaoSimproBra ?></td>
                    <td><?php echo $registro->Ds_Laboratorio ?></td>
                    <td><?php echo $registro->Ds_Apresentacao ?></td>
                    <td><?php echo $registro->Tp_MatMed ?></td>
                    <td><?php echo $registro->Vl_FatorDivisao ?></td>
                    <td><?php echo $registro->Qt_Prod ?></td>
                </tr>
                <?php } }else{ ?>
                <tr><td colspan="5">Nenhum registro encontrado...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</section>
</div>

<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
$(document).ready(function () {
        $('#importSubmit').attr('disabled', true);
        $('input:file').change(
            function () {
                if ($(this).val()) {
                    $('#importSubmit').removeAttr('disabled');
                }
                else {
                    $('#importSubmit').attr('disabled', true);
                }
            });
    });
</script>