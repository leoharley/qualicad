<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Admin (AdminController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Principal extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
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

    function principalConvenio()
    {
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'QUALICAD : Convênio';

            $this->loadViews("qualicad/principal/principalConvenio", $this->global, $data, NULL);
    }

    function principalPlano()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Plano';

        $this->loadViews("qualicad/principal/principalPlano", $this->global, $data, NULL);
    }

    function principalPlanoModal()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Plano';

        $this->loadViewsModal("qualicad/principal/principalPlano", $this->global, $data, NULL);
    }

    function principalFaturamento()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Faturamento';

        $this->loadViews("qualicad/principal/principalFaturamento", $this->global, $data, NULL);
    }

    function principalFaturamentoItem()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Faturamento Item';

        $this->loadViews("qualicad/principal/principalFaturamentoItem", $this->global, $data, NULL);
    }

    function principalRegra()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Regra';

        $this->loadViews("qualicad/principal/principalRegra", $this->global, $data, NULL);
    }

    function principalRegraGrupoPro()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Regra Grupo Pro';

        $this->loadViews("qualicad/principal/principalRegraGrupoPro", $this->global, $data, NULL);
    }

    function principalIndice()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Índice';

        $this->loadViews("qualicad/principal/principalIndice", $this->global, $data, NULL);
    }

    function principalIndiceGrupoPro()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Índice Grupo Pro';

        $this->loadViews("qualicad/principal/principalIndiceGrupoPro", $this->global, $data, NULL);
    }

    function principalProibicao()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Proibição';

        $this->loadViews("qualicad/principal/principalProibicao", $this->global, $data, NULL);
    }

    function principalRegraProibicao()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Regra Proibição';

        $this->loadViews("qualicad/principal/principalRegraProibicao", $this->global, $data, NULL);
    }

    function principalFracaoSimproBra()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Fração Simpro Bra';

        $this->loadViews("qualicad/principal/principalFracaoSimproBra", $this->global, $data, NULL);
    }

    function principalUnidade()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Unidade';

        $this->loadViews("qualicad/principal/principalUnidade", $this->global, $data, NULL);
    }


}