<?php

class MarkdownScripts extends CWidget
{
  public function init()
  {
    $baseUrl = Yii::app()->baseUrl;

    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile($baseUrl . '/js/pagedown/Markdown.Converter.js');
    $cs->registerScriptFile($baseUrl . '/js/pagedown/Markdown.Sanitizer.js');
    $cs->registerScriptFile($baseUrl . '/js/pagedown/Markdown.Editor.js');
    $cs->registerScript('md-init',
        "var converter = Markdown.getSanitizingConverter();" .
            "var editor = new Markdown.Editor(converter);" .
            "editor.run();",
      CClientScript::POS_READY);
  }

  public static function encode($content)
  {
    Yii::import('ext.markdown.*');
    require_once('markdown.php');
    return Markdown($content);
  }

}
