<?php
/**
 * MatriculasForm Registration
 * @author  <your name here>
 */
class MatriculasForm extends TPage
{
    protected $form; // form
    
    use Adianti\Base\AdiantiStandardFormTrait; // Standard form methods
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('sistemaSine');              // defines the database
        $this->setActiveRecord('Matriculas');     // defines the active record
        
        // creates the form
        $this->form = new TQuickForm('form_Matriculas');
        $this->form->class = 'tform'; // change CSS class
        
        $this->form->style = 'display: table;width:100%'; // change style
        
        // define the form title
        $this->form->setFormTitle('Inscrição Cursos');
        


        // create the form fields
        $id = new THidden('id');
        $data_inscricao = new THidden('data_inscricao'); 
        $turmas_id = new TDBCombo('turmas_id', 'sistemaSine', 'Turmas', 'id', 'nome_turma');
        $cadPessoas_id = new TDBCombo('cadPessoas_id', 'sistemaSine', 'Cadpessoas', 'id', 'nome');
        $cadPessoas_cpf = new TDBCombo('cadPessoas_cpf', 'sistemaSine', 'Cadpessoas', 'id', 'cpf');
        
        
        $data_inscricao->setValue(date('Y-m-d'));


        // add the fields
        $this->form->addQuickField('', $id,  100 );
        $this->form->addQuickField('Data Inscricao', $data_inscricao,  100 );
        $this->form->addQuickField('Turma', $turmas_id,  400 );
        $this->form->addQuickField('Nome', $cadPessoas_id,  400 );
        $this->form->addQuickField('CPF', $cadPessoas_cpf,  180 );



        
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
        $this->form->addQuickAction(_t('New'),  new TAction(array($this, 'onEdit')), 'bs:plus-sign green');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 30%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }
}
