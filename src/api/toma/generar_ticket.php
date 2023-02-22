<?php

require_once("api/base.php");
require_once("function/php_input.php");
require_once("function/nombres_parecidos.php");

class TomaGenerarTicketApi extends BaseApi {

    /**
     * Conexión a la base de datos de tickets
     */
    public $db; 

    public function main() {
        $idToma = $this->idToma();
        $toma = $this->container->tools("toma")->value(
            $this->toma($idToma)
        );


        $this->db = new Db(TKT_HOST, TKT_USER, TKT_PASS, TKT_DBNAME);


        $this->db->begin_transaction();
        try {
            $idTicket = $this->generarId("wpwt_wpsc_ticket");
            $idTicketmeta = $this->generarId("wpwt_wpsc_ticketmeta");
            $idPosts = $this->generarId("wpwt_posts");
            $idPostmeta = $this->generarId("wpwt_postmeta", "meta_id");

            $postsData = $this->postsData($idPosts);
            $ticketData = $this->ticketData($toma, $idTicket, $idPosts);
            $ticketmetaData = $this->ticketmetaData($toma, $idTicketmeta, $idTicket);
            $postmetaData = $this->postmetaData($toma, $idPostmeta, $idPosts, $idTicket);

            $this->generarPosts($postsData);
            $this->generarTicket($ticketData);
            $this->generarTicketmeta($ticketmetaData);
            $this->generarPostmeta($postmetaData);

        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        } finally {
            $this->db->commit();
        }
    }

    public function idToma(){
        $idToma =   file_get_contents("php://input");
        if(empty($idToma)) throw new Exception("No está definido el id de la toma");
        return $idToma;
    }

    public function toma($idToma){
        return $this->container->db()->get("toma", $idToma);
    }

    public function postsData($idPosts){
        return [
            "id" => $idPosts,
            "post_date" => date("Y-m-d H:i:s"),
            "post_date_gmt" => date("Y-m-d H:i:s"),
            "post_content" => "Registro del desarrollo del curso",
            "post_status" => "publish",
            "comment_status" => "closed", 
            "ping_status" => "closed", 
            "post_name" => $idPosts,
            "post_modified" => date("Y-m-d H:i:s"),
            "post_modified_gmt" => date("Y-m-d H:i:s"),
            "guid" => "https://planfines2.com.ar/wp/?wpsc_ticket_thread=".$idPosts,
            "post_type" => "wpsc_ticket_thread",
        ];
    }

  

    public function ticketData($t, $idTicket, $idPosts){
        return [
            "id" => $idTicket,
            "ticket_status" => 8,
            "customer_name" => $t["docente"]->_get("nombre"),
            "customer_email" => $t["docente"]->_get("email"),
            "ticket_subject" => $t["sede"]->_get("numero") . $t["comision"]->_get("division") . "/" . $t["planificacion"]->_get("anio") . $t["planificacion"]->_get("semestre") . " " . $t["asignatura"]->_get("nombre") . " (" . $t["docente"]->_get("nombre") . ")", 
            "user_type" => "guest",
            "ticket_category" => "5",
            "ticket_priority" => "10",
            "date_created" => date("Y-m-d H:i:s"),
            "date_updated" => date("Y-m-d H:i:s"),
            "ticket_auth_code" => uniqid(),
            "historyId" => $idPosts,

        ];
    }

    public function ticketmetaData($t, $idTicketmeta, $idTicket){
        return [
            "id" => $idTicketmeta,
            "ticket_id" => $idTicket,
            "meta_key" => "dni",
            "meta_value" => $t["docente"]->_get("numero_documento"),
        ];
    }

    public function postmetaData($t, $idPostmeta, $idPosts, $idTicket){
      return [
        "meta_id" => $idPostmeta,
        "ticket_id" => $idTicket,
        "post_id" => $idPosts,
        "customer_email" => $t["docente"]->_get("email"),
        "customer_name" => $t["docente"]->_get("nombre"),
        "thread_type" => "report",
        "reply_source" => "browser",
        "attachments" => "a:0:{}",
        "user_seen" => "null",
        "browser" => "Google Chrome",
        "os" => "Android",
        "ip_adress" => "0.0.0.0",
      ];
    }  

    protected function generarId($descripcion, $field = "id"){
        $sql = "SELECT max($field) AS id FROM `$descripcion`";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        $result->free();

        $id = intval($row["id"])+1;
        return $id;

    }


    protected function generarPosts($d){
        $sql = "INSERT INTO `wpwt_posts` (
            id,
            post_date,
            post_date_gmt,
            post_content,
            post_status,
            comment_status,
            ping_status,
            post_name,
            post_modified,
            post_modified_gmt,
            guid,
            post_type
        ) VALUES (
            " . $d["id"] . ",
            '" . $d["post_date"] . "',
            '" . $d["post_date_gmt"] . "',
            '" . $d["post_content"] . "',
            '" . $d["post_status"] . "',
            '" . $d["comment_status"] . "',
            '" . $d["ping_status"] . "',
            '" . $d["post_name"] . "',
            '" . $d["post_modified"] . "',
            '" . $d["post_modified_gmt"] . "',
            '" . $d["guid"] . "',
            '" . $d["post_type"] . "'
        );";
        // echo $sql;
        $this->db->query($sql);
    }

    protected function generarTicket($d){
        $sql = "INSERT INTO `wpwt_wpsc_ticket` (
            id, 
            ticket_status, 
            customer_name, 
            customer_email, 
            ticket_subject, 
            user_type,
            ticket_category, 
            ticket_priority, 
            date_created,
            date_updated,
            ticket_auth_code,
            historyId
        ) VALUES (
            " . $d["id"] . ",
            " . $d["ticket_status"] . ",
            '" . $d["customer_name"] . "',
            '" . $d["customer_email"] . "',
            '" . $d["ticket_subject"] . "',
            '" . $d["user_type"] . "',
            " . $d["ticket_category"] . ",
            " . $d["ticket_priority"] . ",
            '" . $d["date_created"] . "',
            '" . $d["date_updated"] . "',
            '" . $d["ticket_auth_code"] . "',
            " . $d["historyId"] . "
        );";
            // echo $sql;
        $this->db->query($sql);
    }

    protected function generarTicketmeta($d){
        $sql = "INSERT INTO `wpwt_wpsc_ticketmeta` (
            id, 
            ticket_id, 
            meta_key, 
            meta_value
        ) VALUES (
            " . $d["id"] . ",
            " . $d["ticket_id"] . ",
            '" . $d["meta_key"] . "',
            '" . $d["meta_value"] . "'
        ),
        (
          " . ($d["id"]+1) . ",
          " . $d["ticket_id"] . ",
          'assigned_agent',
          '0'
        ),
        (
          " . ($d["id"]+2) . ",
          " . $d["ticket_id"] . ",
          'prev_assigned_agent',
          '0'
        );";


        // echo $sql;
        $this->db->query($sql);
    }

    protected function generarPostmeta($d){

      $sql = "INSERT INTO `wpwt_postmeta` (meta_id, post_id, meta_key, meta_value) VALUES
      (
        " . $d["meta_id"] . ",
        " . $d["post_id"] . ",
        'ticket_id',
        '" . $d["ticket_id"] . "'
      ),
      (
        " . ($d["meta_id"]+1) . ",
        " . $d["post_id"] . ",
        'customer_email',
        '" . $d["customer_email"] . "'
      ),
      (
        " . ($d["meta_id"]+2) . ",
        " . $d["post_id"] . ",
        'customer_name',
        '" . $d["customer_name"] . "'
      ),
      (
        " . ($d["meta_id"]+3) . ",
        " . $d["post_id"] . ",
        'thread_type',
        '" . $d["thread_type"] . "'
      ),
      (
        " . ($d["meta_id"]+4) . ",
        " . $d["post_id"] . ",
        'reply_source',
        '" . $d["reply_source"] . "'
      ),
      (
        " . ($d["meta_id"]+5) . ",
        " . $d["post_id"] . ",
        'attachments',
        '" . $d["attachments"] . "'
      ),
      (
        " . ($d["meta_id"]+6) . ",
        " . $d["post_id"] . ",
        'browser',
        '" . $d["browser"] . "'
      ),
      (
        " . ($d["meta_id"]+7) . ",
        " . $d["post_id"] . ",
        'os',
        '" . $d["os"] . "'
      ),
      (
        " . ($d["meta_id"]+8) . ",
        " . $d["post_id"] . ",
        'ip_adress',
        '" . $d["ip_adress"] . "'
      ),
      (
        " . ($d["meta_id"]+9) . ",
        " . $d["post_id"] . ",
        'user_seen',
        null
      );";
      
      $this->db->query($sql);
  }
}
