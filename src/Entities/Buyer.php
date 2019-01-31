<?php

namespace Mobly\Boletoflex\Sdk\Entities;


class Buyer
{

    /** @var string */
    protected $cpf;

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

}