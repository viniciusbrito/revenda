<?php
/*****************************************************USER'S DASHBOARD***********************************************/
/*
* Breadcrumb to User Home
*/
Breadcrumbs::register('client.index', function($breadcrumbs)
{
    $breadcrumbs->push('Pagina Inicial', route('client.index'));
});

/*
* Breadcrumb to Admin's Page User edit
*/
Breadcrumbs::register('client.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('client.index');
    $breadcrumbs->push('Atualizar dados', route('client.edit', Auth::user()->id));
});

/*
* Breadcrumb to Admin's Form Account Create
*/
Breadcrumbs::register('client.account.create', function($breadcrumbs)
{
    $breadcrumbs->parent('client.index');
    $breadcrumbs->push('Adicionar conta', route('client.account.create'));
});

/*
* Breadcrumb to Admin's Form Account Info
*/
Breadcrumbs::register('client.account.show', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('client.index', $conta->user);
    $breadcrumbs->push('Informações da conta', route('client.account.show', $conta->idConta));
});

/*
* Breadcrumb to User's Page Payment Create
*/
Breadcrumbs::register('client.payment.create', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('client.account.show', $conta);
    $breadcrumbs->push('Pagamento', route('client.payment.create', $conta->idConta));
});

/*
 * Breadcrumb to User's Page Payment List
 */
Breadcrumbs::register('client.payment.index', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('client.account.show', $conta);
    $breadcrumbs->push('Pagamentos', route('client.payment.index', $conta->idConta));
});

/*
 * Breadcrumb to User's Page Payment info
 */
Breadcrumbs::register('client.payment.show', function($breadcrumbs, $pagamento)
{
    $breadcrumbs->parent('client.payment.index', $pagamento->conta);
    $breadcrumbs->push($pagamento->codigo, route('client.payment.show', [$pagamento->conta->idConta, $pagamento->idPagamento]));
});



/*****************************************************ADMIN'S DASHBOARD************************************************/
/*
* Breadcrumb to Admin's Dashboard
*/
Breadcrumbs::register('admin.dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});

/*
* Breadcrumb to Admin's Form User create
*/
Breadcrumbs::register('admin.user.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Novo Usuário', route('admin.user.create'));
});


/*
* Breadcrumb to Admin's Page User info
*/
Breadcrumbs::register('admin.user.show', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push("Usuário {{$user->nome}}", route('admin.user.show', $user->id));
});

/*
* Breadcrumb to Admin's Form User Edit
*/
Breadcrumbs::register('admin.user.edit', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('admin.user.show', $user);
    $breadcrumbs->push('Atualizar Usuário', route('admin.user.edit', $user->id));
});


/*
* Breadcrumb to Admin's Form Accout Create
*/
Breadcrumbs::register('admin.account.create', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('admin.user.show', $user);
    $breadcrumbs->push('Adicionar conta', route('admin.account.create', $user->id));
});

/*
* Breadcrumb to Admin's Page Account info
*/
Breadcrumbs::register('admin.account.show', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('admin.user.show', $conta->user);
    $breadcrumbs->push('Informações da conta', route('admin.account.show', [$conta->user->id, $conta->idConta]));
});

/*
* Breadcrumb to Admin's Page Payment Create
*/
Breadcrumbs::register('admin.payment.create', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('admin.account.show', $conta);
    $breadcrumbs->push('Pagamento', route('admin.payment.create', $conta->idConta));
});

/*
 * Breadcrumb to Admin's Page Payment List
 */
Breadcrumbs::register('admin.payment.index', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('admin.account.show', $conta);
    $breadcrumbs->push('Pagamentos', route('admin.payment.index', $conta->idConta));
});

/*
 * Breadcrumb to Admin's Page Payment info
 */
Breadcrumbs::register('admin.payment.show', function($breadcrumbs, $pagamento)
{
    $breadcrumbs->parent('admin.payment.index', $pagamento->conta);
    $breadcrumbs->push($pagamento->codigo, route('admin.payment.show', [$pagamento->conta->idConta, $pagamento->idPagamento]));
});
