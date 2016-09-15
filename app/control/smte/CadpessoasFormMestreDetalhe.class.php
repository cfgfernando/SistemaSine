<?php
/**
 * CadpessoasFormMestreDetalhe Master/Detail
 * @author  <your name here>
 */
class CadpessoasFormMestreDetalhe extends TPage
{
    protected $form; // form
    protected $formFields;
    protected $detail_list;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TForm('form_Cadpessoas');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'max-width:700px'; // style
        parent::include_css('app/resources/custom-frame.css');
        
        $table_master = new TTable;
        $table_master->width = '100%';
        
        $table_master->addRowSet( new TLabel('Cadpessoas'), '', '')->class = 'tformtitle';
        
        // add a table inside form
        $table_general = new TTable;
        $table_detail  = new TTable;
        $table_general-> width = '100%';
        $table_detail-> width  = '100%';
        
        $frame_general = new TFrame;
        $frame_general->setLegend('Cadpessoas');
        $frame_general->style = 'background:whiteSmoke';
        $frame_general->add($table_general);
        
        $table_master->addRow()->addCell( $frame_general )->colspan=2;
        $row = $table_master->addRow();
        $row->addCell( $table_detail );
        
        $this->form->add($table_master);
        
        // master fields
        $id = new TEntry('id');
        $dataInscricao = new TDate('dataInscricao');
        $nome = new TEntry('nome');
        $sexo = new TEntry('sexo');
        $cpf = new TEntry('cpf');
        $data_nascimento = new TEntry('data_nascimento');
        $idade = new TEntry('idade');
        $estado_civil = new TEntry('estado_civil');
        $local_nasc = new TEntry('local_nasc');
        $rg = new TEntry('rg');
        $rg_orgEmissor = new TEntry('rg_orgEmissor');
        $rg_data = new TEntry('rg_data');
        $pai = new TEntry('pai');
        $mae = new TEntry('mae');
        $endereco = new TEntry('endereco');
        $numero = new TEntry('numero');
        $bairro = new TEntry('bairro');
        $cidade = new TEntry('cidade');
        $cep = new TEntry('cep');
        $fone = new TEntry('fone');
        $celular = new TEntry('celular');
        $email = new TEntry('email');
        $pcd = new TEntry('pcd');
        $qual_pcd = new TEntry('qual_pcd');
        $escolaridade = new TEntry('escolaridade');
        $cursos_qualificacao = new TEntry('cursos_qualificacao');
        $observacao = new TText('observacao');
        
        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        // detail fields
        $detail_id = new THidden('detail_id');
        $detail_turmas_id = new TEntry('detail_turmas_id');
        $detail_data_inscricao = new TDate('detail_data_inscricao');
        $detail_status = new TEntry('detail_status');
        $detail_cadPessoas_id = new TEntry('detail_cadPessoas_id');

        /** samples
         $this->form->addQuickFields('Date', array($date1, new TLabel('to'), $date2)); // side by side fields
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( 100, 40 ); // set size
         **/
        
        // master
        $table_general->addRowSet( new TLabel('',  array($id, new TLabel(''), $dataInscricao));
        $table_general->addRowSet( new TLabel('Datainscricao'), $dataInscricao );
        $table_general->addRowSet( new TLabel('Nome'), $nome );
        $table_general->addRowSet( new TLabel('Sexo'), $sexo );
        $table_general->addRowSet( new TLabel('Cpf'), $cpf );
        $table_general->addRowSet( new TLabel('Data Nascimento'), $data_nascimento );
        $table_general->addRowSet( new TLabel('Idade'), $idade );
        $table_general->addRowSet( new TLabel('Estado Civil'), $estado_civil );
        $table_general->addRowSet( new TLabel('Local Nasc'), $local_nasc );
        $table_general->addRowSet( new TLabel('Rg'), $rg );
        $table_general->addRowSet( new TLabel('Rg Orgemissor'), $rg_orgEmissor );
        $table_general->addRowSet( new TLabel('Rg Data'), $rg_data );
        $table_general->addRowSet( new TLabel('Pai'), $pai );
        $table_general->addRowSet( new TLabel('Mae'), $mae );
        $table_general->addRowSet( new TLabel('Endereco'), $endereco );
        $table_general->addRowSet( new TLabel('Numero'), $numero );
        $table_general->addRowSet( new TLabel('Bairro'), $bairro );
        $table_general->addRowSet( new TLabel('Cidade'), $cidade );
        $table_general->addRowSet( new TLabel('Cep'), $cep );
        $table_general->addRowSet( new TLabel('Fone'), $fone );
        $table_general->addRowSet( new TLabel('Celular'), $celular );
        $table_general->addRowSet( new TLabel('Email'), $email );
        $table_general->addRowSet( new TLabel('Pcd'), $pcd );
        $table_general->addRowSet( new TLabel('Qual Pcd'), $qual_pcd );
        $table_general->addRowSet( new TLabel('Escolaridade'), $escolaridade );
        $table_general->addRowSet( new TLabel('Cursos Qualificacao'), $cursos_qualificacao );
        $table_general->addRowSet( new TLabel('Observacao'), $observacao );
        
         // detail
        $frame_details = new TFrame();
        $frame_details->setLegend('Matriculas');
        $row = $table_detail->addRow();
        $row->addCell($frame_details);
        
        $btn_save_detail = new TButton('btn_save_detail');
        $btn_save_detail->setAction(new TAction(array($this, 'onSaveDetail')), 'Register');
        $btn_save_detail->setImage('fa:save');
        
        $table_details = new TTable;
        $frame_details->add($table_details);
        
        $table_details->addRowSet( '', $detail_id );
        $table_details->addRowSet( new TLabel('Turmas Id'), $detail_turmas_id );
        $table_details->addRowSet( new TLabel('Data Inscricao'), $detail_data_inscricao );
        $table_details->addRowSet( new TLabel('Status'), $detail_status );
        $table_details->addRowSet( new TLabel('Cadpessoas Id'), $detail_cadPessoas_id );
        
        $table_details->addRowSet( $btn_save_detail );
        
        $this->detail_list = new TQuickGrid;
        $this->detail_list->setHeight( 175 );
        $this->detail_list->makeScrollable();
        $this->detail_list->disableDefaultClick();
        $this->detail_list->addQuickColumn('', 'edit', 'left', 50);
        $this->detail_list->addQuickColumn('', 'delete', 'left', 50);
        
        // items
        $this->detail_list->addQuickColumn('Turmas Id', 'turmas_id', 'left', 100);
        $this->detail_list->addQuickColumn('Data Inscricao', 'data_inscricao', 'left', 100);
        $this->detail_list->addQuickColumn('Status', 'status', 'left', 200);
        $this->detail_list->addQuickColumn('Cadpessoas Id', 'cadPessoas_id', 'left', 100);
        $this->detail_list->createModel();
        
        $row = $table_detail->addRow();
        $row->addCell($this->detail_list);
        
        // create an action button (save)
        $save_button=new TButton('save');
        $save_button->setAction(new TAction(array($this, 'onSave')), _t('Save'));
        $save_button->setImage('ico_save.png');

        // create an new button (edit with no parameters)
        $new_button=new TButton('new');
        $new_button->setAction(new TAction(array($this, 'onClear')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        // define form fields
        $this->formFields   = array($id,$dataInscricao,$nome,$sexo,$cpf,$data_nascimento,$idade,$estado_civil,$local_nasc,$rg,$rg_orgEmissor,$rg_data,$pai,$mae,$endereco,$numero,$bairro,$cidade,$cep,$fone,$celular,$email,$pcd,$qual_pcd,$escolaridade,$cursos_qualificacao,$observacao,$detail_turmas_id,$detail_data_inscricao,$detail_status,$detail_cadPessoas_id);
        $this->formFields[] = $btn_save_detail;
        $this->formFields[] = $save_button;
        $this->formFields[] = $new_button;
        $this->formFields[] = $detail_id;
        $this->form->setFields( $this->formFields );
        
        $table_master->addRowSet( array($save_button, $new_button), '', '')->class = 'tformaction'; // CSS class
        
        // create the page container
        $container = new TVBox;
        $container->style = 'width: 90%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        parent::add($container);
    }
    
    
    /**
     * Clear form
     * @param $param URL parameters
     */
    public function onClear($param)
    {
        $this->form->clear();
        TSession::setValue(__CLASS__.'_items', array());
        $this->onReload( $param );
    }
    
    /**
     * Save an item from form to session list
     * @param $param URL parameters
     */
    public function onSaveDetail( $param )
    {
        try
        {
            TTransaction::open('sistemaSine');
            $data = $this->form->getData();
            
            /** validation sample
            if (! $data->fieldX)
                throw new Exception('The field fieldX is required');
            **/
            
            $items = TSession::getValue(__CLASS__.'_items');
            $key = empty($data->detail_id) ? 'X'.mt_rand(1000000000, 1999999999) : $data->detail_id;
            
            $items[ $key ] = array();
            $items[ $key ]['id'] = $key;
            $items[ $key ]['turmas_id'] = $data->detail_turmas_id;
            $items[ $key ]['data_inscricao'] = $data->detail_data_inscricao;
            $items[ $key ]['status'] = $data->detail_status;
            $items[ $key ]['cadPessoas_id'] = $data->detail_cadPessoas_id;
            
            TSession::setValue(__CLASS__.'_items', $items);
            
            // clear detail form fields
            $data->detail_id = '';
            $data->detail_turmas_id = '';
            $data->detail_data_inscricao = '';
            $data->detail_status = '';
            $data->detail_cadPessoas_id = '';
            
            TTransaction::close();
            $this->form->setData($data);
            
            $this->onReload( $param ); // reload the items
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }
    
    /**
     * Load an item from session list to detail form
     * @param $param URL parameters
     */
    public function onEditDetail( $param )
    {
        $data = $this->form->getData();
        
        // read session items
        $items = TSession::getValue(__CLASS__.'_items');
        
        // get the session item
        $item = $items[ $param['item_key'] ];
        
        $data->detail_id = $item['id'];
        $data->detail_turmas_id = $item['turmas_id'];
        $data->detail_data_inscricao = $item['data_inscricao'];
        $data->detail_status = $item['status'];
        $data->detail_cadPessoas_id = $item['cadPessoas_id'];
        
        // fill detail fields
        $this->form->setData( $data );
    
        $this->onReload( $param );
    }
    
    /**
     * Delete an item from session list
     * @param $param URL parameters
     */
    public function onDeleteDetail( $param )
    {
        $data = $this->form->getData();
        
        // reset items
            $data->detail_turmas_id = '';
            $data->detail_data_inscricao = '';
            $data->detail_status = '';
            $data->detail_cadPessoas_id = '';
        
        // clear form data
        $this->form->setData( $data );
        
        // read session items
        $items = TSession::getValue(__CLASS__.'_items');
        
        // delete the item from session
        unset($items[ $param['item_key'] ] );
        TSession::setValue(__CLASS__.'_items', $items);
        
        // reload items
        $this->onReload( $param );
    }
    
    /**
     * Load the items list from session
     * @param $param URL parameters
     */
    public function onReload($param)
    {
        // read session items
        $items = TSession::getValue(__CLASS__.'_items');
        
        $this->detail_list->clear(); // clear detail list
        $data = $this->form->getData();
        
        if ($items)
        {
            $cont = 1;
            foreach ($items as $list_item_key => $list_item)
            {
                $item_name = 'prod_' . $cont++;
                $item = new StdClass;
                
                // create action buttons
                $action_del = new TAction(array($this, 'onDeleteDetail'));
                $action_del->setParameter('item_key', $list_item_key);
                
                $action_edi = new TAction(array($this, 'onEditDetail'));
                $action_edi->setParameter('item_key', $list_item_key);
                
                $button_del = new TButton('delete_detail'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction( $action_del, '' );
                $button_del->setImage('fa:trash-o red fa-lg');
                
                $button_edi = new TButton('edit_detail'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction( $action_edi, '' );
                $button_edi->setImage('fa:edit blue fa-lg');
                
                $item->edit   = $button_edi;
                $item->delete = $button_del;
                
                $this->formFields[ $item_name.'_edit' ] = $item->edit;
                $this->formFields[ $item_name.'_delete' ] = $item->delete;
                
                // items
                $item->id = $list_item['id'];
                $item->turmas_id = $list_item['turmas_id'];
                $item->data_inscricao = $list_item['data_inscricao'];
                $item->status = $list_item['status'];
                $item->cadPessoas_id = $list_item['cadPessoas_id'];
                
                $row = $this->detail_list->addItem( $item );
                $row->onmouseover='';
                $row->onmouseout='';
            }

            $this->form->setFields( $this->formFields );
        }
        
        $this->loaded = TRUE;
    }
    
    /**
     * Load Master/Detail data from database to form/session
     */
    public function onEdit($param)
    {
        try
        {
            TTransaction::open('sistemaSine');
            
            if (isset($param['key']))
            {
                $key = $param['key'];
                
                $object = new Cadpessoas($key);
                $items  = Matriculas::where('id', '=', $key)->load();
                
                $session_items = array();
                foreach( $items as $item )
                {
                    $item_key = $item->id;
                    $session_items[$item_key] = $item->toArray();
                    $session_items[$item_key]['id'] = $item->id;
                    $session_items[$item_key]['turmas_id'] = $item->turmas_id;
                    $session_items[$item_key]['data_inscricao'] = $item->data_inscricao;
                    $session_items[$item_key]['status'] = $item->status;
                    $session_items[$item_key]['cadPessoas_id'] = $item->cadPessoas_id;
                }
                TSession::setValue(__CLASS__.'_items', $session_items);
                
                $this->form->setData($object); // fill the form with the active record data
                $this->onReload( $param ); // reload items list
                TTransaction::close(); // close transaction
            }
            else
            {
                $this->form->clear();
                TSession::setValue(__CLASS__.'_items', null);
                $this->onReload( $param );
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Save the Master/Detail data from form/session to database
     */
    public function onSave()
    {
        try
        {
            // open a transaction with database
            TTransaction::open('sistemaSine');
            
            $data = $this->form->getData();
            $master = new Cadpessoas;
            $master->fromArray( (array) $data);
            $this->form->validate(); // form validation
            
            $master->store(); // save master object
            // delete details
            $old_items = Matriculas::where('id', '=', $master->id)->load();
            
            $keep_items = array();
            
            // get session items
            $items = TSession::getValue(__CLASS__.'_items');
            
            if( $items )
            {
                foreach( $items as $item )
                {
                    if (substr($item['id'],0,1) == 'X' ) // new record
                    {
                        $detail = new Matriculas;
                    }
                    else
                    {
                        $detail = Matriculas::find($item['id']);
                    }
                    $detail->turmas_id  = $item['turmas_id'];
                    $detail->data_inscricao  = $item['data_inscricao'];
                    $detail->status  = $item['status'];
                    $detail->cadPessoas_id  = $item['cadPessoas_id'];
                    $detail->id = $master->id;
                    $detail->store();
                    
                    $keep_items[] = $detail->id;
                }
            }
            
            if ($old_items)
            {
                foreach ($old_items as $old_item)
                {
                    if (!in_array( $old_item->id, $keep_items))
                    {
                        $old_item->delete();
                    }
                }
            }
            TTransaction::close(); // close the transaction
            
            // reload form and session items
            $this->onEdit(array('key'=>$master->id));
            
            new TMessage('info', TAdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback();
        }
    }
    
    /**
     * Show the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') )
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
