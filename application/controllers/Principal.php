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
        $this->load->model('CadastroModel');
        $this->load->model('PrincipalModel');
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

    function principalConvenio()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                if ($this->session->userdata('email') != 'admin@admin.com')
                {
                    if ($this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaConvenio')[0]->Tp_Ativo == 'N' ||
                        $this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaConvenio')[0]->Consultar == 'N')
                        {
                            redirect('telaNaoAutorizada');
                        }
                }        

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "principalConvenio/listar", $count, 10 );
                
                $data['registrosConvenios'] = $this->PrincipalModel->listaConvenio($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar convênios';
                $processFunction = 'Principal/principalConvenio';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Convênio';
                
                $this->loadViews("qualicad/principal/l_principalConvenio", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {

                if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Convênio';
                $this->loadViews("qualicad/principal/c_principalConvenio", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {

                if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $IdConvenio = $this->uri->segment(3);
                if($IdConvenio == null)
                {
                    redirect('principalConvenio/listar');
                }
                $data['infoConvenio'] = $this->PrincipalModel->carregaInfoConvenio($IdConvenio);
                $this->global['pageTitle'] = 'QUALICAD : Editar convênio';      
                $this->loadViews("qualicad/principal/c_principalConvenio", $this->global, $data, NULL);
            }
    }

    function adicionaConvenio() 
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalConvenio/listar'); 
            } 

            $this->load->library('form_validation');

            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');
            
        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */

                $Ds_Convenio = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Convenio'))));
                $CNPJ_Convenio = $this->input->post('CNPJ_Convenio');
                $Cd_ConvenioERP = $this->input->post('Cd_ConvenioERP');
                $Tp_Convenio = $this->input->post('Tp_Convenio');
                $Dt_InicioConvenio = $this->input->post('Dt_InicioConvenio');
                $Dt_VigenciaConvenio = $this->input->post('Dt_VigenciaConvenio');
                $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

                if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

                //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                } else
                {
                    $Dt_Ativo = null;
                }

                    //'Senha'=>getHashedPassword($senha)

                $infoConvenio = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                                    'Ds_Convenio'=> $Ds_Convenio, 'CNPJ_Convenio'=> $CNPJ_Convenio,
                                    'Cd_ConvenioERP'=>$Cd_ConvenioERP, 'Tp_Convenio'=>$Tp_Convenio, 'Dt_InicioConvenio'=>$Dt_InicioConvenio,
                                    'Dt_VigenciaConvenio'=>$Dt_VigenciaConvenio, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                                    'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);
                                    
                $result = $this->PrincipalModel->adicionaConvenio($infoConvenio);
                
                if($result > 0)
                {
                    $process = 'Adicionar convênio';
                    $processFunction = 'Principal/adicionaConvenio';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Convênio criado com sucesso');

                    if (array_key_exists('salvarIrLista',$this->input->post())) {
                        redirect('principalConvenio/listar'); 
                    }
                    else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                        redirect('principalConvenio/cadastrar'); 
                    }
                    else if (array_key_exists('salvarAvancar',$this->input->post())) {
                        redirect('principalPlano/cadastrar');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do convênio');
                    redirect('principalConvenio/cadastrar');
                }

            } else {
                    $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
                    redirect('principalConvenio/cadastrar');
            }
                
                redirect('principalConvenio/cadastrar');

        //    }
    }


    function editaConvenio()
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalConvenio/listar'); 
            } 

            $this->load->library('form_validation');

            $IdConvenio = $this->input->post('Id_Convenio');

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

                $Ds_Convenio = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Convenio'))));
                $CNPJ_Convenio = $this->input->post('CNPJ_Convenio');
                $Cd_ConvenioERP = $this->input->post('Cd_ConvenioERP');
                $Tp_Convenio = $this->input->post('Tp_Convenio');
                $Dt_InicioConvenio = $this->input->post('Dt_InicioConvenio');
                $Dt_VigenciaConvenio = $this->input->post('Dt_VigenciaConvenio');
                $Tp_Ativo = $this->input->post('Tp_Ativo');

                foreach ($this->PrincipalModel->carregaInfoConvenio($IdConvenio) as $data){
                    $Tp_Ativo_Atual = ($data->Tp_Ativo);
                }

                //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                    $Dt_Inativo = null;
                } else if ($Tp_Ativo == 'N')
                {
                    $Dt_Ativo = null;
                    $Dt_Inativo = date('Y-m-d H:i:s');
                }

                //'Senha'=>getHashedPassword($senha)
                $infoConvenio = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'Ds_Convenio'=> $Ds_Convenio, 'CNPJ_Convenio'=> $CNPJ_Convenio,
                    'Cd_ConvenioERP'=>$Cd_ConvenioERP, 'Tp_Convenio'=>$Tp_Convenio, 'Dt_InicioConvenio'=>$Dt_InicioConvenio,
                    'Dt_VigenciaConvenio'=>$Dt_VigenciaConvenio, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                    'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);


                $resultado = $this->PrincipalModel->editaConvenio($infoConvenio,$IdConvenio);
                
                if($resultado == true)
                {
                    $process = 'Convênio atualizado';
                    $processFunction = 'Principal/editaConvenio';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Convênio atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na atualização do convênio');
                }
                
                redirect('principalConvenio/listar');
           // }
    }

    function apagaConvenio()
    {

            if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
                {
                    redirect('acaoNaoAutorizada');
                }

            $IdConvenio = $this->uri->segment(2);

            $infoConvenio = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->PrincipalModel->apagaConvenio($infoConvenio, $IdConvenio);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                 $process = 'Exclusão de convênio';
                 $processFunction = 'Principal/apagaConvenio';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'Convênio deletado com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir o convênio');
                }
                redirect('principalConvenio/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE CONVENIO

    // INICIO DAS FUNÇÕES DA TELA DE PLANO

    function principalPlano()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaPlano') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaPlano'))
                {
                    redirect('telaNaoAutorizada');
                }

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "principalPlano/listar", $count, 10 );
                
                $data['registrosPlanos'] = $this->PrincipalModel->listaPlano($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar planos';
                $processFunction = 'Principal/principalPlano';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Plano';
                
                $this->loadViews("qualicad/principal/l_principalPlano", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {

                if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaPlano'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $data['infoConvenio'] = $this->PrincipalModel->carregaInfoConveniosEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndicesEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoRegra'] = $this->PrincipalModel->carregaInfoRegrasEmpresa($this->session->userdata('IdEmpresa'));
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Plano';
                $this->loadViews("qualicad/principal/c_principalPlano", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {

                if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaPlano'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $IdPlano = $this->uri->segment(3);
                if($IdPlano == null)
                {
                    redirect('principalPlano/listar');
                }
                $data['infoPlano'] = $this->PrincipalModel->carregaInfoPlano($IdPlano);
                $data['infoConvenio'] = $this->PrincipalModel->carregaInfoConveniosEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndicesEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoRegra'] = $this->PrincipalModel->carregaInfoRegrasEmpresa($this->session->userdata('IdEmpresa'));
                $this->global['pageTitle'] = 'QUALICAD : Editar plano';      
                $this->loadViews("qualicad/principal/c_principalPlano", $this->global, $data, NULL);
            }
    }

    function adicionaPlano() 
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalPlano/listar'); 
            } 

            $this->load->library('form_validation');

            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

            //VALIDAÇÃO

            //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

            /*    if($this->form_validation->run() == FALSE)
                {

                    redirect('cadastroUsuario/cadastrar');
                }
                else
            { */

            $Ds_Plano = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Plano'))));
            $TbConvenio_Id_Convenio = $this->input->post('TbConvenio_Id_Convenio');
            $TbIndice_Id_Indice = $this->input->post('TbIndice_Id_Indice');
            $TbRegra_Id_Regra  = $this->input->post('TbRegra_Id_Regra');
            $Cd_PlanoERP = $this->input->post('Cd_PlanoERP');
            $Tp_AcomodacaoPadrao = $this->input->post('Tp_AcomodacaoPadrao');
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

            //VERIFICAÇÃO DE DUPLICIDADE
    //        if ($this->PrincipalModel->consultaPlanoExistente($CNPJ_Convenio,$this->session->userdata('IdUsuEmp')) == null) {

                //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                } else
                {
                    $Dt_Ativo = null;
                }

                //'Senha'=>getHashedPassword($senha)

                $infoPlano = array('TbConvenio_Id_Convenio'=>$TbConvenio_Id_Convenio,  'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                    'Ds_Plano'=>$Ds_Plano, 'TbIndice_Id_Indice'=> $TbIndice_Id_Indice, 'TbRegra_Id_Regra'=> $TbRegra_Id_Regra, 'Cd_PlanoERP'=>$Cd_PlanoERP,
                    'Tp_AcomodacaoPadrao'=>$Tp_AcomodacaoPadrao, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                    'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

                $result = $this->PrincipalModel->adicionaPlano($infoPlano);

                if($result > 0)
                {
                    $process = 'Adicionar plano';
                    $processFunction = 'Principal/adicionaPlano';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Plano criado com sucesso');

                    if (array_key_exists('salvarIrLista',$this->input->post())) {
                        redirect('principalPlano/listar'); 
                    }
                    else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                        redirect('principalPlano/cadastrar'); 
                    }
                    else if (array_key_exists('salvarRetroceder',$this->input->post())) {
                        redirect('principalConvenio/cadastrar');
                    }

                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do plano');
                }

          //  } else {
            //    $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
          //  }

            redirect('principalPlano/cadastrar');
    }


    function editaPlano()
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalPlano/listar'); 
            } 

            $this->load->library('form_validation');

            $IdPlano = $this->input->post('Id_Plano');

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

            $Ds_Plano = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Plano'))));
            $TbConvenio_Id_Convenio = $this->input->post('TbConvenio_Id_Convenio');
            $TbIndice_Id_Indice = $this->input->post('TbIndice_Id_Indice');
            $TbRegra_Id_Regra  = $this->input->post('TbRegra_Id_Regra');
            $Cd_PlanoERP = $this->input->post('Cd_PlanoERP');
            $Tp_AcomodacaoPadrao = $this->input->post('Tp_AcomodacaoPadrao');
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            foreach ($this->PrincipalModel->carregaInfoPlano($IdPlano) as $data){
                $Tp_Ativo_Atual = ($data->Tp_Ativo);
            }

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
                $Dt_Inativo = null;
            } else if ($Tp_Ativo == 'N')
            {
                $Dt_Ativo = null;
                $Dt_Inativo = date('Y-m-d H:i:s');
            }

            //'Senha'=>getHashedPassword($senha)
            $infoPlano = array('TbConvenio_Id_Convenio'=>$TbConvenio_Id_Convenio, 'TbIndice_Id_Indice'=> $TbIndice_Id_Indice, 'TbRegra_Id_Regra'=> $TbRegra_Id_Regra,
                'Cd_PlanoERP'=>$Cd_PlanoERP, 'Tp_AcomodacaoPadrao'=>$Tp_AcomodacaoPadrao, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Ds_Plano'=>$Ds_Plano, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);


            $resultado = $this->PrincipalModel->editaPlano($infoPlano,$IdPlano);

            if($resultado == true)
            {
                $process = 'Plano atualizado';
                $processFunction = 'Principal/editaPlano';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Plano atualizado com sucesso');
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na atualização do plano');
            }

            redirect('principalPlano/listar');
            // }
    }

    function apagaPlano()
    {
            if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaPlano'))
            {
                redirect('acaoNaoAutorizada');
            }

            $IdPlano = $this->uri->segment(2);

            $infoPlano = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->PrincipalModel->apagaPlano($infoPlano, $IdPlano);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                $process = 'Exclusão de plano';
                $processFunction = 'Cadastro/apagaPlano';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Plano deletado com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir o plano');
                }
                redirect('principalPlano/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE PLANO

    // INICIO DAS FUNÇÕES DA TELA DE FATURAMENTO

    function principalFaturamento()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaFaturamento') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaFaturamento'))
                {
                    redirect('telaNaoAutorizada');
                }

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "principalFaturamento/listar", $count, 10 );
                
                $data['registrosFaturamentos'] = $this->PrincipalModel->listaFaturamento($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar faturamentos';
                $processFunction = 'Principal/principalFaturamento';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Faturamento';
                
                $this->loadViews("qualicad/principal/l_principalFaturamento", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {

                if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaFaturamento'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Faturamento';
                $this->loadViews("qualicad/principal/c_principalFaturamento", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {

                if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaFaturamento'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $IdFaturamento = $this->uri->segment(3);
                if($IdFaturamento == null)
                {
                    redirect('principalFaturamento/listar');
                }
                $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamento($IdFaturamento);
                $this->global['pageTitle'] = 'QUALICAD : Editar faturamento';      
                $this->loadViews("qualicad/principal/c_principalFaturamento", $this->global, $data, NULL);
            }
    }

    function adicionaFaturamento() 
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalFaturamento/listar'); 
            } 

            $this->load->library('form_validation');

            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

            //VALIDAÇÃO

            //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

            /*    if($this->form_validation->run() == FALSE)
                {

                    redirect('cadastroUsuario/cadastrar');
                }
                else
            { */

            $Ds_Faturamento = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Faturamento'))));
            $Tp_Faturamento = $this->input->post('Tp_Faturamento');
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

            //           if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoFaturamento = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'Ds_Faturamento'=> $Ds_Faturamento, 'Tp_Faturamento'=> $Tp_Faturamento,
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaFaturamento($infoFaturamento);

            if($result > 0)
            {
                $process = 'Adicionar faturamento';
                $processFunction = 'Principal/adicionaFaturamento';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Faturamento criado com sucesso');
                        
                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalFaturamento/listar'); 
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalFaturamento/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação do faturamento');
            }

            //          } else {
            //             $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            //         }

            redirect('principalFaturamento/cadastrar');

            //    }
    }


    function editaFaturamento()
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalFaturamento/listar'); 
            } 

            $this->load->library('form_validation');

            $IdFaturamento = $this->input->post('Id_Faturamento');

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

            $Ds_Faturamento = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Faturamento'))));
            $Tp_Faturamento = $this->input->post('Tp_Faturamento');
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            foreach ($this->PrincipalModel->carregaInfoFaturamento($IdFaturamento) as $data){
                $tpativoatual = ($data->Tp_Ativo);
            }

            if ($tpativoatual == 'N' && $Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
                $Dt_Inativo = null;
            } else if ($Tp_Ativo == 'N')
            {
                $Dt_Ativo = null;
                $Dt_Inativo = date('Y-m-d H:i:s');
            }

            //'Senha'=>getHashedPassword($senha)
            $infoFaturamento = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'Ds_Faturamento'=> $Ds_Faturamento, 'Tp_Faturamento'=> $Tp_Faturamento, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);


            $resultado = $this->PrincipalModel->editaFaturamento($infoFaturamento, $IdFaturamento);

            if($resultado == true)
            {
                $process = 'Faturamento atualizado';
                $processFunction = 'Principal/editaFaturamento';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Faturamento atualizado com sucesso');
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na atualização do faturamento');
            }

            redirect('principalFaturamento/listar');
            // }
    }

    function apagaFaturamento()
    {
            if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaFaturamento'))
            {
                redirect('acaoNaoAutorizada');
            }

            $IdFaturamento = $this->uri->segment(2);

            $infoFaturamento = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->PrincipalModel->apagaFaturamento($infoFaturamento, $IdFaturamento);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                $process = 'Exclusão de faturamento';
                $processFunction = 'Principal/apagaFaturamento';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Faturamento deletado com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir o faturamento');
                }
                redirect('principalFaturamento/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE FATURAMENTO

    // INICIO DAS FUNÇÕES DA TELA DE REGRA

    function principalRegra()
    {
            $tpTela = $this->uri->segment(2);

            $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

            if ($tpTela == 'listar') {

                if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaRegra') ||
                    !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaRegra'))
                    {
                        redirect('telaNaoAutorizada');
                    }

                $searchText = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchText;
                
                $this->load->library('pagination');
                
                $count = $this->CadastroModel->userListingCount($searchText);

                $returns = $this->paginationCompress ( "cadastroUsuario/listar", $count, 10 );
                
                $data['registrosRegras'] = $this->PrincipalModel->listaRegra($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);
                
                $process = 'Listar regras';
                $processFunction = 'Principal/principalRegra';
                $this->logrecord($process,$processFunction);

                $this->global['pageTitle'] = 'QUALICAD : Lista de Regra';
                
                $this->loadViews("qualicad/principal/l_principalRegra", $this->global, $data, NULL);
            }
            else if ($tpTela == 'cadastrar') {

                if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaRegra'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $this->global['pageTitle'] = 'QUALICAD : Lista de Regra';
                $this->loadViews("qualicad/principal/c_principalRegra", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {

                if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaRegra'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $IdRegra = $this->uri->segment(3);
                if($IdRegra == null)
                {
                    redirect('principalRegra/listar');
                }
                $data['infoRegra'] = $this->PrincipalModel->carregaInfoRegra($IdRegra);
                $this->global['pageTitle'] = 'QUALICAD : Editar regra';      
                $this->loadViews("qualicad/principal/c_principalRegra", $this->global, $data, NULL);
            }
    }

    function adicionaRegra() 
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalRegra/listar'); 
            }  

            $this->load->library('form_validation');

            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

            //VALIDAÇÃO

            //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

            /*    if($this->form_validation->run() == FALSE)
                {

                    redirect('cadastroUsuario/cadastrar');
                }
                else
            { */

            $Ds_Regra = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Regra'))));
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

            //           if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoRegra = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'Ds_Regra'=> $Ds_Regra, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaRegra($infoRegra);

            if($result > 0)
            {
                $process = 'Adicionar regra';
                $processFunction = 'Principal/adicionaRegra';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Regra criada com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalRegra/listar'); 
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalRegra/cadastrar');
                }

            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação da regra');
            }

            //          } else {
            //             $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            //         }

            redirect('principalRegra/cadastrar');

        //    }
    }


    function editaRegra()
    {
            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalRegra/listar'); 
            }  

            $this->load->library('form_validation');

            $IdRegra = $this->input->post('Id_Regra');

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

            $Ds_Regra = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_Regra'))));
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            foreach ($this->PrincipalModel->carregaInfoRegra($IdRegra) as $data){
                $tpativoatual = ($data->Tp_Ativo);
            }

            if ($tpativoatual == 'N' && $Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
                $Dt_Inativo = null;
            } else if ($Tp_Ativo == 'N')
            {
                $Dt_Ativo = null;
                $Dt_Inativo = date('Y-m-d H:i:s');
            }

            //'Senha'=>getHashedPassword($senha)
            $infoRegra = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'Ds_Regra'=> $Ds_Regra, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);


            $resultado = $this->PrincipalModel->editaRegra($infoRegra, $IdRegra);

            if($resultado == true)
            {
                $process = 'Regra atualizado';
                $processFunction = 'Principal/editaRegra';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Regra atualizada com sucesso');
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na atualização da regra');
            }

            redirect('principalRegra/listar');
        // }
    }

    function apagaRegra()
    {
            if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaRegra'))
            {
                redirect('acaoNaoAutorizada');
            }

            $IdRegra = $this->uri->segment(2);

            $infoRegra = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
            
            $resultado = $this->PrincipalModel->apagaRegra($infoRegra, $IdRegra);
            
            if ($resultado > 0) {
                // echo(json_encode(array('status'=>TRUE)));

                $process = 'Exclusão de regra';
                $processFunction = 'Principal/apagaRegra';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Regra deletada com sucesso');

                }
                else 
                { 
                    //echo(json_encode(array('status'=>FALSE))); 
                    $this->session->set_flashdata('error', 'Falha em excluir a regra');
                }
                redirect('principalRegra/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE REGRA

        // INICIO DAS FUNÇÕES DA TELA DE INDICE

        function principalIndice()
        {
                $tpTela = $this->uri->segment(2);
    
                $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();
    
                if ($tpTela == 'listar') {

                    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaIndice') ||
                    !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaIndice'))
                    {
                        redirect('telaNaoAutorizada');
                    }
    
                    $searchText = $this->security->xss_clean($this->input->post('searchText'));
                    $data['searchText'] = $searchText;
                    
                    $this->load->library('pagination');
                    
                    $count = $this->CadastroModel->userListingCount($searchText);
    
                    $returns = $this->paginationCompress ( "cadastroUsuario/listar", $count, 10 );
                    
                    $data['registrosIndices'] = $this->PrincipalModel->listaIndice($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);
                    
                    $process = 'Listar índices';
                    $processFunction = 'Principal/principalIndice';
                    $this->logrecord($process,$processFunction);
    
                    $this->global['pageTitle'] = 'QUALICAD : Lista de Índice';
                    
                    $this->loadViews("qualicad/principal/l_principalIndice", $this->global, $data, NULL);
                }
                else if ($tpTela == 'cadastrar') {

                    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaIndice'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                    $this->global['pageTitle'] = 'QUALICAD : Cadastro de Índice';
                    $this->loadViews("qualicad/principal/c_principalIndice", $this->global, $data, NULL); 
                }
                else if ($tpTela == 'editar') {

                    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaIndice'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                    $IdIndice = $this->uri->segment(3);
                    if($IdIndice == null)
                    {
                        redirect('principalIndice/listar');
                    }
                    $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndice($IdIndice);
                    $this->global['pageTitle'] = 'QUALICAD : Editar Índice';
                    $this->loadViews("qualicad/principal/c_principalIndice", $this->global, $data, NULL);
                }
        }
    
        function adicionaIndice()
        {

            if (array_key_exists('IrLista',$this->input->post())) {
                redirect('principalIndice/listar'); 
            }  

            $this->load->library('form_validation');

            $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
            $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
            $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
            $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

            //VALIDAÇÃO

            //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

            /*    if($this->form_validation->run() == FALSE)
                {

                    redirect('cadastroUsuario/cadastrar');
                }
                else
            { */

            $Ds_indice = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_indice'))));
            $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
            $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
            $Vl_Indice = $this->input->post('Vl_Indice');
            $Vl_M2Filme = $this->input->post('Vl_M2Filme');
            $Vl_Honorário = $this->input->post('Vl_Honorário');
            $Vl_UCO = $this->input->post('Vl_UCO');
            $Tp_Ativo = $this->input->post('Tp_Ativo');

            //    $roleId = $this->input->post('role');

 //           if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

                //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
                if ($Tp_Ativo == 'S')
                {
                    $Dt_Ativo = date('Y-m-d H:i:s');
                } else
                {
                    $Dt_Ativo = null;
                }

                //'Senha'=>getHashedPassword($senha)

                $infoIndice = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                    'Ds_indice'=> $Ds_indice, 'Dt_IniVigencia'=> $Dt_IniVigencia,
                    'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Indice'=>$Vl_Indice, 'Vl_M2Filme'=>$Vl_M2Filme,
                    'Vl_Honorário'=>$Vl_Honorário, 'Vl_UCO'=>$Vl_UCO, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                    'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

                $result = $this->PrincipalModel->adicionaIndice($infoIndice);

                if($result > 0)
                {
                    $process = 'Adicionar índice';
                    $processFunction = 'Principal/adicionaIndice';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Índice criado com sucesso');

                    if (array_key_exists('salvarIrLista',$this->input->post())) {
                        redirect('principalIndice/listar'); 
                    }
                    else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                        redirect('principalIndice/cadastrar');
                    }

                }
                else
                {
                    $this->session->set_flashdata('error', 'Falha na criação do índice');
                }

  //          } else {
   //             $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
   //         }

            redirect('principalIndice/cadastrar');

            //    }
        }
    
    
        function editaIndice()
        {

                if (array_key_exists('IrLista',$this->input->post())) {
                    redirect('principalIndice/listar'); 
                }  

                $this->load->library('form_validation');
                
                $IdIndice = $this->input->post('Id_Indice');
    
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

                    $Ds_indice = ucwords(strtolower($this->security->xss_clean($this->input->post('Ds_indice'))));
                    $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
                    $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
                    $Vl_Indice = $this->input->post('Vl_Indice');
                    $Vl_M2Filme = $this->input->post('Vl_M2Filme');
                    $Vl_Honorário = $this->input->post('Vl_Honorário');
                    $Vl_UCO = $this->input->post('Vl_UCO');
                    $Tp_Ativo = $this->input->post('Tp_Ativo');
    
                    foreach ($this->PrincipalModel->carregaInfoIndice($IdIndice) as $data){
                        $tpativoatual = ($data->Tp_Ativo);
                    }
    
                    if ($tpativoatual == 'N' && $Tp_Ativo == 'S')
                    {
                        $Dt_Ativo = date('Y-m-d H:i:s');
                        $Dt_Inativo = null;
                    } else if ($Tp_Ativo == 'N')
                    {
                        $Dt_Ativo = null;
                        $Dt_Inativo = date('Y-m-d H:i:s');
                    }

                    //'Senha'=>getHashedPassword($senha)
                    $infoIndice = array('TbUsuEmp_Id_UsuEmp'=>$this->session->userdata('IdUsuEmp'), 'TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                        'Ds_indice'=> $Ds_indice, 'Dt_IniVigencia'=> $Dt_IniVigencia,
                        'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Indice'=>$Vl_Indice, 'Vl_M2Filme'=>$Vl_M2Filme,
                        'Vl_Honorário'=>$Vl_Honorário, 'Vl_UCO'=>$Vl_UCO, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                        'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);

                    
                    $resultado = $this->PrincipalModel->editaIndice($infoIndice, $IdIndice);
                    
                    if($resultado == true)
                    {
                        $process = 'Índice atualizado';
                        $processFunction = 'Cadastro/editaIndice';
                        $this->logrecord($process,$processFunction);
    
                        $this->session->set_flashdata('success', 'Índice atualizado com sucesso');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Falha na atualização do índice');
                    }
                    
                    redirect('principalIndice/listar');
            // }
        }
    
        function apagaIndice()
        {
                if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaIndice'))
                    {
                        redirect('acaoNaoAutorizada');
                    }

                $IdIndice = $this->uri->segment(2);

                $infoIndice = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));
                
                $resultado = $this->PrincipalModel->apagaIndice($infoIndice, $IdIndice);
                
                if ($resultado > 0) {
                    // echo(json_encode(array('status'=>TRUE)));
    
                    $process = 'Exclusão de índice';
                    $processFunction = 'Cadastro/apagaIndice';
                    $this->logrecord($process,$processFunction);
    
                    $this->session->set_flashdata('success', 'Índice deletado com sucesso');
    
                    }
                    else 
                    { 
                        //echo(json_encode(array('status'=>FALSE))); 
                        $this->session->set_flashdata('error', 'Falha em excluir o índice');
                    }
                    redirect('principalIndice/listar');
        }
        // FIM DAS FUNÇÕES DA TELA DE INDICE

    // INICIO DAS FUNÇÕES DA TELA DE INDICE GRUPO PRO

    function principalIndiceGrupoPro()
    {
        $tpTela = $this->uri->segment(2);

        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

        if ($tpTela == 'listar') {

        /*    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaIndiceGrupoPro') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaIndiceGrupoPro'))
            {
                redirect('telaNaoAutorizada');
            } */

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->CadastroModel->userListingCount($searchText);

            $returns = $this->paginationCompress ( "principalIndiceGrupoPro/listar", $count, 10 );

            $data['registrosIndiceGrupoPro'] = $this->PrincipalModel->listaIndiceGrupoPro($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);

            $process = 'Listar índice por grupo de procedimento';
            $processFunction = 'Principal/principalIndiceGrupoPro';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'QUALICAD : Lista de Índice por Grupo de Procedimento';

            $this->loadViews("qualicad/principal/l_principalIndiceGrupoPro", $this->global, $data, NULL);
        }
        else if ($tpTela == 'cadastrar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */
            $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndicesEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoGrupoPro'] = $this->PrincipalModel->carregaInfoGrupoPro($this->session->userdata('IdEmpresa'));
            $this->global['pageTitle'] = 'QUALICAD : Cadastro de Índice por Grupo de Procedimento';
            $this->loadViews("qualicad/principal/c_principalIndiceGrupoPro", $this->global, $data, NULL);
        }
        else if ($tpTela == 'editar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $IdIndiceGrupo = $this->uri->segment(3);
            if($IdIndiceGrupo == null)
            {
                redirect('principalIndiceGrupoPro/listar');
            }
            $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndicesEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoGrupoPro'] = $this->PrincipalModel->carregaInfoGrupoPro($this->session->userdata('IdEmpresa'));
            $data['infoIndiceGrupoPro'] = $this->PrincipalModel->carregaInfoIndiceGrupoPro($IdIndiceGrupo);
            $this->global['pageTitle'] = 'QUALICAD : Editar Índice por Grupo de Procedimento';
            $this->loadViews("qualicad/principal/c_principalIndiceGrupoPro", $this->global, $data, NULL);
        }
    }

    function adicionaIndiceGrupoPro()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalIndiceGrupoPro/listar');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
        $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
        $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
        $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */

        $TbGrupoPro_CodGrupo = $this->input->post('TbGrupoPro_CodGrupo');
        $TbIndice_Id_Indice = $this->input->post('TbIndice_Id_Indice');
        $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
        $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
        $Vl_Indice = $this->input->post('Vl_Indice');
        $Vl_M2Filme = $this->input->post('Vl_M2Filme');
        $Vl_Honorario = $this->input->post('Vl_Honorario');
        $Vl_UCO = $this->input->post('Vl_UCO');
        $Tp_Ativo = $this->input->post('Tp_Ativo');


    //    if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoIndiceGrupoPro = array('TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'TbGrupoPro_CodGrupo'=> $TbGrupoPro_CodGrupo, 'TbIndice_Id_Indice'=> $TbIndice_Id_Indice,
                'Dt_IniVigencia'=>$Dt_IniVigencia, 'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Indice'=>$Vl_Indice,
                'Vl_M2Filme'=>$Vl_M2Filme,'Vl_Honorario'=>$Vl_Honorario, 'Vl_UCO'=>$Vl_UCO, 
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaIndiceGrupoPro($infoIndiceGrupoPro);

            if($result > 0)
            {
                $process = 'Adicionar índice grupo pro';
                $processFunction = 'Principal/adicionaIndiceGrupoPro';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Índice grupo pro criado com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalIndiceGrupoPro/listar');
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalIndiceGrupoPro/cadastrar');
                }
                else if (array_key_exists('salvarAvancar',$this->input->post())) {
                    redirect('principalIndiceGrupoPro/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação do índice grupo pro');
                redirect('principalIndiceGrupoPro/cadastrar');
            }

    /*    } else {
            $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            redirect('principalConvenio/cadastrar');
        } */

        redirect('principalIndiceGrupoPro/cadastrar');

        //    }
    }


    function editaIndiceGrupoPro()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalIndiceGrupoPro/listar');
        }

        $this->load->library('form_validation');

        $IdIndiceGrupoPro = $this->input->post('Id_IndiceGrupo');

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

        $TbGrupoPro_CodGrupo = $this->input->post('TbGrupoPro_CodGrupo');
        $TbIndice_Id_Indice = $this->input->post('TbIndice_Id_Indice');
        $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
        $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
        $Vl_Indice = $this->input->post('Vl_Indice');
        $Vl_M2Filme = $this->input->post('Vl_M2Filme');
        $Vl_Honorario = $this->input->post('Vl_Honorario');
        $Vl_UCO = $this->input->post('Vl_UCO');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

        foreach ($this->PrincipalModel->carregaInfoIndiceGrupoPro($IdIndiceGrupoPro) as $data){
            $Tp_Ativo_Atual = ($data->Tp_Ativo);
        }

        //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
        if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
        {
            $Dt_Ativo = date('Y-m-d H:i:s');
            $Dt_Inativo = null;
        } else if ($Tp_Ativo == 'N')
        {
            $Dt_Ativo = null;
            $Dt_Inativo = date('Y-m-d H:i:s');
        }

        //'Senha'=>getHashedPassword($senha)
        $infoIndiceGrupoPro = array('TbGrupoPro_CodGrupo'=> $TbGrupoPro_CodGrupo, 'TbIndice_Id_Indice'=> $TbIndice_Id_Indice,
                'Dt_IniVigencia'=>$Dt_IniVigencia, 'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Indice'=>$Vl_Indice,
                'Vl_M2Filme'=>$Vl_M2Filme,'Vl_Honorario'=>$Vl_Honorario, 'Vl_UCO'=>$Vl_UCO, 
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo,
                'Dt_Inativo'=>$Dt_Inativo);

        $resultado = $this->PrincipalModel->editaIndiceGrupoPro($infoIndiceGrupoPro,$IdIndiceGrupoPro);

        if($resultado == true)
        {
            $process = 'Índice Grupo Pro atualizado';
            $processFunction = 'Principal/editaIndiceGrupoPro';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Índice Grupo Pro atualizado com sucesso');
        }
        else
        {
            $this->session->set_flashdata('error', 'Falha na atualização do Índice Grupo Pro');
        }

        redirect('principalIndiceGrupoPro/listar');
        // }
    }

    function apagaIndiceGrupoPro()
    {

    /*    if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
        {
            redirect('acaoNaoAutorizada');
        } */

        $IdIndiceGrupoPro = $this->uri->segment(2);

        $infoIndiceGrupoPro = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));

        $resultado = $this->PrincipalModel->apagaIndiceGrupoPro($infoIndiceGrupoPro, $IdIndiceGrupoPro);

        if ($resultado > 0) {
            // echo(json_encode(array('status'=>TRUE)));

            $process = 'Exclusão de Índice Grupo Pro';
            $processFunction = 'Principal/apagaIndiceGrupoPro';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Índice Grupo Pro deletado com sucesso');

        }
        else
        {
            //echo(json_encode(array('status'=>FALSE)));
            $this->session->set_flashdata('error', 'Falha em excluir o Índice Grupo Pro');
        }
        redirect('principalIndiceGrupoPro/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE INDICE GRUPO PRO

    // INICIO DAS FUNÇÕES DA TELA DE REGRA PROIBIÇÃO

    function principalRegraProibicao()
    {
        $tpTela = $this->uri->segment(2);

        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

        if ($tpTela == 'listar') {

        /*    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaConvenio') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('telaNaoAutorizada');
            } */

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->CadastroModel->userListingCount($searchText);

            $returns = $this->paginationCompress ( "principalRegraProibicao/listar", $count, 10 );

            $data['registrosRegraProibicao'] = $this->PrincipalModel->listaRegraProibicao($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);

            $process = 'Listar regra proibição';
            $processFunction = 'Principal/principalRegraProibicao';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'QUALICAD : Lista de Regra Proibição';

            $this->loadViews("qualicad/principal/l_principalRegraProibicao", $this->global, $data, NULL);
        }
        else if ($tpTela == 'cadastrar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoGrupoPro'] = $this->PrincipalModel->carregaInfoGrupoPro($this->session->userdata('IdEmpresa'));
            $data['infoPlano'] = $this->PrincipalModel->carregaInfoPlanosEmpresa($this->session->userdata('IdEmpresa'));
            $this->global['pageTitle'] = 'QUALICAD : Cadastro de Regra Proibição';
            $this->loadViews("qualicad/principal/c_principalRegraProibicao", $this->global, $data, NULL);
        }
        else if ($tpTela == 'editar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $IdRegraProibicao = $this->uri->segment(3);
            if($IdRegraProibicao == null)
            {
                redirect('principalRegraProibicao/listar');
            }
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoGrupoPro'] = $this->PrincipalModel->carregaInfoGrupoPro($this->session->userdata('IdEmpresa'));
            $data['infoPlano'] = $this->PrincipalModel->carregaInfoPlanosEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoRegraProibicao'] = $this->PrincipalModel->carregaInfoRegraProibicao($IdRegraProibicao);
            $this->global['pageTitle'] = 'QUALICAD : Editar Regra Proibição';
            $this->loadViews("qualicad/principal/c_principalRegraProibicao", $this->global, $data, NULL);
        }
    }

    function adicionaRegraProibicao()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalRegraProibicao/listar');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
        $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
        $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
        $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */

        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $TbGrupoPro_CodGrupo = $this->input->post('TbGrupoPro_CodGrupo');
        $TbPlano_Id_Plano = $this->input->post('TbPlano_Id_Plano');
        $Ds_RegraProibicao = $this->input->post('Ds_RegraProibicao');
        $Tp_RegraProibicao = $this->input->post('Tp_RegraProibicao');
        $Tp_Atendimento = $this->input->post('Tp_Atendimento');
        $Vl_RegraProibicao = $this->input->post('Vl_RegraProibicao');
        $Tp_Ativo = $this->input->post('Tp_Ativo');


    //    if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoRegraProibicao = array('TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento, 'TbGrupoPro_CodGrupo'=> $TbGrupoPro_CodGrupo,
                'TbPlano_Id_Plano'=>$TbPlano_Id_Plano, 'Ds_RegraProibicao'=>$Ds_RegraProibicao, 'Tp_RegraProibicao'=>$Tp_RegraProibicao,
                'Tp_Atendimento'=>$Tp_Atendimento,'Vl_RegraProibicao'=>$Vl_RegraProibicao,
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaRegraProibicao($infoRegraProibicao);

            if($result > 0)
            {
                $process = 'Adicionar regra proibição';
                $processFunction = 'Principal/adicionaRegraProibicao';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Regra proibição criada com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalRegraProibicao/listar');
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalRegraProibicao/cadastrar');
                }
                else if (array_key_exists('salvarAvancar',$this->input->post())) {
                    redirect('principalRegraProibicao/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação da regra proibição');
                redirect('principalRegraProibicao/cadastrar');
            }

    /*    } else {
            $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            redirect('principalConvenio/cadastrar');
        } */

        redirect('principalRegraProibicao/cadastrar');

        //    }
    }


    function editaRegraProibicao()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalRegraProibicao/listar');
        }

        $this->load->library('form_validation');

        $IdRegraProibicao = $this->input->post('Id_RegraProibicao');

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

        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $TbGrupoPro_CodGrupo = $this->input->post('TbGrupoPro_CodGrupo');
        $TbPlano_Id_Plano = $this->input->post('TbPlano_Id_Plano');
        $Ds_RegraProibicao = $this->input->post('Ds_RegraProibicao');
        $Tp_RegraProibicao = $this->input->post('Tp_RegraProibicao');
        $Tp_Atendimento = $this->input->post('Tp_Atendimento');
        $Vl_RegraProibicao = $this->input->post('Vl_RegraProibicao');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

        foreach ($this->PrincipalModel->carregaInfoRegraProibicao($IdRegraProibicao) as $data){
            $Tp_Ativo_Atual = ($data->Tp_Ativo);
        }

        //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
        if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
        {
            $Dt_Ativo = date('Y-m-d H:i:s');
            $Dt_Inativo = null;
        } else if ($Tp_Ativo == 'N')
        {
            $Dt_Ativo = null;
            $Dt_Inativo = date('Y-m-d H:i:s');
        }

        //'Senha'=>getHashedPassword($senha)
        $infoRegraProibicao = array('TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento, 'TbGrupoPro_CodGrupo'=> $TbGrupoPro_CodGrupo,
                'TbPlano_Id_Plano'=>$TbPlano_Id_Plano, 'Ds_RegraProibicao'=>$Ds_RegraProibicao, 'Tp_RegraProibicao'=>$Tp_RegraProibicao,
                'Tp_Atendimento'=>$Tp_Atendimento,'Vl_RegraProibicao'=>$Vl_RegraProibicao, 'Dt_Inativo'=>$Dt_Inativo,
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

        $resultado = $this->PrincipalModel->editaRegraProibicao($infoRegraProibicao,$IdRegraProibicao);

        if($resultado == true)
        {
            $process = 'Regra proibição atualizado';
            $processFunction = 'Principal/editaRegraProibicao';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Regra proibição atualizado com sucesso');
        }
        else
        {
            $this->session->set_flashdata('error', 'Falha na atualização da regra proibição');
        }

        redirect('principalRegraProibicao/listar');
        // }
    }

    function apagaRegraProibicao()
    {

    /*    if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
        {
            redirect('acaoNaoAutorizada');
        } */

        $IdRegraProibicao = $this->uri->segment(2);

        $infoRegraProibicao = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));

        $resultado = $this->PrincipalModel->apagaRegraProibicao($infoRegraProibicao, $IdRegraProibicao);

        if ($resultado > 0) {
            // echo(json_encode(array('status'=>TRUE)));

            $process = 'Exclusão da regra proibição';
            $processFunction = 'Principal/apagaRegraProibicao';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Regra proibição deletada com sucesso');

        }
        else
        {
            //echo(json_encode(array('status'=>FALSE)));
            $this->session->set_flashdata('error', 'Falha em excluir a regra proibição');
        }
        redirect('principalRegraProibicao/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE REGRA PROIBIÇÃO

    // INICIO DAS FUNÇÕES DA TELA DE FRAÇÃO SIMPRO BRA

    function principalFracaoSimproBra()
    {
        $tpTela = $this->uri->segment(2);

        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

        if ($tpTela == 'listar') {

        /*    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaConvenio') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('telaNaoAutorizada');
            } */

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->CadastroModel->userListingCount($searchText);

            $returns = $this->paginationCompress ( "principalFracaoSimproBra/listar", $count, 10 );

            $data['registrosFracaoSimproBra'] = $this->PrincipalModel->listaFracaoSimproBra($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);

            $process = 'Listar fração simpro BRA';
            $processFunction = 'Principal/principalFracaoSimproBra';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'QUALICAD : Lista de Fração Simpro BRA';

            $this->loadViews("qualicad/principal/l_principalFracaoSimproBra", $this->global, $data, NULL);
        }
        else if ($tpTela == 'cadastrar') {

       /*    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */
            $data['infoProFat'] = $this->PrincipalModel->carregaInfoProFatEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoTUSS'] = $this->PrincipalModel->carregaInfoTUSSEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $this->global['pageTitle'] = 'QUALICAD : Cadastro de Fração Simpro BRA';
            $this->loadViews("qualicad/principal/c_principalFracaoSimproBra", $this->global, $data, NULL);
        }
        else if ($tpTela == 'editar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $IdFracaoSimproBra = $this->uri->segment(3);
            if($IdFracaoSimproBra == null)
            {
                redirect('principalFracaoSimproBra/listar');
            }
            $data['infoProFat'] = $this->PrincipalModel->carregaInfoProFatEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoTUSS'] = $this->PrincipalModel->carregaInfoTUSSEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoFracaoSimproBra'] = $this->PrincipalModel->carregaInfoFracaoSimproBra($IdFracaoSimproBra);
            $this->global['pageTitle'] = 'QUALICAD : Editar Fração Simpro BRA';
            $this->loadViews("qualicad/principal/c_principalFracaoSimproBra", $this->global, $data, NULL);
        }
    }

    function adicionaFracaoSimproBra()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalFracaoSimproBra/listar');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
        $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
        $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
        $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */

        $TbProFat_Cd_ProFat = $this->input->post('TbProFat_Cd_ProFat');
        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $TbTUSS_Id_Tuss = $this->input->post('TbTUSS_Id_Tuss');
        $Ds_FracaoSimproBra = $this->input->post('Ds_FracaoSimproBra');
        $Ds_Laboratorio = $this->input->post('Ds_Laboratorio');
        $Ds_Apresentacao = $this->input->post('Ds_Apresentacao');
        $Tp_MatMed = $this->input->post('Tp_MatMed');
        $Vl_FatorDivisao = $this->input->post('Vl_FatorDivisao');
        $Qt_Prod = $this->input->post('Qt_Prod');
        $Tp_Ativo = $this->input->post('Tp_Ativo');


    //    if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoFracaoSimproBra = array('TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'TbProFat_Cd_ProFat'=> $TbProFat_Cd_ProFat, 'TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento,
                'TbTUSS_Id_Tuss'=>$TbTUSS_Id_Tuss, 'Ds_FracaoSimproBra'=>$Ds_FracaoSimproBra, 'Ds_Laboratorio'=>$Ds_Laboratorio,
                'Ds_Apresentacao'=>$Ds_Apresentacao,'Tp_MatMed'=>$Tp_MatMed, 'Vl_FatorDivisao'=>$Vl_FatorDivisao,
                'Qt_Prod'=>$Qt_Prod, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaFracaoSimproBra($infoFracaoSimproBra);

            if($result > 0)
            {
                $process = 'Adicionar fração simpro bra';
                $processFunction = 'Principal/adicionaFracaoSimproBra';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Fração simpro bra criada com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalFracaoSimproBra/listar');
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalFracaoSimproBra/cadastrar');
                }
                else if (array_key_exists('salvarAvancar',$this->input->post())) {
                    redirect('principalFracaoSimproBra/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação da fração simpro bra');
                redirect('principalFracaoSimproBra/cadastrar');
            }

    /*    } else {
            $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            redirect('principalConvenio/cadastrar');
        } */

        redirect('principalFracaoSimproBra/cadastrar');

        //    }
    }


    function editaFracaoSimproBra()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalFracaoSimproBra/listar');
        }

        $this->load->library('form_validation');

        $IdFracaoSimproBra = $this->input->post('Id_FracaoSimproBra');

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

        $TbProFat_Cd_ProFat = $this->input->post('TbProFat_Cd_ProFat');
        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $TbTUSS_Id_Tuss = $this->input->post('TbTUSS_Id_Tuss');
        $Ds_FracaoSimproBra = $this->input->post('Ds_FracaoSimproBra');
        $Ds_Laboratorio = $this->input->post('Ds_Laboratorio');
        $Ds_Apresentacao = $this->input->post('Ds_Apresentacao');
        $Tp_MatMed = $this->input->post('Tp_MatMed');
        $Vl_FatorDivisao = $this->input->post('Vl_FatorDivisao');
        $Qt_Prod = $this->input->post('Qt_Prod');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

        foreach ($this->PrincipalModel->carregaInfoFracaoSimproBra($IdFracaoSimproBra) as $data){
            $Tp_Ativo_Atual = ($data->Tp_Ativo);
        }

        //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
        if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
        {
            $Dt_Ativo = date('Y-m-d H:i:s');
            $Dt_Inativo = null;
        } else if ($Tp_Ativo == 'N')
        {
            $Dt_Ativo = null;
            $Dt_Inativo = date('Y-m-d H:i:s');
        }

        //'Senha'=>getHashedPassword($senha)
        $infoFracaoSimproBra = array('TbProFat_Cd_ProFat'=> $TbProFat_Cd_ProFat, 'TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento,
        'TbTUSS_Id_Tuss'=>$TbTUSS_Id_Tuss, 'Ds_FracaoSimproBra'=>$Ds_FracaoSimproBra, 'Ds_Laboratorio'=>$Ds_Laboratorio,
        'Ds_Apresentacao'=>$Ds_Apresentacao,'Tp_MatMed'=>$Tp_MatMed, 'Vl_FatorDivisao'=>$Vl_FatorDivisao,
        'Qt_Prod'=>$Qt_Prod, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
        'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);

        $resultado = $this->PrincipalModel->editaFracaoSimproBra($infoFracaoSimproBra,$IdFracaoSimproBra);

        if($resultado == true)
        {
            $process = 'Fração Simpro Bra atualizado';
            $processFunction = 'Principal/editaFracaoSimproBra';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Fração Simpro Bra atualizada com sucesso');
        }
        else
        {
            $this->session->set_flashdata('error', 'Falha na atualização da Fração Simpro Bra');
        }

        redirect('principalFracaoSimproBra/listar');
        // }
    }

    function apagaFracaoSimproBra()
    {

    /*    if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
        {
            redirect('acaoNaoAutorizada');
        } */

        $IdFracaoSimproBra = $this->uri->segment(2);

        $infoFracaoSimproBra = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));

        $resultado = $this->PrincipalModel->apagaFracaoSimproBra($infoFracaoSimproBra, $IdFracaoSimproBra);

        if ($resultado > 0) {
            // echo(json_encode(array('status'=>TRUE)));

            $process = 'Exclusão de Fração Simpro Bra';
            $processFunction = 'Principal/apagaFracaoSimproBra';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Fração Simpro Bra deletada com sucesso');

        }
        else
        {
            //echo(json_encode(array('status'=>FALSE)));
            $this->session->set_flashdata('error', 'Falha em excluir a Fração Simpro Bra');
        }
        redirect('principalFracaoSimproBra/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE FRAÇÃO SIMPRO BRA


    // INICIO DAS FUNÇÕES DA TELA DE FATURAMENTO ITEM

    function principalFaturamentoItem()
    {
        $tpTela = $this->uri->segment(2);

        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

        if ($tpTela == 'listar') {

        /*    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaConvenio') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('telaNaoAutorizada');
            } */

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->CadastroModel->userListingCount($searchText);

            $returns = $this->paginationCompress ( "principalFaturamentoItem/listar", $count, 10 );

            $data['registrosFaturamentoItem'] = $this->PrincipalModel->listaFaturamentoItem($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);

            $process = 'Listar faturamento item';
            $processFunction = 'Principal/principalFaturamentoItem';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'QUALICAD : Lista de Faturamento Item';

            $this->loadViews("qualicad/principal/l_principalFaturamentoItem", $this->global, $data, NULL);
        }
        else if ($tpTela == 'cadastrar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $this->global['pageTitle'] = 'QUALICAD : Cadastro de Faturamento Item';
            $this->loadViews("qualicad/principal/c_principalFaturamentoItem", $this->global, $data, NULL);
        }
        else if ($tpTela == 'editar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $IdFaturamentoItem = $this->uri->segment(3);
            if($IdFaturamentoItem == null)
            {
                redirect('principalFaturamentoItem/listar');
            }
            $data['infoFaturamento'] = $this->PrincipalModel->carregaInfoFaturamentoEmpresa($this->session->userdata('IdEmpresa'));
            $data['infoFaturamentoItem'] = $this->PrincipalModel->carregaInfoFaturamentoItem($IdFaturamentoItem);
            $this->global['pageTitle'] = 'QUALICAD : Editar Faturamento Item';
            $this->loadViews("qualicad/principal/c_principalFaturamentoItem", $this->global, $data, NULL);
        }
    }

    function adicionaFaturamentoItem()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalFaturamentoItem/listar');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
        $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
        $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
        $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */


        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $Ds_FatItem = $this->input->post('Ds_FatItem');
        $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
        $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
        $Vl_Honorário = $this->input->post('Vl_Honorário');
        $Vl_Operacional = $this->input->post('Vl_Operacional');
        $Vl_Total = $this->input->post('Vl_Total');
        $Vl_Filme = $this->input->post('Vl_Filme');
        $Tp_Ativo = $this->input->post('Tp_Ativo');


    //    if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoFaturamentoItem = array('TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento, 'Ds_FatItem'=> $Ds_FatItem,
                'Dt_IniVigencia'=>$Dt_IniVigencia, 'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Honorário'=>$Vl_Honorário,
                'Vl_Operacional'=>$Vl_Operacional,'Vl_Total'=>$Vl_Total, 'Vl_Filme'=>$Vl_Filme,
                'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaFaturamentoItem($infoFaturamentoItem);

            if($result > 0)
            {
                $process = 'Adicionar faturamento item';
                $processFunction = 'Principal/adicionaFaturamentoItem';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Faturamento item criado com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalFaturamentoItem/listar');
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalFaturamentoItem/cadastrar');
                }
                else if (array_key_exists('salvarAvancar',$this->input->post())) {
                    redirect('principalFaturamentoItem/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação do faturamento item');
                redirect('principalFaturamentoItem/cadastrar');
            }

    /*    } else {
            $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            redirect('principalConvenio/cadastrar');
        } */

        redirect('principalFaturamentoItem/cadastrar');

        //    }
    }


    function editaFaturamentoItem()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalFaturamentoItem/listar');
        }

        $this->load->library('form_validation');

        $IdFaturamentoItem = $this->input->post('Id_FatItem');

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

        $TbFaturamento_Id_Faturamento = $this->input->post('TbFaturamento_Id_Faturamento');
        $Ds_FatItem = $this->input->post('Ds_FatItem');
        $Dt_IniVigencia = $this->input->post('Dt_IniVigencia');
        $Dt_FimVigencia = $this->input->post('Dt_FimVigencia');
        $Vl_Honorário = $this->input->post('Vl_Honorário');
        $Vl_Operacional = $this->input->post('Vl_Operacional');
        $Vl_Total = $this->input->post('Vl_Total');
        $Vl_Filme = $this->input->post('Vl_Filme');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

        foreach ($this->PrincipalModel->carregaInfoFaturamentoItem($IdFaturamentoItem) as $data){
            $Tp_Ativo_Atual = ($data->Tp_Ativo);
        }

        //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
        if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
        {
            $Dt_Ativo = date('Y-m-d H:i:s');
            $Dt_Inativo = null;
        } else if ($Tp_Ativo == 'N')
        {
            $Dt_Ativo = null;
            $Dt_Inativo = date('Y-m-d H:i:s');
        }

        //'Senha'=>getHashedPassword($senha)
        $infoFaturamentoItem = array('TbFaturamento_Id_Faturamento'=> $TbFaturamento_Id_Faturamento, 'Ds_FatItem'=> $Ds_FatItem,
        'Dt_IniVigencia'=>$Dt_IniVigencia, 'Dt_FimVigencia'=>$Dt_FimVigencia, 'Vl_Honorário'=>$Vl_Honorário,
        'Vl_Operacional'=>$Vl_Operacional,'Vl_Total'=>$Vl_Total, 'Vl_Filme'=>$Vl_Filme,
        'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
        'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 'Dt_Inativo'=>$Dt_Inativo);

        $resultado = $this->PrincipalModel->editaFaturamentoItem($infoFaturamentoItem,$IdFaturamentoItem);

        if($resultado == true)
        {
            $process = 'Faturamento item atualizado';
            $processFunction = 'Principal/editaFaturamentoItem';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Faturamento item atualizado com sucesso');
        }
        else
        {
            $this->session->set_flashdata('error', 'Falha na atualização do faturamento item');
        }

        redirect('principalFaturamentoItem/listar');
        // }
    }

    function apagaFaturamentoItem()
    {

    /*    if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
        {
            redirect('acaoNaoAutorizada');
        } */

        $IdFaturamentoItem = $this->uri->segment(2);

        $infoFaturamentoItem = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));

        $resultado = $this->PrincipalModel->apagaFaturamentoItem($infoFaturamentoItem, $IdFaturamentoItem);

        if ($resultado > 0) {
            // echo(json_encode(array('status'=>TRUE)));

            $process = 'Exclusão de faturamento item';
            $processFunction = 'Principal/apagaFaturamentoItem';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Faturamento item deletado com sucesso');

        }
        else
        {
            //echo(json_encode(array('status'=>FALSE)));
            $this->session->set_flashdata('error', 'Falha em excluir o faturamento item');
        }
        redirect('principalFaturamentoItem/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE FATURAMENTO ITEM


    // INICIO DAS FUNÇÕES DA TELA DE UNIDADE

    function principalUnidade()
    {
        $tpTela = $this->uri->segment(2);

        $data['perfis'] = $this->CadastroModel->carregaPerfisUsuarios();

        if ($tpTela == 'listar') {

        /*    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaConvenio') ||
                !$this->PermissaoModel->permissaoAcaoConsultar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('telaNaoAutorizada');
            } */

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->CadastroModel->userListingCount($searchText);

            $returns = $this->paginationCompress ( "principalUnidade/listar", $count, 10 );

            $data['registrosUnidade'] = $this->PrincipalModel->listaUnidade($this->session->userdata('IdEmpresa'), $searchText, $returns["page"], $returns["segment"]);

            $process = 'Listar unidade';
            $processFunction = 'Principal/principalUnidade';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'QUALICAD : Lista de Unidade';

            $this->loadViews("qualicad/principal/l_principalUnidade", $this->global, $data, NULL);
        }
        else if ($tpTela == 'cadastrar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoInserir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $this->global['pageTitle'] = 'QUALICAD : Cadastro de Unidade';
            $this->loadViews("qualicad/principal/c_principalUnidade", $this->global, $data, NULL);
        }
        else if ($tpTela == 'editar') {

        /*    if (!$this->PermissaoModel->permissaoAcaoAtualizar($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
            {
                redirect('acaoNaoAutorizada');
            } */

            $IdUnidade = $this->uri->segment(3);
            if($IdUnidade == null)
            {
                redirect('principalUnidade/listar');
            }
            $data['infoUnidade'] = $this->PrincipalModel->carregaInfoUnidade($IdUnidade);
            $this->global['pageTitle'] = 'QUALICAD : Editar Unidade';
            $this->loadViews("qualicad/principal/c_principalUnidade", $this->global, $data, NULL);
        }
    }

    function adicionaUnidade()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalUnidade/listar');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nome_Usuario','Nome','trim|required|max_length[128]');
        $this->form_validation->set_rules('Cpf_Usuario','CPF','trim|required|max_length[128]');
        $this->form_validation->set_rules('Email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('Senha','Senha','required|max_length[20]');
        $this->form_validation->set_rules('resenha','Confirme a senha','trim|required|matches[password]|max_length[20]');

        //VALIDAÇÃO

        //    $this->form_validation->set_rules('perfil','Role','trim|required|numeric');

        /*    if($this->form_validation->run() == FALSE)
            {

                redirect('cadastroUsuario/cadastrar');
            }
            else
        { */

        $Ds_Unidade = $this->input->post('Ds_Unidade');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

    //    if ($this->PrincipalModel->consultaConvenioExistente($CNPJ_Convenio,$this->session->userdata('IdEmpresa')) == null) {

            //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
            if ($Tp_Ativo == 'S')
            {
                $Dt_Ativo = date('Y-m-d H:i:s');
            } else
            {
                $Dt_Ativo = null;
            }

            //'Senha'=>getHashedPassword($senha)

            $infoUnidade = array('TbEmpresa_Id_Empresa'=>$this->session->userdata('IdEmpresa'),
                'Ds_Unidade'=> $Ds_Unidade, 'CriadoPor'=>$this->vendorId, 'AtualizadoPor'=>$this->vendorId,
                'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo);

            $result = $this->PrincipalModel->adicionaUnidade($infoUnidade);

            if($result > 0)
            {
                $process = 'Adicionar unidade';
                $processFunction = 'Principal/adicionaUnidade';
                $this->logrecord($process,$processFunction);

                $this->session->set_flashdata('success', 'Unidade criada com sucesso');

                if (array_key_exists('salvarIrLista',$this->input->post())) {
                    redirect('principalUnidade/listar');
                }
                else if (array_key_exists('salvarMesmaTela',$this->input->post())) {
                    redirect('principalUnidade/cadastrar');
                }
                else if (array_key_exists('salvarAvancar',$this->input->post())) {
                    redirect('principalUnidade/cadastrar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Falha na criação da unidade');
                redirect('principalUnidade/cadastrar');
            }

    /*    } else {
            $this->session->set_flashdata('error', 'Convênio já foi cadastrado!');
            redirect('principalConvenio/cadastrar');
        } */

        redirect('principalUnidade/cadastrar');

        //    }
    }


    function editaUnidade()
    {
        if (array_key_exists('IrLista',$this->input->post())) {
            redirect('principalUnidade/listar');
        }

        $this->load->library('form_validation');

        $IdUnidade = $this->input->post('Id_Unidade');

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

        $Ds_Unidade = $this->input->post('Ds_Unidade');
        $Tp_Ativo = $this->input->post('Tp_Ativo');

        foreach ($this->PrincipalModel->carregaInfoUnidade($IdUnidade) as $data){
            $Tp_Ativo_Atual = ($data->Tp_Ativo);
        }

        //SE O CONVENIO FOR SETADO COMO ATIVO PEGAR DATA ATUAL
        if ($Tp_Ativo_Atual == 'N' && $Tp_Ativo == 'S')
        {
            $Dt_Ativo = date('Y-m-d H:i:s');
            $Dt_Inativo = null;
        } else if ($Tp_Ativo == 'N')
        {
            $Dt_Ativo = null;
            $Dt_Inativo = date('Y-m-d H:i:s');
        }

        //'Senha'=>getHashedPassword($senha)
        
        $infoUnidade = array('Ds_Unidade'=> $Ds_Unidade, 'CriadoPor'=>$this->vendorId, 
        'AtualizadoPor'=>$this->vendorId, 'Tp_Ativo'=>$Tp_Ativo, 'Dt_Ativo'=>$Dt_Ativo, 
        'Dt_Inativo'=>$Dt_Inativo);

        $resultado = $this->PrincipalModel->editaUnidade($infoUnidade,$IdUnidade);

        if($resultado == true)
        {
            $process = 'Unidade atualizada';
            $processFunction = 'Principal/editaUnidade';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Unidade atualizada com sucesso');
        }
        else
        {
            $this->session->set_flashdata('error', 'Falha na atualização da unidade');
        }

        redirect('principalUnidade/listar');
        // }
    }

    function apagaUnidade()
    {

    /*    if (!$this->PermissaoModel->permissaoAcaoExcluir($this->session->userdata('IdUsuEmp'),'TelaConvenio'))
        {
            redirect('acaoNaoAutorizada');
        } */

        $IdUnidade = $this->uri->segment(2);

        $infoUnidade = array('Deletado'=>'S', 'AtualizadoPor'=>$this->vendorId, 'Dt_Atualizacao'=>date('Y-m-d H:i:s'));

        $resultado = $this->PrincipalModel->apagaUnidade($infoUnidade, $IdUnidade);

        if ($resultado > 0) {
            // echo(json_encode(array('status'=>TRUE)));

            $process = 'Exclusão de unidade';
            $processFunction = 'Principal/apagaUnidade';
            $this->logrecord($process,$processFunction);

            $this->session->set_flashdata('success', 'Unidade deletada com sucesso');

        }
        else
        {
            //echo(json_encode(array('status'=>FALSE)));
            $this->session->set_flashdata('error', 'Falha em excluir a unidade');
        }
        redirect('principalUnidade/listar');
    }
    // FIM DAS FUNÇÕES DA TELA DE UNIDADE


    function principalRegraGrupoPro()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Regra Grupo Pro';

        $this->loadViews("qualicad/principal/principalRegraGrupoPro", $this->global, $data, NULL);
    }


    function principalProibicao()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Proibição';

        $this->loadViews("qualicad/principal/principalProibicao", $this->global, $data, NULL);
    }


    function principalPlanoModal()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Plano';

        $this->loadViewsModal("qualicad/principal/principalPlano", $this->global, $data, NULL);
    }


}