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


}