<?php

class LinkPager extends CLinkPager
{
  protected function createPageButton($label, $page, $class, $hidden, $selected)
  {
    if ($hidden)
      return '';
    return parent::createPageButton($label, $page, $class, $hidden, $selected);
  }


}
