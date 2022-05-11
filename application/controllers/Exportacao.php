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

    // IMPORTAÇÃO GRUPO PRO

    function exportaFatItem_Tudo()
    {
        /* file name */
		$filename = 'TbFatItem.csv';

		$exportacao = $this->ExportacaoModel->exportaFatItem_Tudo($this->session->userdata('IdEmpresa'));

		header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel ");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Id_FatItem', 'CodFatItem', 'TbFaturamento_Id_Faturamento',
        'Ds_FatItem','Dt_IniVigencia','Dt_FimVigencia','Vl_Honorario','Vl_Operacional','Vl_Total',
        'Vl_Filme','Cd_PorteMedico','Cd_TUSS','Cd_TISS','Qt_Embalagem','Ds_Unidade','Tp_Ativo'));

        foreach ($exportacao as $data) {
            fputcsv($handle, array($data->Id_FatItem, $data->CodFatItem, $data->TbFaturamento_Id_Faturamento,
            $data->Ds_FatItem,$data->Dt_IniVigencia,$data->Dt_FimVigencia,$data->Vl_Honorário,$data->Vl_Operacional,
            $data->Vl_Total,$data->Vl_Filme,$data->Cd_PorteMedico,$data->Cd_TUSS,$data->Cd_TISS,$data->Qt_Embalagem,
            $data->Ds_Unidade,$data->Tp_Ativo));
        }
            fclose($handle);
        exit;
    }


}