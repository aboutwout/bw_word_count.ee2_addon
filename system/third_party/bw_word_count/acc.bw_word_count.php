<?php

/**
* @package    BW Word Count
* @subpackage	ThirdParty
* @category   Accessories
* @version		1.0
* @author     Wouter Vervloet <wouter@baseworks.nl>
* @copyright  Copyright (c) 2010, Baseworks
* @license    http://creativecommons.org/licenses/by-sa/3.0/
* 
* This work is licensed under the Creative Commons Attribution-Share Alike 3.0 Unported.
* To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/3.0/
* or send a letter to Creative Commons, 171 Second Street, Suite 300,
* San Francisco, California, 94105, USA.
* 
*/

if ( ! defined('EXT')) { exit('Invalid file request'); }

class Bw_word_count_acc {

	var $name		= 'BW Word Count';
	var $id			= 'bw_word_count';
	var $version		= '1.0';
	var $description	= 'Add a word counter to all native ExpressionEngine textareas on the publish page';
	var $sections		= array();

	function set_sections()
	{
	  
		$EE =& get_instance();

		$EE->cp->add_to_head('<style type="text/css">'.$this->_css().'</style>');
		$EE->cp->add_to_head('<script type="text/javascript">'.$this->_js().'</script>');

	}
	
	function _js()
	{
	  ob_start();
?>

    $(function() {
  
      $("#accessoryTabs a.bw_word_count").parent().remove();
      var $ta = $('.publish_textarea textarea');
  
      $ta.keyup(bw_count_words).each(function() {
        $(this).after('<span class="bw-word-count"></span>').trigger('keyup');
      });
  
    });

    function bw_count_words(evt)
    {  

      var b = [];
      var a = $(this).val().split(' ');
      
      for (i in a) {
        if(a[i] != '')
          b.push(a[i]);
      }
      
      var len = b.length;
      var word = (len == 1) ? ' word' : ' words';
        
      $(this).next('.bw-word-count').text(len + word);
      
    }

<?php	
    $buffer = ob_get_contents();
    ob_end_clean(); 

    return $buffer;

	}
	
  function _css()
  {
    ob_start();
?>

    .bw-word-count{
      display:inline-block;
      background:#B6C0C2;
      border-bottom-left-radius:3px;
      border-bottom-right-radius:3px;
      -moz-border-radius:0 0 3px 3px;
      font-size:11px;
      color:#fff;
      padding:3px 5px;
      margin:-2px 0 0 6px
    }

<?php	
    $buffer = ob_get_contents();
    ob_end_clean(); 

    return $buffer;

	}	
	
}
// END CLASS