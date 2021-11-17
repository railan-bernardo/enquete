<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * class Enquete
 * @package Source\Models
 */
class Enquete extends Model
{

  function __construct()
  {
    parent::__construct("enquete",['id'],['title','start_time','end_time']);
  }


    /**
    * @return bool
    */
   public function save(): bool
   {
       if (!$this->required()) {
           $this->message->warning("Titulo, Data Inicio, Data Término");
           return false;
       }


       /** Enquete Update */
       if (!empty($this->id)) {
           $enqueteId = $this->id;


           $this->update($this->safe(), "id = :id", "id={$enqueteId}");
           if ($this->fail()) {
               $this->message->error("Erro ao atualizar, verifique os dados");
               return false;
           }
       }

       /** Enquete Create */
       if (empty($this->id)) {

           $enqueteId = $this->create($this->safe());
           if ($this->fail()) {
               $this->message->error("Erro ao cadastrar, verifique os dados");
               return false;
           }
       }

       $this->data = ($this->findById($enqueteId))->data();
       return true;
   }

}
