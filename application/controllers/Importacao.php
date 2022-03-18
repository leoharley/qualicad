<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Admin (AdminController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Importacao extends BaseController
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

    // INICIO DAS FUNÇÕES DA TELA DE CONVENIO

    function importacaoGrupoPro()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Importação GrupoPro';

        $data['infoGrupoPro'] = $this->ImportacaoModel->carregaInfoGrupoPro($this->session->userdata('IdEmpresa'));

        $this->loadViews("qualicad/importacao/importacaoGrupoPro", $this->global, $data, NULL);
    }

    public function importaGrupoPro(){
        $data = array();
        $memData = array();
        
        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $memData = array(
                                'CdGrupoPro' => $row['CD_GRU_PRO'],
                                'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                'Ds_GrupoPro' => $row['DS_GRU_PRO'],
                                'Tp_GrupoPro' => $row['TP_GRU_PRO'],
                                'Desc_Tp_GrupoPro' => $row['DESC_TP_GRU_PRO'],
                                'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                'Tp_Ativo'=> 'S',    
                            );

                            $insert = $this->ImportacaoModel->adicionaGrupoPro($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            
                            // Check whether email already exists in the database
                        /*    $con = array(
                                'where' => array(
                                    'email' => $row['Email']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->member->getRows($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('email' => $row['Email']);
                                $update = $this->member->update($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->member->insert($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            } */
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        
                        $this->session->set_flashdata('success', $successMsg);
                    //    $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                //    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                    $this->session->set_flashdata('error', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_flashdata('error', 'Invalid file, please select only CSV file.');
            //    $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('importacaoGrupoPro');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }



}