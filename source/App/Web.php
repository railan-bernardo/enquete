<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Enquete;
/**
 * Web Controller
 * @package Source\App
 */
class Web extends Controller
{

  /**
   * Web constructor.
   */
  public function __construct()
  {
    parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
  }

  /**
   * SITE HOME
   */
  public function home(): void
  {

    echo $this->view->render("home",[
      "title"=>CONF_SITE_NAME,
      "enquetes"=>(new Enquete())
      ->find()
      ->order("created_at ASC")
      ->fetch(true)
    ]);

  }

  /**
 * SITE REGISTER ENQUETE
 * @param null|array $data
 */
public function register(?array $data): void
{

    if (!empty($data['csrf'])) {
        if (!csrf_verify($data)) {
            $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário!")->render();
            echo json_encode($json);
            return;
        }

        if (in_array("", $data)) {
            $json['message'] = $this->message->info("Informe os dados para cadastrar a enquete!")->render();
            echo json_encode($json);
            return;
        }

        //create
        if(!empty($data['action']) && $data['action'] == "create"){
          $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

          $enquete = new Enquete();
          $enquete->title =  $data["title"];
          $enquete->start_time = date_fmt_back($data["start_time"]);
          $enquete->end_time = date_fmt_back($data["end_time"]);


        if ($enquete->save()) {
          $json['message'] = $this->message->success("Enquete cadastrada com sucesso!")->render();
            $json['redirect'] = url("/");
        } else {
            $json['message'] = $enquete->message()->before("Ooops! ")->render();
        }

        echo json_encode($json);
        return;
        }


        //update
        if(!empty($data['action']) && $data['action'] == "update"){
          $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
          $enqueteUpdate = (new Enquete())->findById($data["enqueteId"]);

          $enqueteUpdate->title =  $data["title"];
          $enqueteUpdate->start_time = date_fmt_back($data["start_time"]);
          $enqueteUpdate->end_time = date_fmt_back($data["end_time"]);


        if ($enqueteUpdate->save()) {
          $json['message'] = $this->message->info("Enquete Atualizada com sucesso!")->render();
            $json['redirect'] = url("/");
        } else {
            $json['message'] = $enquete->message()->before("Ooops! ")->render();
        }

        echo json_encode($json);
        return;
        }

    }

    //delete
    if (!empty($data["action"]) && $data["action"] == "delete") {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $enqueteDelete = (new Enquete())->findById($data["enquete_id"]);

        if (!$enqueteDelete) {
            $this->message->error("Você tentou excluir uma enquete que não existe ou já foi removida")->flash();
            echo json_encode(["reload" => true]);
            return;
        }


        $enqueteDelete->destroy();
        $this->message->error("Enquete deletada com sucesso...")->flash();

        echo json_encode(["reload" => true]);
        return;
    }

    //delete
    if (!empty($data["action"]) && $data["action"] == "delete") {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $enqueteDelete = (new Enquete())->findById($data["enquete_id"]);

        if (!$enqueteDelete) {
            $this->message->error("Você tentou excluir uma enquete que não existe ou já foi removida")->flash();
            echo json_encode(["reload" => true]);
            return;
        }


        $enqueteDelete->destroy();
        $this->message->error("Enquete deletado com sucesso...")->flash();

        echo json_encode(["reload" => true]);
        return;
    }

    //voto
    if(!empty($data['action']) && $data['action'] == "voto"){
      $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
      $enqueteVoto = (new Enquete())->findById($data["enquete_id"]);


      $enqueteVoto->voto = $enqueteVoto->voto + 1;

    if ($enqueteVoto->save()) {
      $this->message->warning("Obrigado pelo voto!")->flash();

      echo json_encode(["reload" => true]);
      return;
    } else {
        $json['message'] = $enqueteVoto->message()->before("Ooops! ")->render();
    }


    }


    $enqueteEdit = null;
    if (!empty($data["enqueteId"])) {
          $enqueteId = filter_var($data["enqueteId"], FILTER_VALIDATE_INT);
          $enqueteEdit = (new Enquete())->findById($enqueteId);
      }

    echo $this->view->render("post", [
        "title" => ($enqueteEdit->title ?? "Cadastrar Enquete") . " | " . CONF_SITE_NAME,
        "post"=>$enqueteEdit
    ]);
}


/**
     * SITE NAV ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está diponível no momento. Já estamos vendo isso.";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;

            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo para você.";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Conteúdo indispinível :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }



        echo $this->view->render("error", [
            "title" =>"Opss 404 | " . CONF_SITE_NAME,
            "error" => $error
        ]);
    }

}


 ?>
