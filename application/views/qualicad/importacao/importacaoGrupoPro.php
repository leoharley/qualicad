<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Importa Grupo Pro
            <small>Importação</small>
        </h1>
    </section>

    <section class="content">

      
<div class="container">
    <h2>Grupo Pro</h2>
	
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
            <form action="<?php echo base_url('members/import'); ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORTAR">
            </form>
        </div>
        
        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>CodGrupo</th>
                    <th>Ds_GrupoPro</th>
                    <th>Tp_GrupoPro</th>
                    <th>Dt_Criacao</th>
                    <th>Tp_Ativo</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($infoGrupoPro)){ foreach($infoGrupoPro as $row){ ?>
                <tr>
                    <td><?php echo $row['CodGrupo']; ?></td>
                    <td><?php echo $row['Ds_GrupoPro']; ?></td>
                    <td><?php echo $row['Tp_GrupoPro']; ?></td>
                    <td><?php echo $row['Dt_Criacao']; ?></td>
                    <td><?php echo $row['Tp_Ativo']; ?></td>
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
</script>