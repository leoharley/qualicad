<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Admin (AdminController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Exportacao extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('ImportacaoModel');
        $this->load->model('PermissaoModel');
        $this->load->model('PrincipalModel');
        $this->load->model('CadastroModel');
        $this->load->model('ExportacaoModel');
        // Datas -> libraries ->BaseController / This function used load user sessions
        $this->datas();
        // isLoggedIn / Login control function /  This function used login control
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('login');
        }
        
        else
        {
            // isAdmin / Admin role control function / This function used admin role control
            if($this->isAdmin() == TRUE)
            {
                $this->accesslogincontrol();
            }
        }
    }

    //  EXPORTACAO FAT ITEM

    function exportaFatItem()
    {
        $var = $this->uri->segment(2);

        /* file name */
		$filename = 'TbFatItem.csv';

		$exportacao = $this->ExportacaoModel->exportaFatItem($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Id_FatItem', 'CodFatItem', 'TbFaturamento_Id_Faturamento',
        'Ds_FatItem','Dt_IniVigencia','Dt_FimVigencia','Vl_Honorario','Vl_Operacional','Vl_Total',
        'Vl_Filme','Cd_PorteMedico','Cd_TUSS','Cd_TISS','Qt_Embalagem','Ds_Unidade','Tp_Ativo'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->Id_FatItem, $data->CodFatItem, $data->TbFaturamento_Id_Faturamento,
            $data->Ds_FatItem,$data->Dt_IniVigencia,$data->Dt_FimVigencia,$data->Vl_Honorário,$data->Vl_Operacional,
            $data->Vl_Total,$data->Vl_Filme,$data->Cd_PorteMedico,$data->Cd_TUSS,$data->Cd_TISS,$data->Qt_Embalagem,
            $data->Ds_Unidade,$data->Tp_Ativo),'|');
        }
            fclose($handle);
        exit;
    }

    //  EXPORTACAO GRUPOPRO

    function exportaGrupoPro()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'TbGrupoPro.csv';

        $exportacao = $this->ExportacaoModel->exportaGrupoPro($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('CdGrupoPro', 'Ds_GrupoPro', 'Tp_GrupoPro',
            'Desc_Tp_GrupoPro','Dt_Criacao','Tp_Ativo'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->CdGrupoPro, $data->Ds_GrupoPro, $data->Tp_GrupoPro,
                $data->Desc_Tp_GrupoPro,$data->Dt_Criacao,$data->Tp_Ativo),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO PROFAT

    function exportaProFat()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'TbProFat.csv';

        $exportacao = $this->ExportacaoModel->exportaProFat($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('CodProFat', 'Ds_ProFat', 'Ds_Unidade',
            'TbGrupoPro_CodGrupo','Tp_Ativo'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->CodProFat, $data->Ds_ProFat, $data->Ds_Unidade,
                $data->TbGrupoPro_CodGrupo,$data->Tp_Ativo),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO TUSS

    function exportaTUSS()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'TbTUSS.csv';

        $exportacao = $this->ExportacaoModel->exportaTUSS($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('TbProFat_Cd_ProFat', 'TbConvenio_Id_Convenio', 'Cd_Tuss',
            'Ds_Tuss','Dt_IniVigencia','Dt_FimVigencia'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->TbProFat_Cd_ProFat, $data->TbConvenio_Id_Convenio, $data->Cd_Tuss,
                $data->Ds_Tuss,$data->Dt_IniVigencia,$data->Dt_FimVigencia),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO REGRAGRUPRO

    function exportaRegraGruPro()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'Tb_RegraGruPro.csv';

        $exportacao = $this->ExportacaoModel->exportaRegraGruPro($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('TbGrupoPro_CodGrupo', 'TbRegra_Id_Regra', 'TbFaturamento_Id_Faturamento',
            'Perc_Pago','Dt_IniVigencia','Dt_FimVigencia'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->TbGrupoPro_CodGrupo, $data->TbRegra_Id_Regra, $data->TbFaturamento_Id_Faturamento,
                $data->Perc_Pago,$data->Dt_IniVigencia,$data->Dt_FimVigencia),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO FRACAOSIMPROBRA

    function exportaFracaoSimproBra()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'Tb_FracaoSimproBra.csv';

        $exportacao = $this->ExportacaoModel->exportaFracaoSimproBra($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('TbProFat_Cd_ProFat', 'TbFaturamento_Id_Faturamento', 'TbTUSS_Id_Tuss',
            'Ds_FracaoSimproBra','Ds_Laboratorio','Ds_Apresentacao','Tp_MatMed','Vl_FatorDivisao','Qt_Prod'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->TbProFat_Cd_ProFat, $data->TbFaturamento_Id_Faturamento, $data->TbTUSS_Id_Tuss,
                $data->Ds_FracaoSimproBra,$data->Ds_Laboratorio,$data->Ds_Apresentacao,$data->Tp_MatMed,$data->Vl_FatorDivisao,
                $data->Qt_Prod),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO PRODUTO

    function exportaProduto()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'Tb_Produto.csv';

        $exportacao = $this->ExportacaoModel->exportaProduto($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('TbProFat_Cd_ProFat', 'Tb_Unidade_Id_Unidade', 'Cd_Produto',
            'Ds_Produto','Ds_Especie','Cd_ProdutoMestre','SN_Mestre','Vl_CustoMedio','Vl_Fator',
            'Vl_FatorProFat','Vl_CustoFinal'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->TbProFat_Cd_ProFat, $data->Tb_Unidade_Id_Unidade, $data->Cd_Produto,
                $data->Ds_Produto,$data->Ds_Especie,$data->Cd_ProdutoMestre,$data->SN_Mestre,$data->Vl_CustoMedio,
                $data->Vl_Fator,$data->Vl_FatorProFat,$data->Vl_CustoFinal),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO PRODUCAO

    function exportaProducao()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'Tb_Producao.csv';

        $exportacao = $this->ExportacaoModel->exportaProducao($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('TbProFat_Cd_ProFat', 'TbPlano_Id_Plano', 'Num_Conta',
            'Num_Atendimento','Dt_Lancamento','Qt_Lancamento','Vl_Conta','Cd_Movimento','Cd_ITMovimento'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->TbProFat_Cd_ProFat, $data->TbPlano_Id_Plano, $data->Num_Conta,
                $data->Num_Atendimento,$data->Dt_Lancamento,$data->Qt_Lancamento,$data->Vl_Conta,$data->Cd_Movimento,
                $data->Cd_ITMovimento),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO CONTRATO

    function exportaContrato()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'Tb_Contrato.csv';

        $exportacao = $this->ExportacaoModel->exportaContrato($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Cd_EmpresaERP', 'Cd_ConvenioERP', 'Cd_PlanoERP', 'Cd_ProFatERP', 'Cd_IndiceERP', 
        'Ds_IndiceERP', 'Dt_VigenciaIndiceERP', 'Vl_IndiceERP', 'Vl_FilmeIndiceERP', 'Vl_HonorarioIndiceERP', 
        'Vl_UCOIndiceERP', 'Cd_RegraERP', 'Ds_RegraERP', 'Cd_TabFatERP', 'Ds_TabFatERP', 'Cd_MoedaERP', 
        'Ds_MoedaERP', 'Cd_RegraGruProErp', 'Ds_RegraGruProErp', 'Per_RegraPGErp', 'Ds_ProFatERP', 'UnidadeProFatERP', 
        'Vl_ProHonorarioERP', 'Vl_ProOperaçãoERP', 'Vl_ProTotalERP', 'Vl_ProExcecValorERP', 'Ds_PrestadoraExcec', 
        'Qtde_M2FilmeERP', 'Cd_PortMedicoERP', 'Ds_PortMedicoERP', 'Vl_PorteMedicoERP', 'Cd_ExcecPorMedicoERP', 
        'Vl_ExcecPorMedicoERP', 'Vl_FinalERP', 'Vl_FinalExecERP', 'Tp_ProibicaoERP'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->Cd_EmpresaERP, $data->Cd_ConvenioERP, $data->Cd_PlanoERP,
                $data->Cd_ProFatERP,$data->Cd_IndiceERP,$data->Ds_IndiceERP,$data->Dt_VigenciaIndiceERP,$data->Vl_IndiceERP,
                $data->Vl_FilmeIndiceERP,$data->Vl_HonorarioIndiceERP,$data->Vl_UCOIndiceERP,$data->Cd_RegraERP,
                $data->Ds_RegraERP,$data->Cd_TabFatERP,$data->Ds_TabFatERP,$data->Cd_MoedaERP,$data->Ds_MoedaERP,
                $data->Cd_RegraGruProErp,$data->Ds_RegraGruProErp,$data->Per_RegraPGErp,$data->Ds_ProFatERP,$data->UnidadeProFatERP,
                $data->Vl_ProHonorarioERP,$data->Vl_ProOperaçãoERP,$data->Vl_ProTotalERP,$data->Vl_ProExcecValorERP,$data->Ds_PrestadoraExcec,
                $data->Qtde_M2FilmeERP,$data->Cd_PortMedicoERP,$data->Ds_PortMedicoERP,$data->Vl_PorteMedicoERP,$data->Cd_ExcecPorMedicoERP,
                $data->Vl_ExcecPorMedicoERP,$data->Vl_FinalERP,$data->Vl_FinalExecERP,$data->Tp_ProibicaoERP),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO PORTE MEDICO

    function exportaPorteMedico()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'TbPorteMedico.csv';

        $exportacao = $this->ExportacaoModel->exportaPorteMedico($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Id_PorteMedico', 'Id_TabFaturamento', 'Cd_PorteMedico',
            'Ds_PorteMedico','Vl_PorteMedico'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->Id_PorteMedico, $data->Id_TabFaturamento, $data->Cd_PorteMedico,
                $data->Ds_PorteMedico,$data->Vl_PorteMedico),'|');
        }
        fclose($handle);
        exit;
    }

    //  EXPORTACAO EXCECAO VALORES

    function exportaExcecaoValores()
    {
        $var = $this->uri->segment(2);

        /* file name */
        $filename = 'TbExcValores.csv';

        $exportacao = $this->ExportacaoModel->exportaExcecaoValores($this->session->userdata('IdEmpresa'),$var);

        header('Content-type: aapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename.'');
        header('Pragma: no-cache');
        header('Cache-Control: max-age=0');
        header('X-Accel-Buffering: no');
        ob_clean();
        flush();

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Id_ExcValores', 'CD_Convenio', 'Cd_TUSS',
            'Cd_ProFat','Ds_ExcValores','ClasseEvento','Tp_ExcValores',
            'Vl_ExcValores'),'|');

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->Id_ExcValores, $data->CD_Convenio, $data->Cd_TUSS,
                $data->Cd_ProFat,$data->Ds_ExcValores,$data->ClasseEvento,$data->Tp_ExcValores,
                $data->Vl_ExcValores),'|');
        }
        fclose($handle);
        exit;
    }

    /* EXPORTACAO BI */
    function exportacaoBI()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Exportação BI';
        
        $data['empresasPerfilUsuario'] = $this->CadastroModel->carregaEmpresasPerfilUsuario($this->session->userdata('userId'));
        $data['infoConvenio'] = $this->PrincipalModel->carregaInfoConveniosEmpresa($this->session->userdata('IdEmpresa'));    

        $this->loadViews("qualicad/exportacao/exportacaoBI", $this->global, $data, NULL);
    }


    function exportaBI()
    {
        set_time_limit(0);

        if ($this->input->post('offset') < 1) {
            $offset = 0;
        } else {
            $offset = $this->input->post('offset');
        }

        $offset = $offset + 25000;

        $limit = 25000;

        $idConvenio = $this->input->post('TbConvenio_Id_Convenio');
        $idEmpresa = $this->input->post('Id_Empresa');

        $consultaConvenioBI = $this->ExportacaoModel->consultaConvenioBI($idEmpresa,$idConvenio,$limit,$offset);

        $memData = array();
        if(!empty($consultaConvenioBI)){

            $insertCountConvenio = $notAddCountConvenio = 0;

            foreach($consultaConvenioBI as $row) {
                foreach($row as $key => $value) {
                $memData += array(
                    $key => $value
                );
                }
                $memData += array(
                    'Tp_Ativo'=> 'S');

                $insert = $this->ExportacaoModel->adicionaConvenio($memData);

                if($insert != 0){
                    $insertCountConvenio++;
                } else {
                    $notAddCountConvenio++;
                }

                $memData = array();
            }
        }

        $consultaContratoBI = $this->ExportacaoModel->consultaContratoBI($this->ExportacaoModel->consultaCodERPEmpresa($idEmpresa)[0]->Cd_EmpresaERP,$idConvenio,$limit,$offset);

        $memData = array();
        if(!empty($consultaContratoBI)) {

            $insertCountContrato = $notAddCountContrato = 0;

            foreach ($consultaContratoBI as $row) {
                foreach ($row as $key => $value) {
                    $memData += array(
                        $key => $value
                    );
                }
                $memData += array(
                    'Tp_Ativo' => 'S');

                $insert = $this->ExportacaoModel->adicionaContrato($memData);

                if ($insert != 0) {
                    $insertCountContrato++;
                } else {
                    $notAddCountContrato++;
                }

                $memData = array();
            }
        }


        $this->session->set_flashdata('offset', $offset);

        if ($insertCountConvenio == '')
        {
            $msgInseridosConvenio = 'Todas as linhas foram inseridas' ;
        } else {
            $msgInseridosConvenio = 'Inseridos agora ('.$insertCountConvenio.')';
        }

        if ($insertCountContrato == '')
        {
            $msgInseridosContrato = 'Todas as linhas foram inseridas' ;
        } else {
            $msgInseridosContrato = 'Inseridos agora ('.$insertCountContrato.')';
        }

        $successMsg = 'MSG TEMPORÁRIA: TABELA TMP_CONVENIO ATUALIZADA COM SUCESSO! '.$msgInseridosConvenio.' | Não inseridos ('.$notAddCountConvenio.')<br/>
                        MSG TEMPORÁRIA: TABELA TMP_CONTRATO ATUALIZADA COM SUCESSO! '.$msgInseridosContrato.' | Não inseridos ('.$notAddCountContrato.')';
        
        $this->session->set_flashdata('success', $successMsg);

        $this->session->set_flashdata('idconvenio', $idConvenio);

        redirect('exportacaoBI');
    }





}