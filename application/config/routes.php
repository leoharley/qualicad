<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "login";
$route['404_override'] = 'login/error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';

/*********** ROUTES DE CADASTRO *******************/
$route['cadastroUsuario'] = "cadastro/cadastroUsuario";
$route['cadastroEmpresa'] = "cadastro/cadastroEmpresa";
$route['cadastroUsuarioEmpresa'] = "cadastro/cadastroUsuarioEmpresa";
$route['cadastroPerfil'] = "cadastro/cadastroPerfil";
$route['cadastroPermissao'] = "cadastro/cadastroPermissao";
$route['cadastroTelas'] = "cadastro/cadastroTelas";

/*********** ROUTES DO PRINCIPAL *******************/
$route['principalConvenio'] = "principal/principalConvenio";
$route['principalPlano'] = "principal/principalPlano";
$route['principalFaturamento'] = "principal/principalFaturamento";
$route['principalFaturamentoItem'] = "principal/principalFaturamentoItem";
$route['principalRegra'] = "principal/principalRegra";
$route['principalRegraGrupoPro'] = "principal/principalRegraGrupoPro";
$route['principalIndice'] = "principal/principalIndice";
$route['principalIndiceGrupoPro'] = "principal/principalIndiceGrupoPro";
$route['principalProibicao'] = "principal/principalProibicao";
$route['principalRegraProibicao'] = "principal/principalRegraProibicao";
$route['principalFracaoSimproBra'] = "principal/principalFracaoSimproBra";
$route['principalUnidade'] = "principal/principalUnidade";


/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
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