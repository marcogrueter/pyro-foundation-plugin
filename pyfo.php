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

	public $version = '0.7';

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
			'row' => array(
				'description' => array(
					'en' => 'A grid row.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'pyfo:columns width="four" }} Any content here {{ /pyfo:columns|pyfo:columns width="four" }} And then other content here {{ /pyfo:columns',
				'attributes' => array(
					'collapse' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false
					),
					'add_class' => array(
						'type' => 'text',
						'flags' => '',
						'default' => ' ',
						'required' => false
					),
				)
			),
			'columns' => array(
				'description' => array(
					'en' => 'A grid row.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'Any content in here',
				'attributes' => array(
					'width' => array(
						'type' => 'text',
						'flags' => 'one|two|three|four|five|six|seven|eight|nine|ten|eleven|twelve',
						'default' => 'twelve',
						'required' => true
					),
					'offset' => array(
						'type' => 'text',
						'flags' => 'one|two|three|four|five|six|seven|eight|nine|ten|eleven',
						'default' => ' ',
						'required' => false
					),
					'centered' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false
					),
					'mobile' => array(
						'type' => 'text',
						'flags' => 'one|two|three',
						'default' => ' ',
						'required' => false
					),
					'end' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false
					),
					'add_class' => array(
						'type' => 'text',
						'flags' => '',
						'default' => ' ',
						'required' => false
					),
				)
			),
			'button' => array(
				'description' => array(
					'en' => 'A button.'
				),
				'single' => true,
				'double' => false,
				'variables' => '',
				'attributes' => array(
					'element' => array(
						'type' => 'text',
						'flags' => '',
						'default' => 'submit',
						'required' => true,
					),
					'label' => array(
						'type' => 'text',
						'default' => 'Submit',
						'required' => true
					),
					'size' => array(
						'type' => 'text',
						'flags' => 'small|medium|large',
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
			'ddbutton' => array(
				'description' => array(
					'en' => 'A button with a dropdown.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'link label="Link item 1" href="http://www.google.com" target="_new"|link label="Link item 2" href="http://www.google.com" target="_new"',
				'attributes' => array(
					'label' => array(
						'type' => 'text',
						'default' => 'Dropdwon Button',
						'required' => true
					),
					'size' => array(
						'type' => 'text',
						'flags' => 'small|medium|large',
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
			'alert' => array(
				'description' => array(
					'en' => 'Alert the user in different ways.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'This content may alert you!',
				'attributes' => array(
					'type' => array(
						'type' => 'text',
						'flags' => '[empty]|success|alert|secondary',
						'default' => ' ',
						'required' => false,
					),
					'add_class' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					)
				),
			),
			'label' => array(
				'description' => array(
					'en' => 'A label in different styles.'
				),
				'single' => true,
				'double' => false,
				'variables' => 'This content may alert you!',
				'attributes' => array(
					'label' => array(
						'type' => 'text',
						'flags' => '',
						'default' => 'Label',
						'required' => false,
					),
					'type' => array(
						'type' => 'text',
						'flags' => '[empty]|success|alert|secondary',
						'default' => ' ',
						'required' => false,
					),
					'style' => array(
						'type' => 'text',
						'flags' => '[empty]|round|square',
						'default' => ' ',
						'required' => false,
					),
					'add_class' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					)
				),
			),
			'panel' => array(
				'description' => array(
					'en' => 'A panel makes text stand out.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'This content is important, so it looks different',
				'attributes' => array(
					'callout' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false,
					),
					'radius' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false,
					),
					'add_class' => array(
						'type' => 'text',
						'default' => '',
						'required' => false
					)
				),
			),
			'orbit' => array(
				'description' => array(
					'en' => 'This generates a Orbit image slider. Remember to include the Orbit js and css scripts.'
				),
				'single' => true,
				'double' => false,
				'variables' => '',
				'attributes' => array(
					'slug' => array(
						'type' => 'slug',
						'flags' => '',
						'default' => 'no',
						'required' => true,
					)
				),
			),
			'clearing' => array(
				'description' => array(
					'en' => 'This generates a Clearing image galery. Remember to include the Clearing js and css scripts.'
				),
				'single' => true,
				'double' => false,
				'variables' => '',
				'attributes' => array(
					'slug' => array(
						'type' => 'slug',
						'flags' => '',
						'default' => 'no',
						'required' => true,
					),
					'per_row' => array(
						'type' => 'text',
						'flags' => 'one|two|three|four|five',
						'default' => 'five',
						'required' => false,
					)
				),
			),
			'reveal' => array(
				'description' => array(
					'en' => 'Generates a reveal button, which shows the tag content as a modal window/dialogT. Remember to include the Reveal js and css scripts and call pyfo:render_reveal at the end of the body tag in your layout.'
				),
				'single' => false,
				'double' => true,
				'variables' => 'This is the content for the Reveal modal.',
				'attributes' => array(
					'label' => array(
						'type' => 'text',
						'flags' => '',
						'default' => 'Reveal Me',
						'required' => true,
					),
					'size' => array(
						'type' => 'text',
						'flags' => 'expand|small|medium|large',
						'default' => 'expand',
						'required' => false,
					),
					'close' => array(
						'type' => 'text',
						'flags' => '',
						'default' => '&#215;',
						'required' => false,
					)
				),
			),
			'render_reveal' => array(
				'description' => array(
					'en' => 'Renders the reveal modal created by pyfo:reveal. Make sure to include this right before closing the body tag.'
				),
				'single' => true,
				'double' => false,
				'variables' => '',
				'attributes' => array()
			),
			'tabs' => array(
				'description' => array(
					'en' => 'Creates tabs.'
				),
				'single' => false,
				'double' => true,
				'variables' => ' tab name="thename" label="the label" }}This is tab content for tab1{{ /tab | tab name="thename2" label="the label 2" }}This is tab content for tab 2{{ /tab ',
				'attributes' => array(
					'sizing' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false,
					),
					'contained' => array(
						'type' => 'text',
						'flags' => 'yes|no',
						'default' => 'no',
						'required' => false,
					)
				),
			),
			'accordion' => array(
				'description' => array(
					'en' => 'Creates an accordion.'
				),
				'single' => false,
				'double' => true,
				'variables' => ' accordion label="the label" }}This is the accordion content{{ /accordion | accordion label="the label 2" }}This is the accordion content for the other accordion. Accordion, accordion, accordion.{{ /accordion ',
				'attributes' => array(),
			),
		);

		return $info;
	}

	/*
	*	Grid functions
	*
	*/

	public function row()
	{
		// collapse the row, means no padding between columns
		$collapse = $this->attribute('collapse', 'no');
		// additional classes for this row
		$add_class = $this->attribute('add_class', '');

		// put the classes together
		$class_attr = $this->_build_class_attr('row', $add_class, $collapse == 'yes' ? 'collapse' : '');

		// strip tags to avoid wysiwyg leftovers in columns
		return '<div'. $class_attr . '>' . $this->content() . '</div>';
	}

	public function columns()
	{
		// columns width
		$width = $this->attribute('width', 'twelve');
		// offset basically means more padding on the left of the column
		$offset = $this->attribute('offset', '');
		// center column, width must be < twelve
		$centered = $this->attribute('centered', 'no');
		// mobile grid (mobile-one, mobile-two, mobile-three, mobile-four)
		$mobile = $this->attribute('mobile', '');
		// float left for last column
		$end = $this->attribute('end', 'no');
		// additional classes
		$add_class = $this->attribute('add_class', '');

		// put offset and mobile classes together
		if($offset != '') $offset = 'offset-by-' . $offset;
		if($mobile != '') $mobile = 'mobile-' . $mobile;

		// build the class attribute
		$class_attr = $this->_build_class_attr('columns', $width, $offset, $centered == 'yes' ? 'centered' : '', $mobile, $end == 'yes' ? 'end' : '', $add_class);

		return '<div' . $class_attr . '>' . $this->content() . '</div>';
	}

	/*
	*	Smaller HTML components
	*/

	/*
	*	A button with a big load of options
	* 	Foundation docs: http://foundation.zurb.com/old-docs/f3/buttons.php#btnEx
	*/
	public function button()
	{
		// element type, can be button, submit or a (link tag)
		$element = $this->attribute('element', 'submit');
		// the label
		$label = $this->attribute('label', 'Button');
		// size can be small, medium or large
		$size = $this->attribute('size', 'medium');
		// type can be normal (standard option), success, alert or secondary
		$type = $this->attribute('type', '');
		// style can normal (standard, square), radius or round
		$style = $this->attribute('style', '');
		// additional classes
		$add_class = $this->attribute('add_class', '');

		// button/submit specific attribute
		// the name of the button
		$name = $this->attribute('name', $element == 'submit' ? 'submit' : 'button');

		// anchor specific attributes
		// title attribute for a
		$title = $this->attribute('title', '');
		// href for a
		$href = $this->attribute('href', '');
		// target for a
		$target = $this->attribute('target', '');

		// build the classes
		$class_attr = $this->_build_class_attr('button', $size, $style, $type, $add_class);

		if($element == 'submit')
		{
			return form_submit($name, $label, $class_attr);
		}
		else if($element == 'button')
		{
			return form_button($name, $label, $class_attr);
		}
		else if($element == 'anchor' && $href != '')
		{
			return '<a href="' . $href . '" title="' . $title . '" ' . $class_attr . '" target="' . $target . '">' . $label . '</a>';
		}
	}


	/*
	*	A dropdown button
	*
	*  Foundation docs: http://foundation.zurb.com/old-docs/f3/buttons.php#dropBtnEx
	*/
	public function ddbutton()
	{
		// size can be small, medium or large
		$size = $this->attribute('size', 'medium');
		// type can be normal (standard option), success, alert or secondary
		$type = $this->attribute('type', '');
		// style can normal (standard, square), radius or round
		$style = $this->attribute('style', '');
		// the main button label
		$label = $this->attribute('label', 'Dropdown Button');
		// lets the option dropdown go up
		$up = $this->attribute('up', 'no');
		// split
		$split = $this->attribute('split', 'no');
		// split button specific
		$href = $this->attribute('href', '');
		$target = $this->attribute('target', '');
		$title = $this->attribute('title', '');
		// additional classes
		$add_class = $this->attribute('add_class', '');

		$dropdown = '';
		$content = html_entity_decode($this->content()); // fuck you wysiwyg;

		if(preg_match_all('@\{\{(\s+)?link(.[^\}]+)\}\}@', $content, $links, PREG_SET_ORDER))
		{
			foreach($links as $link)
			{
				$attrs = json_decode('{' . substr(preg_replace('@(\s+)?(.[^=]+)="(.[^"]+)"@', '"$2":"$3",', $link[2]), 0, -2) . '}', true);

				$label = $attrs['label']; unset($attrs['label']);
				$href = $attrs['href']; unset($attrs['href']);

				$dropdown .= '<li>' . anchor($href, $label, $attrs) . '</li>';
			}
		}

		$split_html = '';
		$btn_class = 'button';

		if($split == 'yes')
		{
			$btn_class .= ' split';
			$split_html = '<a href="' . $href . '"';
			$split_html .= $target != '' ? ' target="' . $target . '"': '';
			$split_html .= $title != '' ? ' title="' . $title . '"': '';
			$split_html .= '>' . $label . '</a><span></span>';
		}

		$classes = $this->_build_class_attr($btn_class, 'dropdown', $split == 'yes' ? 'split' : '', $size, $style, $type, $up == 'yes' ? 'up' : '', $add_class);

		return '<div' . $classes . '>' . $split_html . '<ul>' . $dropdown . '</ul></div>';
	}

	/*
	*
	*	Those are all about labeling and yelling at the visitor
	*
	 */

	/*
	*
	*	An alert box, it's like an exclamation point.
	*	foundation docs: http://foundation.zurb.com/old-docs/f3/elements.php#alertsEx
	*
	 */
	public function alert()
	{
		// type can be '' (standard), success, alert or secondary
		$type = $this->attribute('type', '');
		// additional classes
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_class_attr('alert-box', $type, $add_class);

		return '<div' . $classes . '>' . $this->content() . '</div>';
	}

	/*
	*
	*	Labels for labeling stuff
	* 	foundation docs: http://foundation.zurb.com/old-docs/f3/elements.php#labelsEx
	 */

	public function label()
	{
		// type can be '' (standard), success, alert or secondary
		$label = $this->attribute('label', 'Label');
		// type can be '' (standard), success, alert or secondary
		$type = $this->attribute('type', '');
		// style can normal (standard, square), radius or round
		$style = $this->attribute('style', '');
		// additional classes
		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_class_attr('label', $style, $type, $add_class);

		return '<span' . $classes . '>' . $label . '</span>';
	}

	/*
	*
	*	A panel, for distinguished text.
	*	http://foundation.zurb.com/old-docs/f3/elements.php#panelEx
	*
	 */
	public function panel()
	{
		// type can be '' (standard), success, alert or secondary
		$callout = $this->attribute('callout', 'no');
		// style can normal (standard, square), radius or round
		$radius = $this->attribute('radius', 'no');

		$add_class = $this->attribute('add_class', '');

		$classes = $this->_build_class_attr('panel', $callout == 'yes' ? 'callout' : '', $radius == 'yes' ? 'radius' : '', $add_class);

		return '<div' . $classes . '>' . $this->content() . '</div>';
	}

	/*
	 * Javascript components
	 * all of these components needs a javascript lib to be functional
	 * so don't forget to add the to your site
	 */

	/*
	*
	*	Orbit - an image or content slider thing
	*
	 */
	public function orbit()
	{

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

	/*
	*
	*	A lightbox gallery thing.
	*	http://foundation.zurb.com/old-docs/f3/clearing.php
	*
	*	{{ pyfo:clearing slug="image-folder" per_row="five" }}
	*
	 */

	public function clearing()
	{
		// the folder slug
		$slug = $this->attribute('slug', false);
		// how many images in a row in the gallery?
		$per_row = $this->attribute('per_row', 'three');

		if( ! $slug ) return;

		// grab the folder
		$this->load->model('files/file_folders_m');
		$this->load->model('files/file_m');

		$folder = $this->file_folders_m->get_by('slug', $slug);
		$files = $this->file_m->get_many_by('folder_id', $folder->id);

		// build the html
		$html = '<ul class="block-grid ' . $per_row . '-up" data-clearing>';

		foreach($files as $file)
		{
			$html .= '<li><img data-caption="' . $file->description . '" src="' . $file->path . '" alt="' . $file->description . '" /></li>';
		}

		$html .= '</ul>';

		return $html;
	}

	/*
	*
	*	Creates modals and a button to reveal them.
	*	Don't forget to add {{ pyfo:render_modals }} just before the closing body tag.
	*
	* 	{{ pyfo:reveal label="Click me" size="large" }}
	* 		<p>This is text and stuff.</p>
	* 	{{ /pyfo:reveal }}
	*
	 */
	public function reveal()
	{
		// the label of the reveal button
		$label = $this->attribute('label', 'Reveal Me');
		// site of the reveal modal, can be expand, small, medium or large
		$size = $this->attribute('size', 'expand');
		// the symbol/label of the close button
		$close = $this->attribute('close', '&#215;');

		$modals = $this->load->get_var('reveal-modals');
		if( ! $modals or ! is_array($modals)) $modals = array();

		$modal_index = count($modals) + 1;

		$modals[] = '<div id="pyfo-reveal-modal-' . $modal_index . '" class="reveal-modal ' . $size . '">' . $this->content() . '<a class="close-reveal-modal">' . $close . '</a></div>';

		$this->load->vars('reveal-modals', $modals);

		return '<a href="#" class="button" data-reveal-id="pyfo-reveal-modal-' . $modal_index . '">' . $label . '</a>';
	}

	/*
	*
	*	This renders the modal divs created by reveal.
	*	Place it right before the closing body tags
	*
	* 	{{ pyfo:render_modals }}
	*
	 */

	public function render_reveal()
	{
		$modals = array();

		if( ! $modals = $this->load->get_var('reveal-modals') ) return;

		$html = '';

		foreach($modals as $modal)
		{
			$html .= $modal;
		}

		return $html;
	}

	/**
	 *
	 * 	Tabs, they are tabs.
	 * 	http://foundation.zurb.com/old-docs/f3/tabs.php
	 *
	 * 	example tabs
	 *  {{ pyfo:tabs }}
	 *	 	{{ tab name="thename" label="the label" }}This is tab content for tab1{{ /tab }}
 	 *		{{ tab name="thename2" label="the label 2" }}This is tab content for tab 2{{ /tab }}
	 *	{{ /pyfo:tabs }}
	*/

	public function tabs()
	{
		// tab sizing expands tabs to use full width
		$sizing = $this->attribute('sizing', 'no');
		// contained tabs
		$contained = $this->attribute('contained', 'no');

		$content = html_entity_decode($this->content()); // fuck you wysiwyg;

		$tabs = '';
		$tabs_content = '';
		$tab_count = 0; // for sizing

		if(preg_match_all('@\{\{ tab(.[^\}]+) \}\}(.*?)\{\{ \/tab \}\}@s', $content, $tab_tags, PREG_SET_ORDER))
		{
			foreach($tab_tags as $tab)
			{
				//get the attributes... in a crazy way ^^
				//should maybe change that later to something more sensible
				$attrs = json_decode('{' . substr(preg_replace('@(\s+)?(.[^=]+)="(.[^"]+)"@', '"$2":"$3",', $tab[1]), 0, -1) . '}');

				// the tabs
				$tabs .= '<dd><a href="#' . $attrs->name . '">' . $attrs->label . '</a></dd>';

				// the tab content
				// trim brs from the content start, those are probably just leftovers from the wysiwyg
				$content = preg_replace('@<br(\s\/)?>$@', '', preg_replace('@^<br(\s\/)?>@', '', $tab[2]));
				$tabs_content .= '<li id="' . $attrs->name . 'Tab">' . $content . '</li>';

				$tab_count++;
			}
		}

		if($sizing != 'no')
		{
			switch($tab_count)
			{
				case 1:
				case 2:
					$sizing = 'two-up';
				break;

				case 3:
					$sizing = 'three-up';
				break;

				case 4:
					$sizing = 'four-up';
				break;

				case 5:
					$sizing = 'five-up';
				break;

				default: // more than five tabs break the sizing stuff, so disable it. disappointed faces everywhere
					$sizing = 'no';
			}
		}

		$tabs_class = $this->_build_class_attr('tabs', $sizing != 'no' ? $sizing : '', $contained != 'no' ? 'contained' : '');
		$content_class = $this->_build_class_attr('tabs-content', $contained != 'no' ? 'contained' : '');

		return '<dl' . $tabs_class . '>' . $tabs . '</dl><ul' . $content_class . '>' . $tabs_content . '</ul>';
	}

	/**
	 *
	 * 	An accordion, like tabs but different
	 * 	http://foundation.zurb.com/old-docs/f3/elements.php#accEx
	 *
	 * 	Accordion tag example
	 *
	 *  {{ pyfo:accordion }}
	 *	 	{{ accordion label="the label" }}This is the accordion content{{ /accordion }}
 	 *		{{ accordion label="the label 2" }}This is the accordion content for the other accordion. Accordion, accordion, accordion.{{ /accordion }}
	 *	{{ /pyfo:accordion }}
	*/
	public function accordion()
	{
		$content = html_entity_decode($this->content()); // fuck you wysiwyg;

		$accordion = '<ul class="accordion">';

		if(preg_match_all('@\{\{ accordion(.[^\}]+) \}\}(.*?)\{\{ \/accordion \}\}@s', $content, $accordion_tags, PREG_SET_ORDER))
		{
			foreach($accordion_tags as $tag)
			{
				$accordion .= '<li>';
				// get the attributes... in a crazy way ^^
				// should maybe change that later to something more sensible
				// could use a simpler version here, but maybe we'll get more attributes in the future
				$attrs = json_decode('{' . substr(preg_replace('@(\s+)?(.[^=]+)="(.[^"]+)"@', '"$2":"$3",', $tag[1]), 0, -1) . '}');

				// the tabs
				$accordion .= '<div class="title"><h5>' . $attrs->label . '</h5></div>';

				// the tab content
				// trim brs from the content start, those are probably just leftovers from the wysiwyg
				$content = preg_replace('@<br(\s\/)?>$@', '', preg_replace('@^<br(\s\/)?>@', '', $tag[2]));
				$accordion .= '<div class="content">' . $content . '</div>';

				$accordion .= '</li>';
			}

		}

		$accordion .= '</ul>';

		return $accordion;
	}


	/*---------------------------------------------------------------------------------------------------------------*/

	/*
	* internal plugin utility functions
	*/

	// build a dropdown list from the content of a tag pair for dropdown buttons and the likes
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

	/* build the class attribute, includes the attribute name and a whitespace in the front */
	private function _build_class_attr()
	{
		$classes = func_get_args ();
		return ' class="' . trim(implode(' ', $classes)) . '"';
	}

}
