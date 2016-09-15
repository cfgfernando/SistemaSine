<?php
/**
 * Matriculas Active Record
 * @author  <your-name-here>
 */
class Matriculas extends TRecord
{
    const TABLENAME = 'matriculas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $turmas;
    private $cadpessoas;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('turmas_id');
        parent::addAttribute('data_inscricao');
        parent::addAttribute('status');
        parent::addAttribute('cadPessoas_id');
    }

    
    /**
     * Method set_turmas
     * Sample of usage: $matriculas->turmas = $object;
     * @param $object Instance of Turmas
     */
    public function set_turmas(Turmas $object)
    {
        $this->turmas = $object;
        $this->turmas_id = $object->id;
    }
    
    /**
     * Method get_turmas
     * Sample of usage: $matriculas->turmas->attribute;
     * @returns Turmas instance
     */
    public function get_turmas()
    {
        // loads the associated object
        if (empty($this->turmas))
            $this->turmas = new Turmas($this->turmas_id);
    
        // returns the associated object
        return $this->turmas;
    }
    
    
    /**
     * Method set_cadpessoas
     * Sample of usage: $matriculas->cadpessoas = $object;
     * @param $object Instance of Cadpessoas
     */
    public function set_cadpessoas(Cadpessoas $object)
    {
        $this->cadpessoas = $object;
        $this->cadpessoas_id = $object->id;
    }
    
    /**
     * Method get_cadpessoas
     * Sample of usage: $matriculas->cadpessoas->attribute;
     * @returns Cadpessoas instance
     */
    public function get_cadpessoas()
    {
        // loads the associated object
        if (empty($this->cadpessoas))
            $this->cadpessoas = new Cadpessoas($this->cadpessoas_id);
    
        // returns the associated object
        return $this->cadpessoas;
    }
    


}
