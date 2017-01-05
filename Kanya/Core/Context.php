<?php

namespace Kanya\Core\Kanya;

class Context extends KanyaClass {
    
    protected $core;
    protected $request;
    protected $response;
    protected $router;

    public function setCoreClass(Kanya $kanya){
        $this->core = Kanya::parse($kanya);
    }
    
    public function setRequestClass(Http\Request $req){
        $this->request = Http\Request::parse($req);
    }
    
    public function setResponseClass(Http\Response $res){
        $this->response = Http\Response::parse($res);
    }
    
    public function setRouterClass(Router $router){
        $this->router = Router::parse($router);
    }
    
    public function core(){
        return $this->core;
    }
    
    public function request(){
        return $this->request;
    }
    
    public function response(){
        return $this->response;
    }
    
    public function router(){
        return $this->router;
    }
    
}
