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
		$filename = 'users_'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
	   /* get data */
		$exportacao = $this->ExportacaoModel->exportaFatItem_Tudo();
		/* file creation */
		$file = fopen("php://output","w");
		$header = array("Id_FatItem","CodFatItem","TbFaturamento_Id_Faturamento","Ds_FatItem","Dt_IniVigencia",
        "Dt_FimVigencia","Vl_Honorário","Vl_Operacional","Vl_Total","Vl_Filme","Cd_PorteMedico","Cd_TUSS",
        "Cd_TISS","Qt_Embalagem","Ds_Unidade"); 
		fputcsv($file, $header);
		foreach ($exportacao as $line){ 
			fputcsv($file, $line); 
		}
        exit;
		fclose($file); 
		exit;
    }


}