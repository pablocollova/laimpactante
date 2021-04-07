<?php

namespace Controllers;

use \Exception as Exception;
use DAO\Factura as CuentaCorrienteDAO;
use Models\CuentaCorriente as CuentaCorriente;


class CuentaCorrienteController{

    private $CuentaCorrienteDAO;

    public function __construct()
    {
        $this->CuentaCorrienteDAO = new CuentaCorrienteDAO();
    }

}

?>