<?php
/**
 * CursosFormInscricao Master/Detail
 * @author  <your name here>
 */
class CursosFormInscricao extends TPage
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
        $this->form = new TForm('form_Cursos');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'max-width:700px'; // style
        parent::include_css('app/resources/custom-frame.css');
        
        $table_master = new TTable;
        $table_master->width = '100%';
        
        $table_master->addRowSet( new TLabel('Cursos'), '', '')->class = 'tformtitle';
        
        // add a table inside form
        $table_general = new TTable;
        $table_detail  = new TTable;
        $table_general-> width = '100%';
        $table_detail-> width  = '100%';
        
        $frame_general = new TFrame;
        $frame_general->setLegend('Cursos');
        $frame_general->style = 'background:whiteSmoke';
        $frame_general->add($table_general);
        
        $table_master->addRow()->addCell( $frame_general )->colspan=2;
        $row = $table_master->addRow();
        $row->addCell( $table_detail );
        
        $this->form->add($table_master);
        
        // master fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $requisito = new TEntry('requisito');
        $carga_horaria = new TEntry('carga_horaria');
        $data_mat = new TDate('data_mat');
        $data_inicio = new TDate('data_inicio');
        $data_fim = new TDate('data_fim');
        $status = new TEntry('status');
        $agente_qualificador_idagente = new TEntry('agente_qualificador_idagente');
        
        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        // detail fields
        $detail_id = new THidden('detail_id');
        $detail_dataInscricao = new TDate('detail_dataInscricao');
        $detail_nome = new TEntry('detail_nome');
        $detail_sexo = new TEntry('detail_sexo');
        $detail_cpf = new TEntry('detail_cpf');
        $detail_data_nascimento = new TEntry('detail_data_nascimento');
        $detail_idade = new TEntry('detail_idade');
        $detail_estado_civil = new TEntry('detail_estado_civil');
        $detail_local_nasc = new TEntry('detail_local_nasc');
        $detail_rg = new TEntry('detail_rg');
        $detail_rg_orgEmissor = new TEntry('detail_rg_orgEmissor');
        $detail_rg_data = new TEntry('detail_rg_data');
        $detail_pai = new TEntry('detail_pai');
        $detail_mae = new TEntry('detail_mae');
        $detail_endereco = new TEntry('detail_endereco');
        $detail_numero = new TEntry('detail_numero');
        $detail_bairro = new TEntry('detail_bairro');
        $detail_cidade = new TEntry('detail_cidade');
        $detail_cep = new TEntry('detail_cep');
        $detail_fone = new TEntry('detail_fone');
        $detail_celular = new TEntry('detail_celular');
        $detail_email = new TEntry('detail_email');
        $detail_pcd = new TEntry('detail_pcd');
        $detail_qual_pcd = new TEntry('detail_qual_pcd');
        $detail_escolaridade = new TEntry('detail_escolaridade');
        $detail_cursos_qualificacao = new TEntry('detail_cursos_qualificacao');
        $detail_observacao = new TText('detail_observacao');

        /** samples
         $this->form->addQuickFields('Date', array($date1, new TLabel('to'), $date2)); // side by side fields
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( 100, 40 ); // set size
         **/
        
        // master
        $table_general->addRowSet( new TLabel('Id'), $id );
        $table_general->addRowSet( new TLabel('Nome'), $nome );
        $table_general->addRowSet( new TLabel('Requisito'), $requisito );
        $table_general->addRowSet( new TLabel('Carga Horaria'), $carga_horaria );
        $table_general->addRowSet( new TLabel('Data Mat'), $data_mat );
        $table_general->addRowSet( new TLabel('Data Inicio'), $data_inicio );
        $table_general->addRowSet( new TLabel('Data Fim'), $data_fim );
        $table_general->addRowSet( new TLabel('Status'), $status );
        $table_general->addRowSet( new TLabel('Agente Qualificador Idagente'), $agente_qualificador_idagente );
        
         // detail
        $frame_details = new TFrame();
        $frame_details->setLegend('Cadpessoas');
        $row = $table_detail->addRow();
        $row->addCell($frame_details);
        
        $btn_save_detail = new TButton('btn_save_detail');
        $btn_save_detail->setAction(new TAction(array($this, 'onSaveDetail')), 'Register');
        $btn_save_detail->setImage('fa:save');
        
        $table_details = new TTable;
        $frame_details->add($table_details);
        
        $table_details->addRowSet( '', $detail_id );
        $table_details->addRowSet( new TLabel('Datainscricao'), $detail_dataInscricao );
        $table_details->addRowSet( new TLabel('Nome'), $detail_nome );
        $table_details->addRowSet( new TLabel('Sexo'), $detail_sexo );
        $table_details->addRowSet( new TLabel('Cpf'), $detail_cpf );
        $table_details->addRowSet( new TLabel('Data Nascimento'), $detail_data_nascimento );
        $table_details->addRowSet( new TLabel('Idade'), $detail_idade );
        $table_details->addRowSet( new TLabel('Estado Civil'), $detail_estado_civil );
        $table_details->addRowSet( new TLabel('Local Nasc'), $detail_local_nasc );
        $table_details->addRowSet( new TLabel('Rg'), $detail_rg );
        $table_details->addRowSet( new TLabel('Rg Orgemissor'), $detail_rg_orgEmissor );
        $table_details->addRowSet( new TLabel('Rg Data'), $detail_rg_data );
        $table_details->addRowSet( new TLabel('Pai'), $detail_pai );
        $table_details->addRowSet( new TLabel('Mae'), $detail_mae );
        $table_details->addRowSet( new TLabel('Endereco'), $detail_endereco );
        $table_details->addRowSet( new TLabel('Numero'), $detail_numero );
        $table_details->addRowSet( new TLabel('Bairro'), $detail_bairro );
        $table_details->addRowSet( new TLabel('Cidade'), $detail_cidade );
        $table_details->addRowSet( new TLabel('Cep'), $detail_cep );
        $table_details->addRowSet( new TLabel('Fone'), $detail_fone );
        $table_details->addRowSet( new TLabel('Celular'), $detail_celular );
        $table_details->addRowSet( new TLabel('Email'), $detail_email );
        $table_details->addRowSet( new TLabel('Pcd'), $detail_pcd );
        $table_details->addRowSet( new TLabel('Qual Pcd'), $detail_qual_pcd );
        $table_details->addRowSet( new TLabel('Escolaridade'), $detail_escolaridade );
        $table_details->addRowSet( new TLabel('Cursos Qualificacao'), $detail_cursos_qualificacao );
        $table_details->addRowSet( new TLabel('Observacao'), $detail_observacao );
        
        $table_details->addRowSet( $btn_save_detail );
        
        $this->detail_list = new TQuickGrid;
        $this->detail_list->setHeight( 175 );
        $this->detail_list->makeScrollable();
        $this->detail_list->disableDefaultClick();
        $this->detail_list->addQuickColumn('', 'edit', 'left', 50);
        $this->detail_list->addQuickColumn('', 'delete', 'left', 50);
        
        // items
        $this->detail_list->addQuickColumn('Datainscricao', 'dataInscricao', 'left', 100);
        $this->detail_list->addQuickColumn('Nome', 'nome', 'left', 200);
        $this->detail_list->addQuickColumn('Sexo', 'sexo', 'left', 200);
        $this->detail_list->addQuickColumn('Cpf', 'cpf', 'left', 200);
        $this->detail_list->addQuickColumn('Data Nascimento', 'data_nascimento', 'left', 200);
        $this->detail_list->addQuickColumn('Idade', 'idade', 'left', 100);
        $this->detail_list->addQuickColumn('Estado Civil', 'estado_civil', 'left', 200);
        $this->detail_list->addQuickColumn('Local Nasc', 'local_nasc', 'left', 200);
        $this->detail_list->addQuickColumn('Rg', 'rg', 'left', 200);
        $this->detail_list->addQuickColumn('Rg Orgemissor', 'rg_orgEmissor', 'left', 200);
        $this->detail_list->addQuickColumn('Rg Data', 'rg_data', 'left', 200);
        $this->detail_list->addQuickColumn('Pai', 'pai', 'left', 200);
        $this->detail_list->addQuickColumn('Mae', 'mae', 'left', 200);
        $this->detail_list->addQuickColumn('Endereco', 'endereco', 'left', 200);
        $this->detail_list->addQuickColumn('Numero', 'numero', 'left', 100);
        $this->detail_list->addQuickColumn('Bairro', 'bairro', 'left', 200);
        $this->detail_list->addQuickColumn('Cidade', 'cidade', 'left', 200);
        $this->detail_list->addQuickColumn('Cep', 'cep', 'left', 200);
        $this->detail_list->addQuickColumn('Fone', 'fone', 'left', 200);
        $this->detail_list->addQuickColumn('Celular', 'celular', 'left', 200);
        $this->detail_list->addQuickColumn('Email', 'email', 'left', 200);
        $this->detail_list->addQuickColumn('Pcd', 'pcd', 'left', 200);
        $this->detail_list->addQuickColumn('Qual Pcd', 'qual_pcd', 'left', 200);
        $this->detail_list->addQuickColumn('Escolaridade', 'escolaridade', 'left', 200);
        $this->detail_list->addQuickColumn('Cursos Qualificacao', 'cursos_qualificacao', 'left', 200);
        $this->detail_list->addQuickColumn('Observacao', 'observacao', 'left', 200);
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
        $this->formFields   = array($id,$nome,$requisito,$carga_horaria,$data_mat,$data_inicio,$data_fim,$status,$agente_qualificador_idagente,$detail_dataInscricao,$detail_nome,$detail_sexo,$detail_cpf,$detail_data_nascimento,$detail_idade,$detail_estado_civil,$detail_local_nasc,$detail_rg,$detail_rg_orgEmissor,$detail_rg_data,$detail_pai,$detail_mae,$detail_endereco,$detail_numero,$detail_bairro,$detail_cidade,$detail_cep,$detail_fone,$detail_celular,$detail_email,$detail_pcd,$detail_qual_pcd,$detail_escolaridade,$detail_cursos_qualificacao,$detail_observacao);
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
            TTransaction::open('inscricao');
            $data = $this->form->getData();
            
            /** validation sample
            if (! $data->fieldX)
                throw new Exception('The field fieldX is required');
            **/
            
            $items = TSession::getValue(__CLASS__.'_items');
            $key = empty($data->detail_id) ? 'X'.mt_rand(1000000000, 1999999999) : $data->detail_id;
            
            $items[ $key ] = array();
            $items[ $key ]['id'] = $key;
            $items[ $key ]['dataInscricao'] = $data->detail_dataInscricao;
            $items[ $key ]['nome'] = $data->detail_nome;
            $items[ $key ]['sexo'] = $data->detail_sexo;
            $items[ $key ]['cpf'] = $data->detail_cpf;
            $items[ $key ]['data_nascimento'] = $data->detail_data_nascimento;
            $items[ $key ]['idade'] = $data->detail_idade;
            $items[ $key ]['estado_civil'] = $data->detail_estado_civil;
            $items[ $key ]['local_nasc'] = $data->detail_local_nasc;
            $items[ $key ]['rg'] = $data->detail_rg;
            $items[ $key ]['rg_orgEmissor'] = $data->detail_rg_orgEmissor;
            $items[ $key ]['rg_data'] = $data->detail_rg_data;
            $items[ $key ]['pai'] = $data->detail_pai;
            $items[ $key ]['mae'] = $data->detail_mae;
            $items[ $key ]['endereco'] = $data->detail_endereco;
            $items[ $key ]['numero'] = $data->detail_numero;
            $items[ $key ]['bairro'] = $data->detail_bairro;
            $items[ $key ]['cidade'] = $data->detail_cidade;
            $items[ $key ]['cep'] = $data->detail_cep;
            $items[ $key ]['fone'] = $data->detail_fone;
            $items[ $key ]['celular'] = $data->detail_celular;
            $items[ $key ]['email'] = $data->detail_email;
            $items[ $key ]['pcd'] = $data->detail_pcd;
            $items[ $key ]['qual_pcd'] = $data->detail_qual_pcd;
            $items[ $key ]['escolaridade'] = $data->detail_escolaridade;
            $items[ $key ]['cursos_qualificacao'] = $data->detail_cursos_qualificacao;
            $items[ $key ]['observacao'] = $data->detail_observacao;
            
            TSession::setValue(__CLASS__.'_items', $items);
            
            // clear detail form fields
            $data->detail_id = '';
            $data->detail_dataInscricao = '';
            $data->detail_nome = '';
            $data->detail_sexo = '';
            $data->detail_cpf = '';
            $data->detail_data_nascimento = '';
            $data->detail_idade = '';
            $data->detail_estado_civil = '';
            $data->detail_local_nasc = '';
            $data->detail_rg = '';
            $data->detail_rg_orgEmissor = '';
            $data->detail_rg_data = '';
            $data->detail_pai = '';
            $data->detail_mae = '';
            $data->detail_endereco = '';
            $data->detail_numero = '';
            $data->detail_bairro = '';
            $data->detail_cidade = '';
            $data->detail_cep = '';
            $data->detail_fone = '';
            $data->detail_celular = '';
            $data->detail_email = '';
            $data->detail_pcd = '';
            $data->detail_qual_pcd = '';
            $data->detail_escolaridade = '';
            $data->detail_cursos_qualificacao = '';
            $data->detail_observacao = '';
            
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
        $data->detail_dataInscricao = $item['dataInscricao'];
        $data->detail_nome = $item['nome'];
        $data->detail_sexo = $item['sexo'];
        $data->detail_cpf = $item['cpf'];
        $data->detail_data_nascimento = $item['data_nascimento'];
        $data->detail_idade = $item['idade'];
        $data->detail_estado_civil = $item['estado_civil'];
        $data->detail_local_nasc = $item['local_nasc'];
        $data->detail_rg = $item['rg'];
        $data->detail_rg_orgEmissor = $item['rg_orgEmissor'];
        $data->detail_rg_data = $item['rg_data'];
        $data->detail_pai = $item['pai'];
        $data->detail_mae = $item['mae'];
        $data->detail_endereco = $item['endereco'];
        $data->detail_numero = $item['numero'];
        $data->detail_bairro = $item['bairro'];
        $data->detail_cidade = $item['cidade'];
        $data->detail_cep = $item['cep'];
        $data->detail_fone = $item['fone'];
        $data->detail_celular = $item['celular'];
        $data->detail_email = $item['email'];
        $data->detail_pcd = $item['pcd'];
        $data->detail_qual_pcd = $item['qual_pcd'];
        $data->detail_escolaridade = $item['escolaridade'];
        $data->detail_cursos_qualificacao = $item['cursos_qualificacao'];
        $data->detail_observacao = $item['observacao'];
        
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
            $data->detail_dataInscricao = '';
            $data->detail_nome = '';
            $data->detail_sexo = '';
            $data->detail_cpf = '';
            $data->detail_data_nascimento = '';
            $data->detail_idade = '';
            $data->detail_estado_civil = '';
            $data->detail_local_nasc = '';
            $data->detail_rg = '';
            $data->detail_rg_orgEmissor = '';
            $data->detail_rg_data = '';
            $data->detail_pai = '';
            $data->detail_mae = '';
            $data->detail_endereco = '';
            $data->detail_numero = '';
            $data->detail_bairro = '';
            $data->detail_cidade = '';
            $data->detail_cep = '';
            $data->detail_fone = '';
            $data->detail_celular = '';
            $data->detail_email = '';
            $data->detail_pcd = '';
            $data->detail_qual_pcd = '';
            $data->detail_escolaridade = '';
            $data->detail_cursos_qualificacao = '';
            $data->detail_observacao = '';
        
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
                $item->dataInscricao = $list_item['dataInscricao'];
                $item->nome = $list_item['nome'];
                $item->sexo = $list_item['sexo'];
                $item->cpf = $list_item['cpf'];
                $item->data_nascimento = $list_item['data_nascimento'];
                $item->idade = $list_item['idade'];
                $item->estado_civil = $list_item['estado_civil'];
                $item->local_nasc = $list_item['local_nasc'];
                $item->rg = $list_item['rg'];
                $item->rg_orgEmissor = $list_item['rg_orgEmissor'];
                $item->rg_data = $list_item['rg_data'];
                $item->pai = $list_item['pai'];
                $item->mae = $list_item['mae'];
                $item->endereco = $list_item['endereco'];
                $item->numero = $list_item['numero'];
                $item->bairro = $list_item['bairro'];
                $item->cidade = $list_item['cidade'];
                $item->cep = $list_item['cep'];
                $item->fone = $list_item['fone'];
                $item->celular = $list_item['celular'];
                $item->email = $list_item['email'];
                $item->pcd = $list_item['pcd'];
                $item->qual_pcd = $list_item['qual_pcd'];
                $item->escolaridade = $list_item['escolaridade'];
                $item->cursos_qualificacao = $list_item['cursos_qualificacao'];
                $item->observacao = $list_item['observacao'];
                
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
            TTransaction::open('inscricao');
            
            if (isset($param['key']))
            {
                $key = $param['key'];
                
                $object = new Cursos($key);
                $items  = Cadpessoas::where('id', '=', $key)->load();
                
                $session_items = array();
                foreach( $items as $item )
                {
                    $item_key = $item->id;
                    $session_items[$item_key] = $item->toArray();
                    $session_items[$item_key]['id'] = $item->id;
                    $session_items[$item_key]['dataInscricao'] = $item->dataInscricao;
                    $session_items[$item_key]['nome'] = $item->nome;
                    $session_items[$item_key]['sexo'] = $item->sexo;
                    $session_items[$item_key]['cpf'] = $item->cpf;
                    $session_items[$item_key]['data_nascimento'] = $item->data_nascimento;
                    $session_items[$item_key]['idade'] = $item->idade;
                    $session_items[$item_key]['estado_civil'] = $item->estado_civil;
                    $session_items[$item_key]['local_nasc'] = $item->local_nasc;
                    $session_items[$item_key]['rg'] = $item->rg;
                    $session_items[$item_key]['rg_orgEmissor'] = $item->rg_orgEmissor;
                    $session_items[$item_key]['rg_data'] = $item->rg_data;
                    $session_items[$item_key]['pai'] = $item->pai;
                    $session_items[$item_key]['mae'] = $item->mae;
                    $session_items[$item_key]['endereco'] = $item->endereco;
                    $session_items[$item_key]['numero'] = $item->numero;
                    $session_items[$item_key]['bairro'] = $item->bairro;
                    $session_items[$item_key]['cidade'] = $item->cidade;
                    $session_items[$item_key]['cep'] = $item->cep;
                    $session_items[$item_key]['fone'] = $item->fone;
                    $session_items[$item_key]['celular'] = $item->celular;
                    $session_items[$item_key]['email'] = $item->email;
                    $session_items[$item_key]['pcd'] = $item->pcd;
                    $session_items[$item_key]['qual_pcd'] = $item->qual_pcd;
                    $session_items[$item_key]['escolaridade'] = $item->escolaridade;
                    $session_items[$item_key]['cursos_qualificacao'] = $item->cursos_qualificacao;
                    $session_items[$item_key]['observacao'] = $item->observacao;
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
            TTransaction::open('inscricao');
            
            $data = $this->form->getData();
            $master = new Cursos;
            $master->fromArray( (array) $data);
            $this->form->validate(); // form validation
            
            $master->store(); // save master object
            // delete details
            $old_items = Cadpessoas::where('id', '=', $master->id)->load();
            
            $keep_items = array();
            
            // get session items
            $items = TSession::getValue(__CLASS__.'_items');
            
            if( $items )
            {
                foreach( $items as $item )
                {
                    if (substr($item['id'],0,1) == 'X' ) // new record
                    {
                        $detail = new Cadpessoas;
                    }
                    else
                    {
                        $detail = Cadpessoas::find($item['id']);
                    }
                    $detail->dataInscricao  = $item['dataInscricao'];
                    $detail->nome  = $item['nome'];
                    $detail->sexo  = $item['sexo'];
                    $detail->cpf  = $item['cpf'];
                    $detail->data_nascimento  = $item['data_nascimento'];
                    $detail->idade  = $item['idade'];
                    $detail->estado_civil  = $item['estado_civil'];
                    $detail->local_nasc  = $item['local_nasc'];
                    $detail->rg  = $item['rg'];
                    $detail->rg_orgEmissor  = $item['rg_orgEmissor'];
                    $detail->rg_data  = $item['rg_data'];
                    $detail->pai  = $item['pai'];
                    $detail->mae  = $item['mae'];
                    $detail->endereco  = $item['endereco'];
                    $detail->numero  = $item['numero'];
                    $detail->bairro  = $item['bairro'];
                    $detail->cidade  = $item['cidade'];
                    $detail->cep  = $item['cep'];
                    $detail->fone  = $item['fone'];
                    $detail->celular  = $item['celular'];
                    $detail->email  = $item['email'];
                    $detail->pcd  = $item['pcd'];
                    $detail->qual_pcd  = $item['qual_pcd'];
                    $detail->escolaridade  = $item['escolaridade'];
                    $detail->cursos_qualificacao  = $item['cursos_qualificacao'];
                    $detail->observacao  = $item['observacao'];
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
