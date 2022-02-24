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
        $this->load->model('cadastroModel');
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
            $data['roles'] = $this->user_model->getUserRoles();

            if ($tpTela == 'listar') {

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->user_model->userListingCount($searchText);

                $returns = $this->paginationCompress ( "cadastroUsuario/listar", $count, 10 );
                
                $data['registrosUsuarios'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
                
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
    }

    function cadastroEmpresa()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Empresa';

        $this->loadViews("qualicad/cadastro/cadastroEmpresa", $this->global, $data, NULL);
    }

    function cadastroUsuarioEmpresa()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Usuário/Empresa/Permissão';

        $this->loadViews("qualicad/cadastro/cadastroUsuarioEmpresa", $this->global, $data, NULL);
    }

    function cadastroPerfil()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Perfil';

        $this->loadViews("qualicad/cadastro/cadastroPerfil", $this->global, $data, NULL);
    }

    function cadastroPermissao()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Permissões';

        $this->loadViews("qualicad/cadastro/cadastroPermissao", $this->global, $data, NULL);
    }

    function cadastroTelas()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Cadastro de Telas';

        $this->loadViews("qualicad/cadastro/cadastroTelas", $this->global, $data, NULL);
    }

}