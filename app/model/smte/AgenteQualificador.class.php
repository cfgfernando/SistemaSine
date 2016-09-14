<?php
/**
 * AgenteQualificador Active Record
 * @author  <your-name-here>
 */
class AgenteQualificador extends TRecord
{
    const TABLENAME = 'agente_qualificador';
    const PRIMARYKEY= 'idagente';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('descricao');
    }


}
