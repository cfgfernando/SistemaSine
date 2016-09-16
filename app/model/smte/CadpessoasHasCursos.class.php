<?php
/**
 * CadpessoasHasCursos Active Record
 * @author  <your-name-here>
 */
class CadpessoasHasCursos extends TRecord
{
    const TABLENAME = 'cadPessoas_has_cursos';
    const PRIMARYKEY= 'cadPessoas_id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cadPessoas_cpf');
        parent::addAttribute('cursos_id');
        parent::addAttribute('cursos_nome');
    }


}
