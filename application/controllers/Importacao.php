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

    // IMPORTAÇÃO GRUPO PRO

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

    //    $DePara = $this->ImportacaoModel->consultaDePara('GrupoPro',$this->session->userdata('IdEmpresa'));

        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->load->library('form_validation');

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
                    
                           
                            foreach ($key as $origem => $value) {
                                $destino = $this->ImportacaoModel->consultaDePara('GrupoPro',$origem,$this->session->userdata('IdEmpresa'))[0]->No_CampoDestino;
                                
                                if(!empty($csvData)){
                                    foreach($csvData as $row=>$key) {
                                        $rowCount++;
                                
                                if (isset($destino)) {
                                    $memData += array(
                                        $destino => $key[$origem]
                                    );
                                } 
                                
                                $memData += array(
                                    'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                    'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                    'Tp_Ativo'=> 'S');
    
                                $insert = $this->ImportacaoModel->adicionaGrupoPro($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }   

                            }


                      /*      foreach ($DePara as $rowDePara) {

                                $tmp1 = $rowDePara->No_CampoDestino;
                                $tmp2 = $rowDePara->No_CampoOrigem;
                                $memData += array(
                                    $tmp1 => $row[$tmp2],
                                    'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                    'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                    'Tp_Ativo'=> 'S');

                               $insert = $this->ImportacaoModel->adicionaGrupoPro($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }

                            } */


                            // Prepare data for DB insertion
                        /*    $memData += array(
                                'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                'Tp_Ativo'=> 'S',
                            ); */

                       /*     $memData = array(
                                'CdGrupoPro' => $row['CD_GRU_PRO'],
                                'Ds_GrupoPro' => $row['DS_GRU_PRO'],
                                'Tp_GrupoPro' => $row['TP_GRU_PRO'],
                                'Desc_Tp_GrupoPro' => $row['DESC_TP_GRU_PRO'],
                                'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                'Tp_Ativo'=> 'S',    
                            ); */

                 
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
                        $successMsg = 'Tabela GrupoPro importada com sucesso! Qtd. Registros ('.$rowCount.') | Inseridos ('.$insertCount.') | Atualizados ('.$updateCount.') | Não inseridos ('.$notAddCount.')';
                        
                        $this->session->set_flashdata('success', $successMsg);
                    }
                }else{
                    $this->session->set_flashdata('error', 'Erro no upload do arquivo, tente novamente.');
                }
            }else{
                $this->session->set_flashdata('error', 'Arquivo inválido! Selecione um arquivo CSV');
            //    $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('importacaoGrupoPro');
    }


    // IMPORTAÇÃO PROFAT

    function importacaoProFat()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Importação ProFat';

        $data['infoProFat'] = $this->ImportacaoModel->carregaInfoProFat($this->session->userdata('IdEmpresa'));

        $this->loadViews("qualicad/importacao/importacaoProFat", $this->global, $data, NULL);
    }

    public function importaProFat(){
        $data = array();
        $memData = array();
        
        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->load->library('form_validation');

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
                                'CodProFat' => $row['CD_PRO_FAT'],
                                'TbUsuEmp_Id_UsuEmp' => $this->session->userdata('IdUsuEmp'),
                                'Ds_ProFat' => $row['DS_PRO_FAT'],
                                'Ds_Unidade' => $row['DS_UNIDADE'],
                                'TbGrupoPro_CodGrupo' => $row['CD_GRU_PRO'],
                                'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                'Tp_Ativo'=> 'S',    
                            );

                            $insert = $this->ImportacaoModel->adicionaProFat($memData);
                                
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
                        $successMsg = 'Tabela ProFat importada com sucesso! Qtd. Registros ('.$rowCount.') | Inseridos ('.$insertCount.') | Atualizados ('.$updateCount.') | Não inseridos ('.$notAddCount.')';
                        
                        $this->session->set_flashdata('success', $successMsg);
                    }
                }else{
                    $this->session->set_flashdata('error', 'Erro no upload do arquivo, tente novamente.');
                }
            }else{
                $this->session->set_flashdata('error', 'Arquivo inválido! Selecione um arquivo CSV');
            //    $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('importacaoProFat');
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
                $this->form_validation->set_message('file_check', 'Favor selecione somente um arquivo CSV.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Favor selecione somente um arquivo CSV.');
            return false;
        }
    }



}