<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\MySweepstakesController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\TermsOfUseController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
| Rotas principais da aplicação.
*/

// Middleware 'check' aplicado a todas as rotas (conforme ficheiro original)
Route::middleware(['check'])->group(function () {

    // Rotas de Autenticação
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Rotas Públicas
    Route::get('/', [ProductController::class, 'index'])->name('inicio');
    Route::get('/ganhadores', [ProductController::class, 'ganhadores'])->name('ganhadores');
    Route::get('/sorteios', [ProductController::class, 'sorteios'])->name('sorteios');
    Route::get('sorteio/{slug}/{tokenAfiliado?}', [ProductController::class, 'product'])->name('product');
    Route::post('buscar-numeros', [ProductController::class, 'getRaffles'])->name('getRafflesAjax');
    Route::post('cadastra-participante', [ProductController::class, 'bookProduct'])->name('bookProduct');
    Route::post('pesquisa-numeros', [ProductController::class, 'searchNumbers'])->name('searchNumbers');
    Route::get('regulamento', [RegulationController::class, 'index'])->name('regulation');
    Route::get('termos-de-uso', [TermsOfUseController::class, 'index'])->name('terms');
    Route::get('politica-privacidade', [TermsOfUseController::class, 'politica'])->name('politica');
    Route::post('consultar-reserva', [CheckoutController::class, 'consultingReservation'])->name('consultingReservation');
    Route::get('reserva/{productID}/{telephone}', [CheckoutController::class, 'consultingReservationTelephone'])->name('consultingReservationTelephone');
    
    // ROTA CORRIGIDA: Esta linha foi adicionada para definir a rota 'minhasReservas'.
    Route::post('minhas-reservas', [CheckoutController::class, 'minhasReservas'])->name('minhasReservas');

    // Rotas de Checkout
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::get('/success/{id}', [CheckoutController::class, 'findPixStatus'])->name('success');
        Route::get('/pedido/{id}', [CheckoutController::class, 'findPedidoStatus'])->name('pedido');
        Route::post('/pagamento-pix', [CheckoutController::class, 'paymentPix'])->name('paymentPix');
    });

    // Rotas de Afiliados
    Route::prefix('area-afiliado')->name('afiliado.')->group(function () {
        Route::get('/', [AfiliadoController::class, 'index'])->name('home');
        Route::get('/cadastro', [AfiliadoController::class, 'cadastro'])->name('cadastro');
        Route::post('/novo-cadastro', [AfiliadoController::class, 'novo'])->name('novo');
        Route::post('/login', [AfiliadoController::class, 'login'])->name('login');
        Route::get('/logout', [AfiliadoController::class, 'logout'])->name('logout');

        Route::middleware(['auth', 'isAfiliado'])->group(function () {
            Route::get('/rifas-ativas', [AfiliadoController::class, 'rifasAtivas'])->name('rifas');
            Route::get('/pagamentos', [AfiliadoController::class, 'pagamentos'])->name('pagamentos');
            Route::get('/afiliar-se/{idRifa}', [AfiliadoController::class, 'afiliar'])->name('afiliarSe');
            Route::get('/solicitar-saque', [AfiliadoController::class, 'solicitarSaque'])->name('solicitarSaque');
        });
    });

    // Rotas de Administração
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function () {
        Route::get('/home', [HomeAdminController::class, 'index'])->name('home');
        
        // Clientes
        Route::get('/clientes/{search?}', [HomeAdminController::class, 'clientes'])->name('clientes.index');
        Route::get('/clientes/{id}/editar', [HomeAdminController::class, 'editarCliente'])->name('clientes.edit');
        Route::put('/cliente/{id}', [HomeAdminController::class, 'updateCliente'])->name('clientes.update');
        
        // Produtos (Sorteios)
        Route::get('/adicionar-sorteio', [ProductAdminController::class, 'index'])->name('product.create');
        Route::post('/add-sorteio', [ProductAdminController::class, 'addProduct'])->name('product.store');
        Route::post('/duplicar-sorteio', [ProductAdminController::class, 'duplicar'])->name('product.duplicate');
        Route::post('/altera-produto', [ProductAdminController::class, 'alterProduct'])->name('product.alter');
        Route::delete('/destroy', [ProductAdminController::class, 'destroy'])->name('product.destroy');
        Route::post('/favoritar-produto', [ProductAdminController::class, 'favoritarRifa'])->name('product.favorite');
        Route::post('/add-foto-rifa', [ProductAdminController::class, 'addFoto'])->name('product.addPhoto');
        Route::post('/altera-status-produto', [ProductAdminController::class, 'alterStatusProduct'])->name('product.alterStatus');

        // Meus Sorteios
        Route::get('/meus-sorteios', [MySweepstakesController::class, 'index'])->name('mySweepstakes');
        Route::put('/update/{id}', [MySweepstakesController::class, 'update'])->name('update');
        Route::get('/compras/{idRifa}', [MySweepstakesController::class, 'compras'])->name('rifa.compras');

        // Perfil e Configurações
        Route::get('/perfil', [MySweepstakesController::class, 'profile'])->name('profile');
        Route::post('/perfil', [MySweepstakesController::class, 'updateProfile'])->name('profile.update');
        Route::post('/pixel', [MySweepstakesController::class, 'pixel'])->name('pixel');
        
        // Ganhadores
        Route::get('/ganhadores', [MySweepstakesController::class, 'ganhadores'])->name('winners');
        Route::post('/add-foto-ganhador', [MySweepstakesController::class, 'addFotoGanhador'])->name('winner.addPhoto');
        Route::post('/definir-ganhador', [ProductController::class, 'definirGanhador'])->name('defineWinner');

        // WPP Mensagens
        Route::get('/wpp-mensagens', [HomeAdminController::class, 'wpp'])->name('wpp.index');
        Route::post('/wpp-mensagens/salvar', [HomeAdminController::class, 'wppSalvar'])->name('wpp.save');
    });

});

