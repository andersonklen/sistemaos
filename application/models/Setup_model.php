<?php
class Setup_model extends CI_Model
{

   
    function __construct()
    {}


    public function createDatabaseShema()
    {
    	$this->load->dbforge();

    	$fields = array(
	        'blog_id' => array(
	                'type' => 'INT',
	                'constraint' => 5,
	                'unsigned' => TRUE,
	                'auto_increment' => TRUE
	        ),
	        'blog_title' => array(
	                'type' => 'VARCHAR',
	                'constraint' => '100',
	                'unique' => TRUE,
	        ),
	        'blog_author' => array(
	                'type' =>'VARCHAR',
	                'constraint' => '100',
	                'default' => 'King of Town',
	        ),
	        'blog_description' => array(
	                'type' => 'TEXT',
	                'null' => TRUE,
	        ),
        );

    	$this->dbforge->add_field($fields);
    	$this->dbforge->add_key('blog_id', TRUE);

    	$this->dbforge->create_table('usuarios2');
    	# $this->dbforge->create_database('tabelateste');


 	$fields = array(
	        'tb_cidade_codigo' => array(
	                'type' => 'INT',
	                'constraint' => 5,
	                'unsigned' => TRUE,
	                'auto_increment' => TRUE
	        ),
	        'tb_cidade_cidade' => array(
	                'type' => 'VARCHAR',
	                'constraint' => '100',
	                'unique' => TRUE,
	        ),	      
	        'tb_cidade_estado' => array(
	                'type' => 'VARCHAR',
	                'constraint' => '100',
	                'unique' => TRUE,
	        ),	  	        
        );

    	$this->dbforge->add_field($fields);
    	$this->dbforge->add_key('tb_cidade_id', TRUE);

    	$this->dbforge->create_table('tb_cidade');

    }
}
