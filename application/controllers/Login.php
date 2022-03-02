<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Login (LoginController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Login extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('CadastroModel');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function is used to open error /404 not found page
     */
    public function error()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            $process = 'Hata';
            $processFunction = 'Login/error';
            $this->logrecord($process,$processFunction);
            redirect('pageNotFound');
        }
    }

    /**
     * This function is used to access denied page
     */
    public function noaccess() {
        
        $this->global['pageTitle'] = 'BSEU : Erişim Reddedildi';
        $this->datas();

        $this->load->view ( 'includes/header', $this->global );
		$this->load->view ( 'access' );
		$this->load->view ( 'includes/footer' );
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            if (null !== $this->session->userdata('idEmpresa') || $this->session->userdata('isAdmin') == 'S') {
                redirect('/dashboard');
            } 
            else
            {
                $this->load->view('login');
            }
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginMe($email, $password);

            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                //    $lastLogin = $this->login_model->lastLoginInfo($res->userId);
                    
                    $process = 'Autenticação';
                    $processFunction = 'Login/loginMe';

                    $empresasPerfilUsuario = $this->CadastroModel->carregaEmpresasPerfilUsuario($res->Id_Usuario);

                    $associadoEmpresaPerfil = FALSE;

                    foreach ($empresasPerfilUsuario as $data){
                        if ($data->TbPerfil_Id_CdPerfil != NULL && $data->TbEmpresa_Id_Empresa != NULL) $associadoEmpresaPerfil = TRUE;
                    }
                    
                    $role = 0; 
                    $roleText = 'Admin';

                  /*  else 
                    { 
                        $role = $empresasPerfilUsuario['Id_CdPerfil']; 
                        $roleText = $empresasPerfilUsuario['Ds_Perfil'];
                        $idempresa = $empresasPerfilUsuario['TbEmpresa_Id_Empresa'];
                     } */

                    if ($associadoEmpresaPerfil || $res->Admin == 'S') {
                   
                    $sessionArray = array('userId'=>$res->Id_Usuario,
                                            'email'=>$res->Email,               
                                            'role'=>$role,
                                            'roleText'=>$roleText,
                                            'name'=>$res->Nome_Usuario,
                                        //    'lastLogin'=> $lastLogin->createdDtm,
                                            'isAdmin'=>$res->Admin,
                                            'status'=> $res->Tp_Ativo,
                                            'isLoggedIn' => TRUE
                                    );

                    $this->session->set_userdata($sessionArray);

                //    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                    
                    $this->logrecord($process,$processFunction);

                //    if ($res->Admin == 'S') { redirect('/dashboard'); } else { redirect('/welcome'); }

                if (empty($this->CadastroModel->carregaEmpresasPerfilUsuario($this->session->userdata('userId')))) 
                {
                    redirect('/dashboard');
                } else {
                    redirect('/welcome');
                }
                
                    //    redirect('/dashboard');
                
                    redirect('/welcome');
//                    $this->load->view('welcome');

                                } else {
                                    $this->session->set_flashdata('error', 'Usuário não associado a perfil/empresa');
                                    redirect('/login');
                                }


                }
            }
            else
            {
                $this->session->set_flashdata('error', 'O endereço de e-mail ou a senha estão incorretos');
                
                redirect('/login');
            }
        }
    }

    public function welcome()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('/login');
        }
        else
        {
            if (empty($this->CadastroModel->carregaEmpresasPerfilUsuario($this->session->userdata('userId')))) 
                {
                    redirect('/dashboard');
                }
            $data['empresasPerfilUsuario'] = $this->CadastroModel->carregaEmpresasPerfilUsuario($this->session->userdata('userId'));
            $this->load->view('welcome',$data);
        }
    }

    public function escolheEmpresa()
    {
        $IdEmpresa = $this->input->post('Id_Empresa');
        foreach ($this->CadastroModel->carregaInfoEmpresa($IdEmpresa) as $data){
            $NomeEmpresa = ($data->Nome_Empresa);
        }

        $sessionArray = array('idEmpresa'=>$IdEmpresa,'nomeEmpresa'=>$NomeEmpresa);

        $this->session->set_userdata($sessionArray);

        if ($this->session->userdata ('isAdmin') != 'S') {
        foreach ($this->CadastroModel->carregaPerfilUsuario($IdEmpresa, $this->session->userdata('userId')) as $data){
            $role = ($data->TbPerfil_Id_CdPerfil);
            $roleText = ($data->Ds_Perfil);
        }
        $sessionArray = array('role'=>$role,'roleText'=>$roleText);
        }

        $this->session->set_userdata($sessionArray);

        redirect('/login');
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('forgotPassword');
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->security->xss_clean($this->input->post('login_email'));
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();

                $this->load->library('MY_PHPMailer');

                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.hostinger.com ';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = false;                              // Enable SMTP authentication
                    $mail->Username = 'sistemas.dab@saude.gov.br';                // SMTP username
                    $mail->Password = 'UpQcFOzSwX9l';                           // SMTP password
                    $mail->SMTPAutoTLS = true;
                    $mail->Port = 465;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('sistemas.dab@saude.gov.br', 'DAB SISTEMAS');
                    $mail->addAddress('leoharleygoncalves@gmail.com', 'leonardo');     // Add a recipient

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = '=?utf-8?b?RXZlbnRvcyBEQUIgLSBJbnNjcmlwY2nDs24gQ29uZmlybWFkYQ==?=';
                    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    //           echo 'Message has been sent';
                    return true;
                } catch (Exception $e) {
                    //           echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    return false;
                }

                $save = TRUE;
            //    $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Redefinir sua senha";
                    }

                //    $sendStatus = resetPasswordEmail($data1);
                    $sendStatus = TRUE;

                    $process = 'Solicitação de redefinição de senha';
                    $processFunction = 'Login/resetPasswordUser';
                    $this->logrecord($process,$processFunction);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Seu link de redefinição de senha foi enviado com sucesso, verifique seu e-mail.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Falha no envio de e-mail, tente novamente.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "Ocorreu um erro ao enviar suas informações, tente novamente.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "Seu endereço de e-mail não está registrado no sistema.");
            }
            redirect('/forgotPassword');
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {               
                $this->login_model->createPasswordUser($email, $password);
                
                $process = 'Şifre Sıfırlama';
                $processFunction = 'Login/createPasswordUser';
                $this->logrecord($process,$processFunction);

                $status = 'success';
                $message = 'Şifre başarıyla değiştirildi';
            }
            else
            {
                $status = 'error';
                $message = 'Şifre değiştirilemedi';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }
}

?>