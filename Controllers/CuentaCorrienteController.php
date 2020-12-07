<?php

namespace Controllers;

use \Exception as Exception;
use DAO\CuentaCorrienteDAO as CuentaCorrienteDAO;
use Models\CuentaCorriente as CuentaCorriente;


class CuentaCorrienteController{

    private $CuentaCorrienteDAO;

    public function __construct()
    {
        $this->CuentaCorrienteDAO = new CuentaCorrienteDAO();
    }

}

?>