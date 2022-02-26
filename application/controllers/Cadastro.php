<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Admin (AdminController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Cadastro extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('CadastroModel');
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

    // INICIO DAS FUNÇÕES DA TELA DE USUÁRIO

    function cadastroUsuario()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "cadastroUsuario/listar", $count, 10 );
                
                $data['registrosUsuarios'] = $this->CadastroModel->listaUsuarios($searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar usuários';
                $processFunction = 'Cadastro/cadastroUsuario';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Usuário';
                
                $this->loadViews("qualicad/cadastro/l_cadastroUsuario", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Usuário';
                $this->loadViews("qualicad/cadastro/c_cadastroUsuario", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
                $IdUsuario = $this->uri->segment(3);
                if($IdUsuario == null)
                {
                    redirect('cadastroUsuario/listar');
                }
                $data['infoUsuario'] = $this->CadastroModel->carregaInfoUsuario($IdUsuario);
                $this->global['pageTitle'] = 'QUALICAD : Editar usuário';      
                $this->loadViews("qualicad/cadastro/c_cadastroUsuario", $this->global, $data, NULL);
            }
    }

    function adicionaUsuario() 
    {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');
            
        //    if($this->form_validation->run() == FALSE)
        //    {

        //        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();
        //        $this->global['pageTitle'] = 'QUALICAD : Adicionar usuário';
        //        $this->loadViews("c_cadastroUsuario", $this->global, $data, NULL);

        //    }
        //    else
        //{

                $nome = ucwords(strtolower($this->security->xss_clean($this->input->post('Nome_Usuario'))));
                $cpf = $this->input->post('Cpf_Usuario');
                $email = $this->security->xss_clean($this->input->post('Email'));
                $senha = $this->input->post('Senha');
                $tpativo = $this->input->post('Tp_Ativo');
            //    $roleId = $this->input->post('role');

                //SE O USUÁRIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($tpativo == 'S') 
                { 
                    $dtativo = date('Y-m-d H:i:s');
                } else
                {
                    $dtativo = null;
                }
                
                $infoUsuario = array('Nome_Usuario'=> $nome, 'Email'=>$email, 'Senha'=>getHashedPassword($senha),
                                    'Cpf_Usuario'=>$cpf, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                                    'Tp_Ativo'=>$tpativo, 'Dt_Ativo'=>$dtativo);
                                    
                $result = $this->CadastroModel->adicionaUsuario($infoUsuario);
                
                if($result > 0)
                {
                    $process = 'Adicionar usuário';
                    $processFunction = 'Cadastro/adicionaUsuario';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Usuário criado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do usuário');
                }
                
                redirect('cadastroUsuario/listar');

        //    }
    }


    function editaUsuario()
    {
            $this->load->library('form_validation');
            
            $IdUsuario = $this->input->post('Id_Usuario');

            //VALIDAÇÃO
            
         /*   $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            { 
                $this->editOld($userId);
            }
            else
            { */

                $nome = ucwords(strtolower($this->security->xss_clean($this->input->post('Nome_Usuario'))));
                $cpf = $this->input->post('Cpf_Usuario');
                $email = $this->security->xss_clean($this->input->post('Email'));
                $senha = $this->input->post('Senha');
                $tpativo = $this->input->post('Tp_Ativo');

                foreach ($this->CadastroModel->carregaInfoUsuario($IdUsuario) as $data){
                    $tpativoatual = ($data->Tp_Ativo);
                }

                if ($tpativoatual == 'N' && $tpativo == 'S')
                {
                    $dtativo = date('Y-m-d H:i:s');
                    $dtinativo = null;
                } else if ($tpativo == 'N')
                {
                    $dtativo = null;
                    $dtinativo = date('Y-m-d H:i:s');
                }
                
                $infoUsuario = array();
                
                if(empty($senha))
                {
                    $infoUsuario = array('Nome_Usuario'=> $nome, 'Email'=>$email,
                                        'Cpf_Usuario'=>$cpf, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                                        'Tp_Ativo'=>$tpativo, 'Dt_Ativo'=>$dtativo, 'Dt_Inativo'=>$dtinativo);
                }
                else
                {
                    $infoUsuario = array('Nome_Usuario'=> $nome, 'Email'=>$email, 'Senha'=>getHashedPassword($senha),
                                'Cpf_Usuario'=>$cpf, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                                'Tp_Ativo'=>$tpativo, 'Dt_Ativo'=>$dtativo, 'Dt_Inativo'=>$dtinativo);
                }
                
                $resultado = $this->CadastroModel->editaUsuario($infoUsuario, $IdUsuario);
                
                if($resultado == true)
                {
                    $process = 'Usuário atualizado';
                    $processFunction = 'Cadastro/editaUsuario';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Usuário atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na atualização do usuário');
                }
                
                redirect('cadastroUsuario/listar');
           // }
    }

    function apagaUsuario()
    {
            $IdUsuario = $this->uri->segment(2);

            $infoUsuario = array();

            $infoUsuario = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->CadastroModel->apagaUsuario($infoUsuario, $IdUsuario);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                 $process = 'Exclusão de usuário';
                 $processFunction = 'Cadastro/apagaUsuario';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'Usuário deletado com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir o usuário');
                }
                redirect('cadastroUsuario/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE USUÁRIO

    // INICIO DAS FUNÇÕES DA TELA DE EMPRESA

    function cadastroEmpresa()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "cadastroEmpresa/listar", $count, 10 );
                
                $data['registrosEmpresas'] = $this->CadastroModel->listaEmpresas($searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar empresas';
                $processFunction = 'Cadastro/cadastroEmpresa';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Empresa';
                
                $this->loadViews("qualicad/cadastro/l_cadastroEmpresa", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Empresa';
                $this->loadViews("qualicad/cadastro/c_cadastroEmpresa", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
                $IdEmpresa = $this->uri->segment(3);
                if($IdEmpresa == null)
                {
                    redirect('cadastroEmpresa/listar');
                }
                $data['infoEmpresa'] = $this->CadastroModel->carregaInfoEmpresa($IdEmpresa);
                $this->global['pageTitle'] = 'QUALICAD : Editar empresa';      
                $this->loadViews("qualicad/cadastro/c_cadastroEmpresa", $this->global, $data, NULL);
            }
    }

    function adicionaEmpresa() 
    {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('Nome_Empresa','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('CNPJ','CNPJ','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cd_EmpresaERP','Cd_EmpresaERP','trim|required|max_length[128]');
            $this->form_validation->set_rules('End_Empresa','Endereço','trim|required|max_length[128]');
            $this->form_validation->set_rules('Nome_Contato','Contato','trim|required|max_length[128]');
            $this->form_validation->set_rules('Telefone','Telefone','trim|required|max_length[20]');
            $this->form_validation->set_rules('Email_Empresa','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Dt_Valida_Contrato','Validade do Contrato','trim|required|max_length[128]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');
            
        //    if($this->form_validation->run() == FALSE)
        //    {

        //        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();
        //        $this->global['pageTitle'] = 'QUALICAD : Adicionar usuário';
        //        $this->loadViews("c_cadastroUsuario", $this->global, $data, NULL);

        //    }
        //    else
        //{

                $Nome_Empresa = ucwords(strtolower($this->security->xss_clean($this->input->post('Nome_Empresa'))));
                $CNPJ = $this->input->post('CNPJ');
                $Email_Empresa = $this->security->xss_clean($this->input->post('Email_Empresa'));
                $Cd_EmpresaERP = $this->input->post('Cd_EmpresaERP');
                $End_Empresa = $this->input->post('End_Empresa');
                $Nome_Contato = $this->input->post('Nome_Contato');
                $Telefone = $this->input->post('Telefone');
                $Dt_Valida_Contrato = $this->input->post('Dt_Valida_Contrato');
                $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

                //SE O USUÁRIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo == 'S') 
                { 
                    $Dt_Ativo = date('Y-m-d H:i:s');
                } else
                {
                    $Dt_Ativo = null;
                }
                
                $infoEmpresa = array('Nome_Empresa'=> $Nome_Empresa, 'CNPJ'=>$CNPJ, 'Email_Empresa'=>$Email_Empresa,
                                    'Cd_EmpresaERP'=>$Cd_EmpresaERP, 'End_Empresa'=>$End_Empresa, 'Nome_Contato'=>$Nome_Contato,
                                    'Telefone'=>$Telefone, 'Dt_Valida_Contrato'=>$Dt_Valida_Contrato, 'Tp_Ativo'=>$Tp_Ativo,
                                    'Dt_Ativo'=>$Dt_Ativo);
                                    
                $result = $this->CadastroModel->adicionaEmpresa($infoEmpresa);
                
                if($result > 0)
                {
                    $process = 'Adicionar empresa';
                    $processFunction = 'Cadastro/adicionaEmpresa';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Empresa criado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do empresa');
                }
                
                redirect('cadastroEmpresa/listar');

        //    }
    }


    function editaEmpresa()
    {
            $this->load->library('form_validation');
            
            $IdEmpresa = $this->input->post('Id_Empresa');

            //VALIDAÇÃO
            
         /*   $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            { 
                $this->editOld($userId);
            }
            else
            { */

                $Nome_Empresa = ucwords(strtolower($this->security->xss_clean($this->input->post('Nome_Empresa'))));
                $CNPJ = $this->input->post('CNPJ');
                $Email_Empresa = $this->security->xss_clean($this->input->post('Email_Empresa'));
                $Cd_EmpresaERP = $this->input->post('Cd_EmpresaERP');
                $End_Empresa = $this->input->post('End_Empresa');
                $Nome_Contato = $this->input->post('Nome_Contato');
                $Telefone = $this->input->post('Telefone');
                $Dt_Valida_Contrato = $this->input->post('Dt_Valida_Contrato');
                $Tp_Ativo = $this->input->post('Tp_Ativo');     

                foreach ($this->CadastroModel->carregaInfoEmpresa($IdEmpresa) as $data){
                    $Tp_Ativo_Atual = ($data->Tp_Ativo);
                }

                if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                    $Dt_Inativo = null;
                } else if ($Tp_Ativo == 'N')
                {
                    $Dt_Ativo = null;
                    $Dt_Inativo = date('Y-m-d H:i:s');
                }
                
                $infoEmpresa = array();
                
                
                $infoEmpresa = array('Nome_Empresa'=> $Nome_Empresa, 'CNPJ'=>$CNPJ, 'Email_Empresa'=>$Email_Empresa,
                                    'Cd_EmpresaERP'=>$Cd_EmpresaERP, 'End_Empresa'=>$End_Empresa, 'Nome_Contato'=>$Nome_Contato,
                                    'Telefone'=>$Telefone, 'Dt_Valida_Contrato'=>$Dt_Valida_Contrato, 'Tp_Ativo'=>$Tp_Ativo,
                                    'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);
                
                
                $resultado = $this->CadastroModel->editaEmpresa($infoEmpresa, $IdEmpresa);
                
                if($resultado == true)
                {
                    $process = 'Empresa atualizada';
                    $processFunction = 'Cadastro/editaEmpresa';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Empresa atualizada com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na atualização da empresa');
                }
                
                redirect('cadastroEmpresa/listar');
           // }
    }

    function apagaEmpresa()
    {
            $IdEmpresa = $this->uri->segment(2);

            $infoEmpresa = array();

            $infoEmpresa = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->CadastroModel->apagaEmpresa($infoEmpresa, $IdEmpresa);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                 $process = 'Exclusão de empresa';
                 $processFunction = 'Cadastro/apagaEmpresa';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'Empresa deletada com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir a empresa');
                }
                redirect('cadastroEmpresa/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE EMPRESA

    // INICIO DAS FUNÇÕES DA TELA DE PERFIL

    function cadastroPerfil()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "cadastroPerfil/listar", $count, 10 );
                
                $data['registrosPerfis'] = $this->CadastroModel->listaPerfis($searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar perfis';
                $processFunction = 'Cadastro/cadastroPerfil';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Perfil';
                
                $this->loadViews("qualicad/cadastro/l_cadastroPerfil", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Perfil';
                $this->loadViews("qualicad/cadastro/c_cadastroPerfil", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
                $IdPerfil = $this->uri->segment(3);
                if($IdPerfil == null)
                {
                    redirect('cadastroPerfil/listar');
                }
                $data['infoPerfil'] = $this->CadastroModel->carregaInfoPerfil($IdPerfil);
                $this->global['pageTitle'] = 'QUALICAD : Editar Perfil';      
                $this->loadViews("qualicad/cadastro/c_cadastroPerfil", $this->global, $data, NULL);
            }
    }

    function adicionaPerfil() 
    {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('Nome','Nome','trim|required|max_length[128]');        

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');
            
        //    if($this->form_validation->run() == FALSE)
        //    {

        //        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();
        //        $this->global['pageTitle'] = 'QUALICAD : Adicionar usuário';
        //        $this->loadViews("c_cadastroUsuario", $this->global, $data, NULL);

        //    }
        //    else
        //{

                $Ds_Perfil = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Perfil'))));
                $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

                //SE O USUÁRIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo == 'S') 
                { 
                    $Dt_Ativo = date('Y-m-d H:i:s');
                } else
                {
                    $Dt_Ativo = null;
                }
                
                $infoPerfil = array('Ds_Perfil'=> $Ds_Perfil, 'CriadoPor'=>$this->vendorId, 'Dt_Ativo'=>$Dt_Ativo,
                                    'Tp_Ativo'=>$Tp_Ativo);
                                    
                $resultado = $this->CadastroModel->adicionaPerfil($infoPerfil);
                
                if($resultado > 0)
                {
                    $process = 'Adicionar perfil';
                    $processFunction = 'Cadastro/adicionaPerfil';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Perfil criado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do perfil');
                }
                
                redirect('cadastroPerfil/listar');

        //    }
    }


    function editaPerfil()
    {
            $this->load->library('form_validation');
            
            $IdPerfil = $this->input->post('Id_CdPerfil');

            //VALIDAÇÃO
            
         /*   $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            { 
                $this->editOld($userId);
            }
            else
            { */

                $Ds_Perfil = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Perfil'))));
                $Tp_Ativo = $this->input->post('Tp_Ativo');  

                foreach ($this->CadastroModel->carregaInfoPerfil($IdPerfil) as $data){
                    $Tp_Ativo_Atual = ($data->Tp_Ativo);
                }

                if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                    $Dt_Inativo = null;
                } else if ($Tp_Ativo == 'N')
                {
                    $Dt_Ativo = null;
                    $Dt_Inativo = date('Y-m-d H:i:s');
                }                
                
                $infoPerfil = array('Ds_Perfil'=> $Ds_Perfil, 'AtualizadoPor'=>$this->vendorId, 'Dt_Ativo'=>$Dt_Ativo,
                                    'Dt_Inativo'=>$Dt_Inativo,'Tp_Ativo'=>$Tp_Ativo);
                
                
                $resultado = $this->CadastroModel->editaPerfil($infoPerfil, $IdPerfil);
                
                if($resultado == true)
                {
                    $process = 'Perfil atualizado';
                    $processFunction = 'Cadastro/editaPerfil';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Perfil atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na atualização do perfil');
                }
                
                redirect('cadastroPerfil/listar');
           // }
    }

    function apagaPerfil()
    {
            $IdEmpresa = $this->uri->segment(2);

            $infoEmpresa = array();

            $infoEmpresa = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->CadastroModel->apagaEmpresa($infoEmpresa, $IdEmpresa);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                 $process = 'Exclusão de empresa';
                 $processFunction = 'Cadastro/apagaEmpresa';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'Empresa deletada com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir a empresa');
                }
                redirect('cadastroEmpresa/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE PERFIL


    function cadastroUsuarioEmpresa()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Usuário/Empresa/Permissão';

        $this->loadViews("qualicad/cadastro/cadastroUsuarioEmpresa", $this->global, $data, NULL);
    }


    function cadastroPermissao()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Permissões';

        $this->loadViews("qualicad/cadastro/cadastroPermissao", $this->global, $data, NULL);
    }

    function cadastroTelas()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Telas';

        $this->loadViews("qualicad/cadastro/cadastroTelas", $this->global, $data, NULL);
    }

}