<?php

class LinkPager extends CLinkPager
{
  protected function createPageButton($label, $page, $class, $hidden, $selected)
  {
    if ($hidden)
      return '';
    return parent::createPageButton($label, $page, $class, $hidden, $selected);
  }

  public function render($view, $data = null, $return = false)
  {
    return '<div class="pagination">' . parent::render($view, $data, $return) . '</div>';
  }


}
