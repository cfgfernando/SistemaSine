<?php
/**
 * MatriculasListGridView Listing
 * @author  <your name here>
 */
class MatriculasListGridView extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $formgrid;
    private $loaded;
    private $deleteButton;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TQuickForm('form_search_Matriculas');
        $this->form->class = 'tform'; // change CSS class
        
        $this->form->style = 'display: table;width:100%'; // change style
        $this->form->setFormTitle('Matriculas');
        

        // create the form fields
        $id = new THidden('id');
        $turmas_id = new TDBCombo('turmas_id', 'sistemaSine', 'Turmas', 'id', 'nome_turma');
        $data_inscricao = new TDate('data_inscricao');
        $cadPessoas_id = new TDBCombo('cadPessoas_id', 'sistemaSine', 'Cadpessoas', 'id', 'nome');
        $cadPessoas_cpf = new TEntry('cadPessoas_cpf');


        // add the fields
        $this->form->addQuickField('Id', $id,  200 );
        $this->form->addQuickField('Nome:', $cadPessoas_id,  400 );
        $this->form->addQuickField('CPF:', $cadPessoas_cpf, 140 );
        $this->form->addQuickField('Turma:', $turmas_id,  300 );
        $this->form->addQuickField('Data de inscrição:', $data_inscricao, 120 );
        
        

        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('Matriculas_filter_data') );
        
        // add the search form actions
        $this->form->addQuickAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $this->form->addQuickAction(_t('New'),  new TAction(array('MatriculasForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        // $this->datagrid->datatable = 'true';
        // $this->datagrid->enablePopover('Popover', 'Hi <b> {name} </b>');
        

        // creates the datagrid columns
        //$column_id = new TDataGridColumn('id', 'Id', 'right');
        $column_turmas_id = new TDataGridColumn('turmas_id', 'Turmas Id', 'left', 120);
        $column_data_inscricao = new TDataGridColumn('data_inscricao', 'Data Inscricao', 'left', 40);
        $column_cadPessoas_id = new TDataGridColumn('cadpessoas_id', 'Nome', 'left', 400);
        $column_cadPessoas_cpf = new TDataGridColumn('cadPessoas_cpf', 'CPF', 'left',200);


        // add the columns to the DataGrid
        //$this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_turmas_id);
        $this->datagrid->addColumn($column_data_inscricao);
        $this->datagrid->addColumn($column_cadPessoas_id);
        $this->datagrid->addColumn($column_cadPessoas_cpf);

        
        // create EDIT action
        $action_edit = new TDataGridAction(array('MatriculasFormSeekButton', 'onEdit'));
        $action_edit->setUseButton(TRUE);
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('id');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setUseButton(TRUE);
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('id');
        $this->datagrid->addAction($action_del);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        


        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 60%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
    
    /**
     * Inline record editing
     * @param $param Array containing:
     *              key: object ID value
     *              field name: object attribute to be updated
     *              value: new attribute content 
     */
    public function onInlineEdit($param)
    {
        try
        {
            // get the parameter $key
            $field = $param['field'];
            $key   = $param['key'];
            $value = $param['value'];
            
            TTransaction::open('sistemaSine'); // open a transaction with database
            $object = new Matriculas($key); // instantiates the Active Record
            $object->{$field} = $value;
            $object->store(); // update the object in the database
            TTransaction::close(); // close the transaction
            
            $this->onReload($param); // reload the listing
            new TMessage('info', "Record Updated");
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // clear session filters
        TSession::setValue('MatriculasListGridView_filter_id',   NULL);
        TSession::setValue('MatriculasListGridView_filter_turmas_id',   NULL);
        TSession::setValue('MatriculasListGridView_filter_data_inscricao',   NULL);
        TSession::setValue('MatriculasListGridView_filter_cadPessoas_id',   NULL);
        TSession::setValue('MatriculasListGridView_filter_cadPessoas_cpf',   NULL);

        if (isset($data->id) AND ($data->id)) {
            $filter = new TFilter('id', 'like', "%{$data->id}%"); // create the filter
            TSession::setValue('MatriculasListGridView_filter_id',   $filter); // stores the filter in the session
        }


        if (isset($data->turmas_id) AND ($data->turmas_id)) {
            $filter = new TFilter('turmas_id', 'like', "%{$data->turmas_id}%"); // create the filter
            TSession::setValue('MatriculasListGridView_filter_turmas_id',   $filter); // stores the filter in the session
        }


        if (isset($data->data_inscricao) AND ($data->data_inscricao)) {
            $filter = new TFilter('data_inscricao', 'like', "%{$data->data_inscricao}%"); // create the filter
            TSession::setValue('MatriculasListGridView_filter_data_inscricao',   $filter); // stores the filter in the session
        }


        if (isset($data->cadPessoas_id) AND ($data->cadPessoas_id)) {
            $filter = new TFilter('cadPessoas_id', 'like', "%{$data->cadPessoas_id}%"); // create the filter
            TSession::setValue('MatriculasListGridView_filter_cadPessoas_id',   $filter); // stores the filter in the session
        }


        if (isset($data->cadPessoas_cpf) AND ($data->cadPessoas_cpf)) {
            $filter = new TFilter('cadPessoas_cpf', 'like', "%{$data->cadPessoas_cpf}%"); // create the filter
            TSession::setValue('MatriculasListGridView_filter_cadPessoas_cpf',   $filter); // stores the filter in the session
        }

        
        // fill the form with data again
        $this->form->setData($data);
        
        // keep the search data in the session
        TSession::setValue('Matriculas_filter_data', $data);
        
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'sistemaSine'
            TTransaction::open('sistemaSine');
            
            // creates a repository for Matriculas
            $repository = new TRepository('Matriculas');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            
            // default order
            if (empty($param['order']))
            {
                $param['order'] = 'id';
                $param['direction'] = 'asc';
            }
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);
            

            if (TSession::getValue('MatriculasListGridView_filter_id')) {
                $criteria->add(TSession::getValue('MatriculasListGridView_filter_id')); // add the session filter
            }


            if (TSession::getValue('MatriculasListGridView_filter_turmas_id')) {
                $criteria->add(TSession::getValue('MatriculasListGridView_filter_turmas_id')); // add the session filter
            }


            if (TSession::getValue('MatriculasListGridView_filter_data_inscricao')) {
                $criteria->add(TSession::getValue('MatriculasListGridView_filter_data_inscricao')); // add the session filter
            }


            if (TSession::getValue('MatriculasListGridView_filter_cadPessoas_id')) {
                $criteria->add(TSession::getValue('MatriculasListGridView_filter_cadPessoas_id')); // add the session filter
            }


            if (TSession::getValue('MatriculasListGridView_filter_cadPessoas_cpf')) {
                $criteria->add(TSession::getValue('MatriculasListGridView_filter_cadPessoas_cpf')); // add the session filter
            }

            
            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);
            
            if (is_callable($this->transformCallback))
            {
                call_user_func($this->transformCallback, $objects, $param);
            }
            
            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($object);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Ask before deletion
     */
    public function onDelete($param)
    {
        // define the delete action
        $action = new TAction(array($this, 'Delete'));
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * Delete a record
     */
    public function Delete($param)
    {
        try
        {
            $key=$param['key']; // get the parameter $key
            TTransaction::open('sistemaSine'); // open a transaction with database
            $object = new Matriculas($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            $this->onReload( $param ); // reload the listing
            new TMessage('info', AdiantiCoreTranslator::translate('Record deleted')); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    



    
    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  array('onReload', 'onSearch')))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }
}
