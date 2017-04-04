<?php

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
    $breadcrumbs->push('Adicionar pacote', route('admin.account.create', $user->id));
});

/*
* Breadcrumb to Admin's Page Account info
*/
Breadcrumbs::register('admin.account.show', function($breadcrumbs, $conta)
{
    $breadcrumbs->parent('admin.user.show', $conta->user);
    $breadcrumbs->push('Informaçẽs do pacote', route('admin.account.show', [$conta->user->id, $conta->idConta]));
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
