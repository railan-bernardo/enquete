<?php

namespace Source\Core;


/**
 * Class View
 *
 * @author Railan Bernardo <railabernardo2016@gmail.com>
 * @package Source\Core
 */
 use League\Plates\Engine;

 class View
 {
     /** @var Engine */
     private $engine;

     /**
      * View constructor.
      * @param string $path
      * @param string $ext
      */
     public function __construct(string $path = CONF_VIEW_THEME, string $ext = CONF_VIEW_EXT)
     {
         $this->engine = Engine::create($path, $ext);
     }

     /**
      * @param string $name
      * @param string $path
      * @return View
      */
     public function path(string $name, string $path): View
     {
         $this->engine->addFolder($name, $path);
         return $this;
     }

     /**
      * @param string $templateName
      * @param array $data
      * @return string
      */
     public function render(string $templateName, array $data): string
     {
         return $this->engine->render($templateName, $data);
     }

     /**
      * @return Engine
      */
     public function engine(): Engine
     {
         return $this->engine();
     }
}
