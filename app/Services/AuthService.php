<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    private $repository;
    public function __construct(AuthRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function me(Request $request)
    {
        $uri = $request->input('route') ?? '';
        $route = explode('.',$uri)[0] ?? null;
        $user = $this->repository->get(Auth()->user()->id);
        $menuList = [];
        $perfilIds = [];
        foreach($user->perfis as $perfil) {
            if(!in_array($perfil->id, $perfilIds)) {
                $perfilIds[] = $perfil->id;
            }
        }
        $menuList = $this->repository->getMenuList($perfilIds, $route);
        $user->menu_itens = $menuList;
        return $user;
    }
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)):
            return redirect()
                ->to('login')
                ->withErrors("Erro ao Autenticar, Verifique o Nome de Utilizador/Senha");
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }
    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
