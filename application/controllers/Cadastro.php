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
                
                $data['registrosUsuarios'] = $this->CadastroModel->l_cadastroUsuario($searchText, $returns["page"], $returns["segment"]);
                
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
                $this->global['pageTitle'] = 'QUALICAD : Editar Usuário';
                $this->loadViews("qualicad/cadastro/c_cadastroUsuario", $this->global, $data, NULL); 
            }
    }

    function cadastroEmpresa()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Empresa';

        $this->loadViews("qualicad/cadastro/cadastroEmpresa", $this->global, $data, NULL);
    }

    function cadastroUsuarioEmpresa()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Usuário/Empresa/Permissão';

        $this->loadViews("qualicad/cadastro/cadastroUsuarioEmpresa", $this->global, $data, NULL);
    }

    function cadastroPerfil()
    {
        $data['perfis'] = $this->user_model->carregaPerfisUsuarios();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Perfil';

        $this->loadViews("qualicad/cadastro/cadastroPerfil", $this->global, $data, NULL);
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

    function adicionaUsuario() {
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
                
                $infoUsuario = array('Email'=>$nome, 'Senha'=>getHashedPassword($senha), 'Nome_Usuario'=> $nome,
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

}