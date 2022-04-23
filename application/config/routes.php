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

$route['principalRegraGruPro/:any/:any'] = "principal/principalRegraGruPro/$1/$2";
$route['principalRegraGruPro/:any'] = "principal/principalRegraGruPro/$1";

$route['principalIndice/:any/:any'] = "principal/principalIndice/$1/$2";
$route['principalIndice/:any'] = "principal/principalIndice/$1";

$route['principalIndiceGrupoPro/:any/:any'] = "principal/principalIndiceGrupoPro/$1/$2";
$route['principalIndiceGrupoPro/:any'] = "principal/principalIndiceGrupoPro/$1";

$route['principalRegraProibicao/:any/:any'] = "principal/principalRegraProibicao/$1/$2";
$route['principalRegraProibicao/:any'] = "principal/principalRegraProibicao/$1";

$route['principalFracaoSimproBra/:any/:any'] = "principal/principalFracaoSimproBra/$1/$2";
$route['principalFracaoSimproBra/:any'] = "principal/principalFracaoSimproBra/$1";

$route['principalFaturamentoItem/:any/:any'] = "principal/principalFaturamentoItem/$1/$2";
$route['principalFaturamentoItem/:any'] = "principal/principalFaturamentoItem/$1";

$route['principalUnidade/:any/:any'] = "principal/principalUnidade/$1/$2";
$route['principalUnidade/:any'] = "principal/principalUnidade/$1";

$route['principalExcecaoValores/:any/:any'] = "principal/principalExcecaoValores/$1/$2";
$route['principalExcecaoValores/:any'] = "principal/principalExcecaoValores/$1";

/*********** ROUTES DA IMPORTAÇÃO *******************/
$route['importacaoFatItem'] = "importacao/importacaoFatItem";
$route['importaFatItem'] = "importacao/importaFatItem";

$route['importacaoGrupoPro'] = "importacao/importacaoGrupoPro";
$route['importaGrupoPro'] = "importacao/importaGrupoPro";

$route['importacaoProFat'] = "importacao/importacaoProFat";
$route['importaProFat'] = "importacao/importaProFat";

$route['importacaoTUSS'] = "importacao/importacaoTUSS";
$route['importaTUSS'] = "importacao/importaTUSS";

$route['importacaoRegraGruPro'] = "importacao/importacaoRegraGruPro";
$route['importaRegraGruPro'] = "importacao/importaRegraGruPro";

$route['importacaoFracaoSimproBra'] = "importacao/importacaoFracaoSimproBra";
$route['importaFracaoSimproBra'] = "importacao/importaFracaoSimproBra";

$route['importacaoProduto'] = "importacao/importacaoProduto";
$route['importaProduto'] = "importacao/importaProduto";

$route['importacaoProducao'] = "importacao/importacaoProducao";
$route['importaProducao'] = "importacao/importaProducao";

$route['importacaoContrato'] = "importacao/importacaoContrato";
$route['importaContrato'] = "importacao/importaContrato";

$route['importacaoPorteMedico'] = "importacao/importacaoPorteMedico";
$route['importaPorteMedico'] = "importacao/importaPorteMedico";

$route['importacaoExcecaoValores'] = "importacao/importacaoExcecaoValores";
$route['importaExcecaoValores'] = "importacao/importaExcecaoValores";

$route['importacaoDePara/:any/:any'] = "importacao/importacaoDePara/$1/$2";
$route['importacaoDePara/:any'] = "importacao/importacaoDePara/$1";

$route['layoutImportacao/:any/:any'] = "importacao/layoutImportacao/$1/$2";
$route['layoutImportacao/:any'] = "importacao/layoutImportacao/$1";

$route['adicionaLayoutImportacao'] = "importacao/adicionaLayoutImportacao";
$route['editaLayoutImportacao'] = "importacao/editaLayoutImportacao";
$route['apagaLayoutImportacao/:any'] = "importacao/apagaLayoutImportacao/$1";


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

/*********** ROUTES PARA AÇÕES DA TELA REGRA GRUPOPRO*******************/
$route['adicionaRegraGruPro'] = "principal/adicionaRegraGruPro";
$route['editaRegraGruPro'] = "principal/editaRegraGruPro";
$route['apagaRegraGruPro/:any'] = "principal/apagaRegraGruPro/$1";

/*********** ROUTES PARA AÇÕES DA TELA ÍNDICE *******************/
$route['adicionaIndice'] = "principal/adicionaIndice";
$route['editaIndice'] = "principal/editaIndice";
$route['apagaIndice/:any'] = "principal/apagaIndice/$1";

/*********** ROUTES PARA AÇÕES DA TELA ÍNDICE GRUPO PRO *******************/
$route['adicionaIndiceGrupoPro'] = "principal/adicionaIndiceGrupoPro";
$route['editaIndiceGrupoPro'] = "principal/editaIndiceGrupoPro";
$route['apagaIndiceGrupoPro/:any'] = "principal/apagaIndiceGrupoPro/$1";

/*********** ROUTES PARA AÇÕES DA TELA DE REGRA PROIBIÇÃO *******************/
$route['adicionaRegraProibicao'] = "principal/adicionaRegraProibicao";
$route['editaRegraProibicao'] = "principal/editaRegraProibicao";
$route['apagaRegraProibicao/:any'] = "principal/apagaRegraProibicao/$1";

/*********** ROUTES PARA AÇÕES DA TELA DE FRAÇÃO SIMPRO BRA *******************/
$route['adicionaFracaoSimproBra'] = "principal/adicionaFracaoSimproBra";
$route['editaFracaoSimproBra'] = "principal/editaFracaoSimproBra";
$route['apagaFracaoSimproBra/:any'] = "principal/apagaFracaoSimproBra/$1";

/*********** ROUTES PARA AÇÕES DA TELA DE FATURAMENTO ITEM *******************/
$route['adicionaFaturamentoItem'] = "principal/adicionaFaturamentoItem";
$route['editaFaturamentoItem'] = "principal/editaFaturamentoItem";
$route['apagaFaturamentoItem/:any'] = "principal/apagaFaturamentoItem/$1";

/*********** ROUTES PARA AÇÕES DA TELA DE UNIDADE *******************/
$route['adicionaUnidade'] = "principal/adicionaUnidade";
$route['editaUnidade'] = "principal/editaUnidade";
$route['apagaUnidade/:any'] = "principal/apagaUnidade/$1";

/*********** ROUTES PARA AÇÕES DA TELA EXCEÇÃO VALORES *******************/
$route['adicionaExcecaoValores'] = "principal/adicionaExcecaoValores";
$route['editaExcecaoValores'] = "principal/editaExcecaoValores";
$route['apagaExcecaoValores/:any'] = "principal/apagaExcecaoValores/$1";

$route['principalProibicao'] = "principal/principalProibicao";

$route['principalPlanoModal'] = "principal/principalPlanoModal";


/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
$route['telaNaoAutorizada'] = 'login/telaNaoAutorizada';
$route['acaoNaoAutorizada'] = 'login/acaoNaoAutorizada';
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