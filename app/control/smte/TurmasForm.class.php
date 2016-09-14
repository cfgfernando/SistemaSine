<?php
/**
 * TurmasForm Form
 * @author  <your name here>
 */
class TurmasForm extends TPage
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TQuickForm('form_Turmas');
        $this->form->class = 'tform'; // change CSS class
        
        $this->form->style = 'display: table;width:100%'; // change style
        
        // define the form title
        $this->form->setFormTitle('Turmas');
        


        // create the form fields
        $id = new THidden('id');
        $nome_turma = new TEntry('nome_turma');
        $cursos_id = new TDBCombo('cursos_id', 'sistemaSine', 'Cursos', 'id', 'nome');
        $agente_qualificador_idagente = new TDBCombo('agente_qualificador_idagente','sistemaSine', 'AgenteQualificador', 'idagente', 'nome');
        $data_inicio = new TDate('data_inicio');
        $data_final = new TDate('data_final');
        $minimo_alunos = new TEntry('minimo_alunos');
        $status = new TCombo('status');
        
        
        $data_inicio->setSize(95);
        $data_final->setSize(95);
        
        
        
         //combo status
        $combo_status = array();
        $combo_status['Aberta'] ='Aberta';
        $combo_status['Fechada'] ='Fechada';
        $combo_status['Cancelada'] ='Cancelada';
        
        $status->addItems($combo_status);
        


        // add the fields
        $this->form->addQuickField('ID', $id,  40 );
        $this->form->addQuickField('Nome da Turma', $nome_turma,330);
        $this->form->addQuickField('Cursos Id', $cursos_id,  330 );
        $this->form->addQuickField('Agente Qualificador Idagente', $agente_qualificador_idagente, 330);
        $this->form->addQuickFields('Data de Inicio:', array($data_inicio, new TLabel('Data Término:'), $data_final));
        $this->form->addQuickField('Minimo Alunos', $minimo_alunos,  100 );
        $this->form->addQuickField('Status', $status,  200 );




        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        /** samples
         $this->form->addQuickFields('Date', array($date1, new TLabel('to'), $date2)); // side by side fields
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( 100, 40 ); // set size
         **/
         
        // create the form actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $this->form->addQuickAction(_t('New'),  new TAction(array($this, 'onClear')), 'bs:plus-sign green');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 50%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param )
    {
        try
        {
            TTransaction::open('sistemaSine'); // open a transaction
            
            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/
            
            $this->form->validate(); // validate form data
            
            $object = new Turmas;  // create an empty object
            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            // get the generated id
            $data->id = $object->id;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', TAdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear();
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('sistemaSine'); // open a transaction
                $object = new Turmas($key); // instantiates the Active Record
                $this->form->setData($object); // fill the form
                TTransaction::close(); // close the transaction
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
}
