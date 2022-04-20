<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Importa FatItem
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
            <form action="<?php echo base_url() ?>importaFatItem" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <br/>
                <input type="submit" class="btn btn-primary" name="importSubmit" id="importSubmit" value="IMPORTAR">
            </form>
        </div>

        <br/>


        <div class="row"
        <div class="col-md-3">
            <select class="form-control" id="TbFaturamento_Id_Faturamento" name="TbFaturamento_Id_Faturamento">
                <?php
                if(!empty($infoFaturamento))
                {
                    foreach ($infoFaturamento as $faturamento)
                    {
                        ?>
                        <option value="<?php echo $faturamento->Id_Faturamento  ?>">
                            <?php echo $faturamento->Id_Faturamento.' - '.$faturamento->Ds_Faturamento ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        </div>

        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Id_FatItem</th>
                    <th>Faturamento</th>
                    <th>Ds_FatItem</th>
                    <th>Vl_Honorário</th>
                    <th>Vl_Operacional</th>
                    <th>Vl_Total</th>
                    <th>Vl_Filme</th>
                    <th>Cd_PorteMedico</th>
                    <th>Cd_TUSS</th>
                    <th>Cd_TISS</th>
                    <th>Qt_Embalagem</th>
                    <th>Ds_Unidade</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($infoFatItem)){ foreach($infoFatItem as $registro){ ?>
                <tr>
                    <td><?php echo $registro->Id_FatItem ?></td>
                    <td><?php echo $registro->TbFaturamento_Id_Faturamento ?></td>
                    <td><?php echo $registro->Ds_FatItem ?></td>
                    <td><?php echo $registro->Vl_Honorário ?></td>
                    <td><?php echo $registro->Vl_Operacional ?></td>
                    <td><?php echo $registro->Vl_Total ?></td>
                    <td><?php echo $registro->Vl_Filme ?></td>
                    <td><?php echo $registro->Cd_PorteMedico ?></td>
                    <td><?php echo $registro->Cd_TUSS ?></td>
                    <td><?php echo $registro->Cd_TISS ?></td>
                    <td><?php echo $registro->Qt_Embalagem ?></td>
                    <td><?php echo $registro->Ds_Unidade ?></td>
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