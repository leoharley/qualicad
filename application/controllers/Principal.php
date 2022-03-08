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
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Convênio';
                $this->loadViews("qualicad/principal/c_principalConvenio", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
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
                $data['infoConvenio'] = $this->PrincipalModel->carregaInfoConveniosEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoIndice'] = $this->PrincipalModel->carregaInfoIndicesEmpresa($this->session->userdata('IdEmpresa'));
                $data['infoRegra'] = $this->PrincipalModel->carregaInfoRegrasEmpresa($this->session->userdata('IdEmpresa'));
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Plano';
                $this->loadViews("qualicad/principal/c_principalPlano", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
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
                $this->global['pageTitle'] = 'QUALICAD : Cadastro de Faturamento';
                $this->loadViews("qualicad/principal/c_principalFaturamento", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
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
                $this->global['pageTitle'] = 'QUALICAD : Lista de Regra';
                $this->loadViews("qualicad/principal/c_principalRegra", $this->global, $data, NULL); 
            }
            else if ($tpTela == 'editar') {
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

                    if (!$this->PermissaoModel->permissaoTela($this->session->userdata('IdUsuEmp'),'TelaIndice'))
                    {
                        redirect('noaccess');
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
                    $this->global['pageTitle'] = 'QUALICAD : Cadastro de Índice';
                    $this->loadViews("qualicad/principal/c_principalIndice", $this->global, $data, NULL); 
                }
                else if ($tpTela == 'editar') {
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

    function principalPlanoModal()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Plano';

        $this->loadViewsModal("qualicad/principal/principalPlano", $this->global, $data, NULL);
    }

    function principalFaturamentoItem()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Faturamento Item';

        $this->loadViews("qualicad/principal/principalFaturamentoItem", $this->global, $data, NULL);
    }

    function principalRegraGrupoPro()
    {
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'QUALICAD : Regra Grupo Pro';

        $this->loadViews("qualicad/principal/principalRegraGrupoPro", $this->global, $data, NULL);
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