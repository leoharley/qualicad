<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "login";
$route['404_override'] = 'login/error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';

$route['welcome'] = 'login/welcome';

$route['escolheEmpresa'] = 'login/escolheEmpresa';

/*********** ROUTES DE CADASTRO *******************/
$route['cadastroUsuario/:any/:any'] = "cadastro/cadastroUsuario/$1/$2";
$route['cadastroUsuario/:any'] = "cadastro/cadastroUsuario/$1";

$route['cadastroEmpresa/:any/:any'] = "cadastro/cadastroEmpresa/$1/$2";
$route['cadastroEmpresa/:any'] = "cadastro/cadastroEmpresa/$1";

$route['cadastroPerfil/:any/:any'] = "cadastro/cadastroPerfil/$1/$2";
$route['cadastroPerfil/:any'] = "cadastro/cadastroPerfil/$1";

$route['cadastroTelas/:any/:any'] = "cadastro/cadastroTelas/$1/$2";
$route['cadastroTelas/:any'] = "cadastro/cadastroTelas/$1";

$route['cadastroPermissao/:any/:any'] = "cadastro/cadastroPermissao/$1/$2";
$route['cadastroPermissao/:any'] = "cadastro/cadastroPermissao/$1";

$route['cadastroUsuarioEmpresa/:any/:any'] = "cadastro/cadastroUsuarioEmpresa/$1/$2";
$route['cadastroUsuarioEmpresa/:any'] = "cadastro/cadastroUsuarioEmpresa/$1";

/*********** ROUTES PARA AÇÕES DA TELA USUÁRIO *******************/
$route['adicionaUsuario'] = "cadastro/adicionaUsuario";
$route['editaUsuario'] = "cadastro/editaUsuario";
$route['apagaUsuario/:any'] = "cadastro/apagaUsuario/$1";

/*********** ROUTES PARA AÇÕES DA TELA EMPRESA *******************/
$route['adicionaEmpresa'] = "cadastro/adicionaEmpresa";
$route['editaEmpresa'] = "cadastro/editaEmpresa";
$route['apagaEmpresa/:any'] = "cadastro/apagaEmpresa/$1";

/*********** ROUTES PARA AÇÕES DA TELA PERFIL *******************/
$route['adicionaPerfil'] = "cadastro/adicionaPerfil";
$route['editaPerfil'] = "cadastro/editaPerfil";
$route['apagaPerfil/:any'] = "cadastro/apagaPerfil/$1";

/*********** ROUTES PARA AÇÕES DA TELA TELAS *******************/
$route['editaTelas'] = "cadastro/editaTelas";

/*********** ROUTES PARA AÇÕES DA TELA PERMISSAO *******************/
$route['editaPermissao'] = "cadastro/editaPermissao";

/*********** ROUTES PARA AÇÕES DA TELA USUÁRIO/EMPRESA *******************/
$route['adicionaUsuarioEmpresa'] = "cadastro/adicionaUsuarioEmpresa";
$route['editaUsuarioEmpresa'] = "cadastro/editaUsuarioEmpresa";
$route['apagaUsuarioEmpresa/:any/:any'] = "cadastro/apagaUsuarioEmpresa/$1/$2";


/*********** ROUTES DO PRINCIPAL *******************/
$route['principalConvenio/:any/:any'] = "principal/principalConvenio/$1/$2";
$route['principalConvenio/:any'] = "principal/principalConvenio/$1";

$route['principalPlano/:any/:any'] = "principal/principalPlano/$1/$2";
$route['principalPlano/:any'] = "principal/principalPlano/$1";

$route['principalFaturamento/:any/:any'] = "principal/principalFaturamento/$1/$2";
$route['principalFaturamento/:any'] = "principal/principalFaturamento/$1";

$route['principalRegra/:any/:any'] = "principal/principalRegra/$1/$2";
$route['principalRegra/:any'] = "principal/principalRegra/$1";

$route['principalIndice/:any/:any'] = "principal/principalIndice/$1/$2";
$route['principalIndice/:any'] = "principal/principalIndice/$1";

/*********** ROUTES PARA AÇÕES DA TELA CONVÊNIO *******************/
$route['adicionaConvenio'] = "principal/adicionaConvenio";
$route['editaConvenio'] = "principal/editaConvenio";
$route['apagaConvenio/:any'] = "principal/apagaConvenio/$1";

/*********** ROUTES PARA AÇÕES DA TELA PLANO *******************/
$route['adicionaPlano'] = "principal/adicionaPlano";
$route['editaPlano'] = "principal/editaPlano";
$route['apagaPlano/:any'] = "principal/apagaPlano/$1";

/*********** ROUTES PARA AÇÕES DA TELA FATURAMENTO *******************/
$route['adicionaFaturamento'] = "principal/adicionaFaturamento";
$route['editaFaturamento'] = "principal/editaFaturamento";
$route['apagaFaturamento/:any'] = "principal/apagaFaturamento/$1";

/*********** ROUTES PARA AÇÕES DA TELA REGRA *******************/
$route['adicionaRegra'] = "principal/adicionaRegra";
$route['editaRegra'] = "principal/editaRegra";
$route['apagaRegra/:any'] = "principal/apagaRegra/$1";

/*********** ROUTES PARA AÇÕES DA TELA ÍNDICE *******************/
$route['adicionaIndice'] = "principal/adicionaIndice";
$route['editaIndice'] = "principal/editaIndice";
$route['apagaIndice/:any'] = "principal/apagaIndice/$1";


$route['principalFaturamentoItem'] = "principal/principalFaturamentoItem";
$route['principalRegraGrupoPro'] = "principal/principalRegraGrupoPro";
$route['principalIndiceGrupoPro'] = "principal/principalIndiceGrupoPro";
$route['principalProibicao'] = "principal/principalProibicao";
$route['principalRegraProibicao'] = "principal/principalRegraProibicao";
$route['principalFracaoSimproBra'] = "principal/principalFracaoSimproBra";
$route['principalUnidade'] = "principal/principalUnidade";

$route['principalPlanoModal'] = "principal/principalPlanoModal";


/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
$route['telaProibida'] = 'login/telaProibida';
$route['userListing'] = 'admin/userListing';
$route['userListing/(:num)'] = "admin/userListing/$1";
$route['addNew'] = "admin/addNew";
$route['addNewUser'] = "admin/addNewUser";
$route['editOld'] = "admin/editOld";
$route['editOld/(:num)'] = "admin/editOld/$1";
$route['editUser'] = "admin/editUser";
$route['deleteUser'] = "admin/deleteUser";
$route['log-history'] = "admin/logHistory";
$route['log-history-backup'] = "admin/logHistoryBackup";
$route['log-history/(:num)'] = "admin/logHistorysingle/$1";
$route['log-history/(:num)/(:num)'] = "admin/logHistorysingle/$1/$2";
$route['backupLogTable'] = "admin/backupLogTable";
$route['backupLogTableDelete'] = "admin/backupLogTableDelete";
$route['log-history-upload'] = "admin/logHistoryUpload";
$route['logHistoryUploadFile'] = "admin/logHistoryUploadFile";

/*********** MANAGER CONTROLLER ROUTES *******************/
$route['tasks'] = "manager/tasks";
$route['addNewTask'] = "manager/addNewTask";
$route['addNewTasks'] = "manager/addNewTasks";
$route['editOldTask/(:num)'] = "manager/editOldTask/$1";
$route['editTask'] = "manager/editTask";
$route['deleteTask/(:num)'] = "manager/deleteTask/$1";

/*********** USER CONTROLLER ROUTES *******************/
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['endTask/(:num)'] = "user/endTask/$1";
$route['etasks'] = "user/etasks";
$route['userEdit'] = "user/loadUserEdit";
$route['updateUser'] = "user/updateUser";


/*********** LOGIN CONTROLLER ROUTES *******************/
$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */