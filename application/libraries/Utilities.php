<?php
class Utilities {
	public static function ckConfig()
	{
		return array('toolbar' => array(
			    array( 'Source', '-',  'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ),
			    array( 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ),
				array('NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ),
				array('Link','Unlink','Anchor'), 
			));
	}
	
	public static function allSections()
	{
		return Underscore::each(Area::all(), function($section){
			return $section->title;
		});
	}
}