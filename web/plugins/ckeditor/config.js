/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		'/',
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.removeButtons = 'Save,NewPage,Preview,Print,Source,Templates,PasteText,PasteFromWord,Replace,SelectAll,Scayt,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Form,Subscript,Superscript,Strike,NumberedList,BulletedList,Indent,Outdent,Blockquote,CreateDiv,BidiRtl,BidiLtr,Language,Anchor,Iframe,SpecialChar,Smiley,Flash,Image,Format,Styles,ShowBlocks,About';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	//介面的語系 Defaults to: '' ; 留空字串的話會字動抓使用者本地端語言(繁中為zh-tw)
	config.language = 'zh';
 
	//設定內容語系 Defaults to: 與編輯器語言一樣
	config.contentsLanguage = '';

	//重做(上一步)次數
	config.undoStackSize = 50;

	// 預設字體 - 詳見最下方(註一)
	config.font_defaultLabel = 'Arial';
 
	// 預設字體尺寸 - 詳見最下方(註一)
	config.fontSize_defaultLabel = '12px'; 



};
