<?php
/**
 * MatriculasFormSeekButton Form
 * @author  <your name here>
 */
class MatriculasFormSeekButton extends TPage
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
        $this->form = new TQuickForm('form_Matriculas');
        $this->form->class = 'tform'; // change CSS class
        
        $this->form->style = 'display: table;width:100%'; // change style
        
        // define the form title
        $this->form->setFormTitle('Matriculas');
        


        // create the form fields
        $id = new THidden('id');
        $cadPessoas_id =  new TDBSeekButton ('cadPessoas_id', 'sistemaSine', 'form_Matriculas', 'Cadpessoas', 'nome', 'cadPessoas_id', 'nome');
        $nome = new TEntry ('nome');
        $turmas_id = new TDBCombo('turmas_id', 'sistemaSine', 'Turmas', 'id', 'nome_turma');
        $data_inscricao = new THidden('data_inscricao');
        $status = new TCombo ('status');
        
        
        
        //combo campo status
        $combo_status = array();
        $combo_status['AGUARDANDO CONFIRMACAO'] = 'Aguardando Confirmação';
        $combo_status['MATRICULADO'] ='Matriculado';
        $combo_status['DESISTENTE'] ='Desistente';
        
        $status->addItems($combo_status);
        $status->setValue('AGUARDANDO CONFIRMACAO');
        
      
        $cadPessoas_id->setSize(60);
        $nome->setSize(400);
        $nome->setEditable(FALSE);
        $data_inscricao->setSize(100);
        $data_inscricao->setValue(date('Y-m-d'));
        $data_inscricao->setEditable(FALSE);
        
        
        

        // add the fields
        $this->form->addQuickField('Id', $id,  50 );
        $this->form->addQuickField('Data Inscricao', $data_inscricao,  100 );
        $this->form->addQuickFields('Nome', array($cadPessoas_id, $nome));
        $this->form->addQuickField('Turma', $turmas_id, 200 );
        
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
        $container->style = 'width: 60%';
        //$container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
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
            
            $object = new Matriculas;  // create an empty object
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
                $object = new Matriculas($key); // instantiates the Active Record
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
