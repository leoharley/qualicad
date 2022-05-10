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

		$exportacao = $this->ExportacaoModel->exportaFatItem_Tudo();

		header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array('Id_FatItem', 'CodFatItem', 'TbFaturamento_Id_Faturamento'));
   /*     $i = 1;
        foreach ($exportacao as $data) {
            fputcsv($handle, array($i, $data["Id_FatItem"], $data["CodFatItem"], $data["TbFaturamento_Id_Faturamento"]));
            $i++;
        }*/
            fclose($handle);
        exit;
    }


}