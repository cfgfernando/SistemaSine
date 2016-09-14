<?php
/**
 * Turmas Active Record
 * @author  <your-name-here>
 */
class Turmas extends TRecord
{
    const TABLENAME = 'turmas';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $agente_qualificador;
    private $matriculas;
    private $cursos;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome_turma');
        parent::addAttribute('cursos_id');
        parent::addAttribute('agente_qualificador_idagente');
        parent::addAttribute('data_inicio');
        parent::addAttribute('data_final');
        parent::addAttribute('minimo_alunos');
        parent::addAttribute('status');
    }

    
    /**
     * Method set_agente_qualificador
     * Sample of usage: $turmas->agente_qualificador = $object;
     * @param $object Instance of AgenteQualificador
     */
    public function set_agente_qualificador(AgenteQualificador $object)
    {
        $this->agente_qualificador = $object;
        $this->agente_qualificador_id = $object->id;
    }
    
    /**
     * Method get_agente_qualificador
     * Sample of usage: $turmas->agente_qualificador->attribute;
     * @returns AgenteQualificador instance
     */
    public function get_agente_qualificador()
    {
        // loads the associated object
        if (empty($this->agente_qualificador))
            $this->agente_qualificador = new AgenteQualificador($this->agente_qualificador_id);
    
        // returns the associated object
        return $this->agente_qualificador;
    }
    
    /*public function get_agente_qualificador_nome()
    {
        return $this->get_agente_qualificador()->nome;
    }*/
    
    
    /**
     * Method set_matriculas
     * Sample of usage: $turmas->matriculas = $object;
     * @param $object Instance of Matriculas
     */
    public function set_matriculas(Matriculas $object)
    {
        $this->matriculas = $object;
        $this->matriculas_id = $object->id;
    }
    
    /**
     * Method get_matriculas
     * Sample of usage: $turmas->matriculas->attribute;
     * @returns Matriculas instance
     */
    public function get_matriculas()
    {
        // loads the associated object
        if (empty($this->matriculas))
            $this->matriculas = new Matriculas($this->matriculas_id);
    
        // returns the associated object
        return $this->matriculas;
    }
    
    
    /**
     * Method set_cursos
     * Sample of usage: $turmas->cursos = $object;
     * @param $object Instance of Cursos
     */
    public function set_cursos(Cursos $object)
    {
        $this->cursos = $object;
        $this->cursos_id = $object->id;
    }
    
    /**
     * Method get_cursos
     * Sample of usage: $turmas->cursos->attribute;
     * @returns Cursos instance
     */
    public function get_cursos()
    {
        // loads the associated object
        if (empty($this->cursos))
            $this->cursos = new Cursos($this->cursos_id);
    
        // returns the associated object
        return $this->cursos;
    }
    


}
