<?php

namespace Lib\Presentation;

class HomePage {
    protected $presentation = __DIR__.'/../../public/pages/';
    
    public function documentation()
    {
        include $this->presentation.'home_page.php';
    }
}