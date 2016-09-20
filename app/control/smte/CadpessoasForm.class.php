<?php
/**
 * CadpessoasForm Registration
 * @author  <your name here>
 */
class CadpessoasForm extends TPage
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
        $this->setActiveRecord('Cadpessoas');     // defines the active record
        
        // creates the form
        $this->form = new TQuickForm('form_Cadpessoas');
        $this->form->class = 'tform'; // change CSS class
        
        $this->form->style = 'display: table;width:100%'; // change style
        
        
        // define the form title
        $this->form->setFormTitle('Cadastro');
        


        // create the form fields
        $id = new THidden('id');
        $dataInscricao = new THidden('dataInscricao');
        $nome = new TEntry('nome');
        $sexo = new TCombo('sexo');
        $cpf = new TEntry('cpf');
        $data_nascimento = new TDate('data_nascimento');
        $idade = new TEntry('idade');
        $estado_civil = new TCombo('estado_civil');
        $local_nasc = new TEntry('local_nasc');
        $rg = new TEntry('rg');
        $rg_orgEmissor = new TEntry('rg_orgEmissor');
        $rg_data = new TDate('rg_data');
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
        $pcd = new TRadioGroup('pcd');
        $qual_pcd = new TEntry('qual_pcd');
        $escolaridade = new TCombo('escolaridade');
        $cursos_qualificacao = new TEntry('cursos_qualificacao');
        $observacao = new TText('observacao');
        
        //define caracteristicas dos campos
        $id->setSize(40);
        $id->setEditable(FALSE);
        $dataInscricao->setSize(100);
        $dataInscricao->setValue(date('Y-m-d'));
        $nome->setSize(400);
        $sexo->setSize(200);
        $local_nasc->setSize(400);
        $data_nascimento->setSize(90);
        $cpf->setSize(140);
        $estado_civil->setSize(130);
        $rg->setSize(140);
        $rg_orgEmissor->setSize(120);
        $rg_data->setSize(125);
        $endereco->setSize(530);
        $numero->setSize(80);
        $bairro->setSize(280);
        $cidade->setSize(305);
        $fone->setSize(120);
        $fone->setMask('(xx)xxxx-xxxx');
        $celular->setSize(120);
        $celular->setMask('(xx)xxxx-xxxx');
        $email->addValidation('email', new TEmailValidator);
        
        
        
        
        //combo campo sexo
        $combo_sexo = array();
        $combo_sexo['M'] ='Masculino';
        $combo_sexo['F'] ='Feminino';
        $sexo->addItems($combo_sexo);

        //combo estado civil
        $combo_civil = array();
        $combo_civil['Solteiro'] ='Solteiro(a)';
        $combo_civil['Casado'] ='Casado(a)';
        $combo_civil['Separado'] ='Separado(a)';
        $combo_civil['Viuvo'] ='Viúvo(a)';
        $combo_civil['Outros'] ='Outro';
        $estado_civil->addItems($combo_civil);
        
        //combo escolaridade
        $combo_escolaridade = array();
        $combo_escolaridade['Primeiro Grau Incompleto'] ='Primeiro Grau Incompleto';
        $combo_escolaridade['Primeiro Grau Completo'] ='Primeiro Grau Completo';
        $combo_escolaridade['Segundo Grau Incompleto'] ='Segundo Grau Incompleto';
        $combo_escolaridade['Segundo Grau Completo'] ='Segundo Grau Completo';
        $combo_escolaridade['Superior Incompleto'] ='Superior Incompleto';
        $combo_escolaridade['Superior Completo'] ='Superior Completo';
        $combo_escolaridade[' Especialização'] =' Especialização';
        $combo_escolaridade[' Mestrado'] =' Mestrado';
        $combo_escolaridade['Doutorado'] ='Doutorado';
        $escolaridade->addItems($combo_escolaridade);
        
        //RadioGroup campo pcd
        $pcd->setLayout('horizontal');
        $items = array();
        $items['Sim'] ='Sim';
        $items['Nao'] ='Não';
        $pcd->addItems($items);
        $pcd->setValue('Nao');




        // add the fields
        $this->form->addQuickFields('',  array($id, new TLabel(''), $dataInscricao));
        $this->form->addQuickFields('Nome:', array($nome, new TLabel('Sexo:'), $sexo));
        $this->form->addQuickFields('Local de Nascimento:', array($local_nasc, new TLabel('Data de Nascimento:'), $data_nascimento));
        $this->form->addQuickFields('CPF:', array($cpf, new TLabel('Estado Civil:'), $estado_civil) );
        $this->form->addQuickFields('RG:', array($rg, new TLabel('Orgão Emissor:'), $rg_orgEmissor, new TLabel ('Data de Expedição:'), $rg_data) );
        $this->form->addQuickField('Pai:', $pai, 400);
        $this->form->addQuickField('Mãe:', $mae, 400);
        $this->form->addQuickField('Cep:', $cep,  100 );
        $this->form->addQuickFields('Endereco:', array($endereco, new TLabel('Nº:'), $numero) );
        $this->form->addQuickFields('Bairro:', array($bairro, new TLabel('Cidade:'), $cidade) );
        $this->form->addQuickFields('Telefone:', array($fone, new TLabel('Celular:'), $celular) );
        $this->form->addQuickField('Email:', $email,  400 );
        $this->form->addQuickField('Portador de Necessidades Especiais ?', $pcd,  200 );
        $this->form->addQuickField('Qual necessidades Especiais:', $qual_pcd,  500 );
        $this->form->addQuickField('Escolaridade:', $escolaridade, 300 );
        $this->form->addQuickField('Observação:', $observacao, 180);



        
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
        $this->form->addQuickAction('Voltar',  new TAction(array('CadpessoasFormListView', 'onReload')), 'ico_back.png');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }
}
