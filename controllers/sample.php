<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends IIC_Controller {
		
	// ------------------------------------------------------------------------
	// Constructor
	// ------------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
		// Set variable
		$this->module_config['module'] = 'sample';
		$this->module_config['controller'] = 'sample';
		$this->module_config['form'] = $this->module_config['controller'].'_form';
		
		// Load model
		$this->load->model($this->module_config['controller'].'_model');
		$this->content_model = $this->sample_model;
		
		// Load language
		$this->lang->load(
							$this->module_config['module'], 
							$this->config->item('backoffice_language')
						 );
	}
	
	// ------------------------------------------------------------------------
	// Page
	// ------------------------------------------------------------------------
	
	/**
	 * Mian page
	 *
	 * @access	public
	 */
	
	function index()
	{		
		// Check permission
		Modules::run('backoffice/auth/check_permission');	
		
		// Set module
		$_data['module']		= $this->module_config['module'];
		$_data['controller']	= $this->module_config['controller'];
		$_data['ajax_uri']		= 'content';
		$_data['template']		= 'backoffice/tpl_module_index';
		$_data['page']			= 'sample';
		$_data['title']			= $this->lang->line('page_sample');
		
		// Set content
		$_data['content']['advance_search'] = FALSE;
		$_data['content']['readonly'] = FALSE;
		$_data['content']['total'] = $this->content_model->count_content();
		
		// Set buttons
		$_data['button']['create']['is_enable'] = FALSE;
		$_data['button']['create']['label'] = 'Custom label';
		$_data['button']['delete']['is_enable'] = FALSE;
		$_data['button']['delete']['label'] = 'Custom label';
		
		// Set navigator
		$_data['navigator'] = array();
		array_push($_data['navigator'], array(
												'label'	=> $this->lang->line('home'),	
												'link'	=> 'backoffice'
											  ));
		array_push($_data['navigator'], array(
												'label' => $this->lang->line('page_sample'),	
												'link'	=> ''
											  ));
		
		// Set table haed
		$_data['th'] = array();
		array_push($_data['th'], array(
										'axis'			=> 'name',		
										'label'			=> $this->lang->line('name'),	
										'is_criteria'	=> TRUE
									  ));
		array_push($_data['th'], array(
										'axis'			=> 'is_enable',	
										'label'			=> $this->lang->line('status'),	
										'is_criteria'	=> FALSE
									  ));
		
		// Set pagination
		$this->load->library('pagination');

		$_config['base_url']	= site_url().'/'.$_data['module'].'/'.$_data['controller'].'/index/';
		$_config['total_rows']	= $_data['content']['total'];
		$_config['per_page']	= 25; 
		$_config['uri_segment']	= 4;
		
		$this->pagination->initialize($_config); 
		
		$_data['pagination'] = $this->pagination->create_links();
		
		// Display
		$this->load->view('backoffice/main', $_data);
	}
	
	// ------------------------------------------------------------------------
	// Function
	// ------------------------------------------------------------------------
	
	/**
	 * Module page for display backoffice module
	 *
	 * @access	public
	 */
	
	function get_sample()
	{

	}
	
	// ------------------------------------------------------------------------
}


/* End of file sample.php */
/* Location: application/modules/sample/controllers/sample.php */