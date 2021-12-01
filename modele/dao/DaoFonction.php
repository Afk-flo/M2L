<?php

class DaoFonction {
    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

}