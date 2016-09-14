<?php
/**
 * Cadpessoas Active Record
 * @author  <your-name-here>
 */
class Cadpessoas extends TRecord
{
    const TABLENAME = 'cadPessoas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dataInscricao');
        parent::addAttribute('nome');
        parent::addAttribute('sexo');
        parent::addAttribute('cpf');
        parent::addAttribute('data_nascimento');
        parent::addAttribute('idade');
        parent::addAttribute('estado_civil');
        parent::addAttribute('local_nasc');
        parent::addAttribute('rg');
        parent::addAttribute('rg_orgEmissor');
        parent::addAttribute('rg_data');
        parent::addAttribute('pai');
        parent::addAttribute('mae');
        parent::addAttribute('endereco');
        parent::addAttribute('numero');
        parent::addAttribute('bairro');
        parent::addAttribute('cidade');
        parent::addAttribute('cep');
        parent::addAttribute('fone');
        parent::addAttribute('celular');
        parent::addAttribute('email');
        parent::addAttribute('pcd');
        parent::addAttribute('qual_pcd');
        parent::addAttribute('escolaridade');
        parent::addAttribute('cursos_qualificacao');
        parent::addAttribute('observacao');
    }


}
