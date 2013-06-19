<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ZURB Foundation 3.2 Plugin
 *
 * A plugin to use Foundation components in PyroCMS via Lex Tags
 *
 * @author		Marco Grüter
 * @package		PyroCMS\Addon\Plugins
 *
 */

class Plugin_Pyfo extends Plugin {

	public $version = '0.4';

	public $name = array(
		'en'	=> 'Pyfo',
	);

	public $description = array(
		'en'	=> 'Use Foundation components in PyroCMS via Lex tags'
	);

	private $reveal_modals = array();

	public function _self_doc()
	{
		$info = array(
			'button' => array(
				'description' => array(// a single sentence to explain the purpose of this method
					'en' => 'A button.'
				),
				'single' => false,// will it work as a single tag?
				'double' => true,// how about as a double tag?
				'variables' => '',// list all variables available inside the double tag. Separate them|like|this
				'attributes' => array(
					'element' => array(// this is the name="World" attribute
						'type' => 'text',// Can be: slug, number, flag, text, array, any.
						'flags' => '',// flags are predefined values like asc|desc|random.
						'default' => 'submit',// this attribute defaults to this if no value is given
						'required' => true,// is this attribute required?
					),
					'label' => array(
						'type' => 'text',
						'default' => 'Submit',
						'required' => true
					),
					'size' => array(
						'type' => 'text',
						'default' => 'medium',
						'required' => false
					),
					'type' => array(
						'type' => 'text',
						'default' => 'normal',
						'required' => false
					),
					'style' => array(
						'type' => 'text',
						'default' => 'square',
						'required' => false
					),
					'name' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					),
					'href' => array(
						'type' => 'text',
						'default' => '',
						'required' => false,
					),
					'title' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					),
					'target' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					),
					'add_class' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					)
				),
			),
		);

		return $info;
	}

	public function button()
	{
		$element = $this->attribute('element', 'submit');
		$size = $this->attribute('size', 'medium');
		$type = $this->attribute('type', '');
		$style = $this->attribute('style', '');
		$name = $this->attribute('name', '');
		$add_class = $this->attribute('add_class', '');
		$title = $this->attribute('title', '');
		$href = $this->attribute('href', '');
		$target = $this->attribute('target', '');

		$label = strip_tags($this->content());

		$classes = $this->_build_classes('button', $size, $style, $type, $add_class);

		if($element == 'submit')
		{
			return form_submit($name, $label, 'class="' . $classes . '"');
		}
		else if($element == 'button')
		{
			return form_button($name, $label, 'class="' . $classes . '"');
		}
		else if($element == 'anchor' && $href != '' && $label != '')
		{
			return '<a href="' . $href . '" title="' . $title . '" class="' . $classes . '" target="' . $target . '">' . $label . '</a>';
		}

	}

	public function dropdown_buttons()
	{
		$size = $this->attribute('size', 'medium');
		$label = $this->attribute('label', 'Dropdown Button');
		$type = $this->attribute('type', '');
		$style = $this->attribute('style', '');
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_classes('button', 'dropdown', $size, $style, $type, $add_class);

		$html = '<div class="' . $classes . '">' . $label . '<ul>' . $this->_build_dropdown_button_list() . '</ul></div>';

		return $html;
	}

	public function split_button()
	{
		$href = $this->attribute('href', '');
		$size = $this->attribute('size', 'medium');
		$label = $this->attribute('label', 'Dropdown Button');
		$type = $this->attribute('type', '');
		$style = $this->attribute('style', '');
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_classes('button', 'split', $size, $style, $type, $add_class);

		$html = '<div class="' . $classes . ' dropdown"><a href="' . $href . '">' . $label . '</a><span></span><ul>' . $this->_build_dropdown_button_list() . '</ul></div>';

		return $html;
	}


	public function alert()
	{
		$type = $this->attribute('type', '');
		return '<div class="alert-box ' . $type . '">' . $this->content() . '</div>';
	}

	public function label()
	{
		$type = $this->attribute('type', '');
		$style = $this->attribute('style', '');
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_classes('label', $style, $type, $add_class);

		return '<span class="' . $classes . '">' . $this->content() . '</span>';
	}

	public function panel()
	{
		$type = $this->attribute('type', '');
		$style = $this->attribute('style', '');
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_classes('panel', $style, $type, $add_class);

		return '<div class="' . $classes . '">' . $this->content() . '</div>';
	}

	public function orbit() {

		$slug = $this->attribute('slug', false);

		if( ! $slug ) return;

		$this->load->model('files/file_folders_m');
		$this->load->model('files/file_m');

		$folder = $this->file_folders_m->get_by('slug', $slug);
		$files = $this->file_m->get_many_by('folder_id', $folder->id);

		$html = '<div class="orbit-carousel">';

		foreach($files as $file)
		{
			$html .= '<img src="' . $file->path . '" alt="' . $file->description . '" />';
		}

		$html .= '</div>';

		return $html;
	}


	public function row()
	{
		$html = '<div class="row">';
		$html .= strip_tags($this->content());
		$html .= '</div>';

		return $html;
	}

	public function columns()
	{

		$width = $this->attribute('width', 'twelve');

		$offset = $this->attribute('offset', '');
		$centered = $this->attribute('centered', '');
		$mobile = $this->attribute('mobile', '');

		$add_class = $this->attribute('add_class', '');

		if($offset != '') $offset = 'offset-by-' . $offset;
		if($centered != '') $centered = 'centered';
		if($mobile != '') $mobile = 'mobile-' . $mobile;

		$classes = $this->_build_classes('columns', $width, $offset, $centered, $mobile, $add_class);

		$html = '<div class="' . $classes . '">';
		$html .= $this->content();
		$html .= '</div>';

		return $html;
	}

	public function clearing()
	{
		$slug = $this->attribute('slug', false);
		$per_row = $this->attribute('per_row', 'three');

		if( ! $slug ) return;

		$this->load->model('files/file_folders_m');
		$this->load->model('files/file_m');

		$folder = $this->file_folders_m->get_by('slug', $slug);
		$files = $this->file_m->get_many_by('folder_id', $folder->id);

		$html = '<ul class="block-grid ' . $per_row . '-up" data-clearing>';

		foreach($files as $file)
		{
			$html .= '<li><img data-caption="' . $file->description . '" src="' . $file->path . '" alt="' . $file->description . '" /></li>';
		}

		$html .= '</ul>';

		return $html;
	}

	public function reveal()
	{
		$label = $this->attribute('label', 'Reveal Me');
		$size = $this->attribute('size', 'expand');
		$close = $this->attribute('close', '&#215;');

		$modals = $this->load->get_var('reveal-modals');
		if( ! $modals or ! is_array($modals)) $modals = array();

		$modal_index = count($modals) + 1;

		$modals[] = '<div id="pyfo-reveal-modal-' . $modal_index . '" class="reveal-modal ' . $size . '">' . $this->content() . '<a class="close-reveal-modal">' . $close . '</a></div>';

		$this->load->vars('reveal-modals', $modals);

		return '<a href="#" class="button" data-reveal-id="pyfo-reveal-modal-' . $modal_index . '">' . $label . '</a>';
	}

	public function render_modals()
	{
		$html = '';

		$modals = $this->load->get_var('reveal-modals');

		if(count($modals) < 1)
		{
			return;
		}

		foreach($modals as $modal)
		{
			$html .= $modal;
		}

		return $html;
	}

	/**
	 * 	example tabs
	 *  {{ pyfo:tabs }}
	 *	 	{{ tab name="thename" label="the label" }}This is tab content for tab1{{ /tab }}
 	 *		{{ tab name="thename2" label="the label 2" }}This is tab content for tab 2{{ /tab }}
	 *	{{ /pyfo:tabs }}
	*/
		
	public function tabs()
	{
		$content = html_entity_decode($this->content()); // fuck you wysiwyg;

		$tabs = '';
		$tabs_content = '';

		if(preg_match_all('@\{\{ tab(.[^\}]+)\}\}(.[^(\{\{)]+)\{\{ \/tab \}\}@', $content, $tab_tags, PREG_SET_ORDER))
		{
			foreach($tab_tags as $tab)
			{
				//get the attributes... in a crazy way ^^
				//should maybe change that later to something more sensible
				$attrs = json_decode('{' . substr(preg_replace('@(\s+)?(.[^=]+)="(.[^"]+)"@', '"$2":"$3",', $tab[1]), 0, -2) . '}');

				// the tabs
				$tabs .= '<dd><a href="#' . $attrs->name . '">' . $attrs->label . '</a></dd>';

				// the tab content
				// trim brs from the content start, those are probably just leftovers from the wysiwyg
				$content = preg_replace('@<br(\s\/)?>$@', '', preg_replace('@^<br(\s\/)?>@', '', $tab[2]));
				$tabs_content .= '<li id="' . $attrs->name . 'Tab">' . $content . '</li>';
			}

		}

		return '<dl class="tabs">' . $tabs . '</dl><ul class="tabs-content">' . $tabs_content . '</ul>';
	}


	/*---------------------------------------------------------------------------------------------------------------*/

	/*
	* internal plugin utility functions
	*/

	private function _build_dropdown_button_list()
	{
		$html = '';

		$buttons = explode('|', strip_tags($this->content(), 'br'));

		foreach($buttons as $button)
		{
			if($button == 'divider')
			{
				$html .= '<li class="divider"></li>';
			}
			else if(strpos($button, '=') !== FALSE)
			{
				list($label, $href) = explode('=', $button);
				$html .= '<li>' . '<a href="' . $href . '">' . $label . '</a></li>';
			}
		}

		return $html;
	}

	private function _build_classes()
	{
		$classes = func_get_args ();
		return trim(str_replace('  ', '', implode(' ', $classes)));
	}

}