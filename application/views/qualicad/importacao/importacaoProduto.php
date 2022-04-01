<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Importa Produto
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
            <form action="<?php echo base_url() ?>importaProduto" method="post" enctype="multipart/form-data">
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
                    <th>Tb_Unidade_Id_Unidade</th>
                    <th>Cd_Produto</th>
                    <th>Ds_Produto</th>
                    <th>Ds_Especie</th>
                    <th>Cd_ProdutoMestre</th>
                    <th>SN_Mestre</th>
                    <th>Vl_CustoMedio</th>
                    <th>Vl_Fator</th>
                    <th>Vl_FatorProFat</th>
                    <th>Vl_CustoFinal</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($infoProduto)){ foreach($infoProduto as $registro){ ?>
                <tr>
                    <td><?php echo $registro->TbProFat_Cd_ProFat ?></td>
                    <td><?php echo $registro->Tb_Unidade_Id_Unidade ?></td>
                    <td><?php echo $registro->Cd_Produto ?></td>
                    <td><?php echo $registro->Ds_Produto ?></td>
                    <td><?php echo $registro->Ds_Especie ?></td>
                    <td><?php echo $registro->Cd_ProdutoMestre ?></td>
                    <td><?php echo $registro->SN_Mestre ?></td>
                    <td><?php echo $registro->Vl_CustoMedio ?></td>
                    <td><?php echo $registro->Vl_Fator ?></td>
                    <td><?php echo $registro->Vl_FatorProFat ?></td>
                    <td><?php echo $registro->Vl_CustoFinal ?></td>
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