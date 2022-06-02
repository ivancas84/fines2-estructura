<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/nombres_parecidos.php");

class GenerarTicketTomaPersistApi extends BaseApi {

    /**
     * Conexión a la base de datos de tickets
     */
    public $db; 

    public function main() {
        $idToma = $this->idToma();
        $toma = $this->container->getRel("toma")->value(
            $this->toma($idToma)
        );


        $this->db = new Db(TKT_HOST, TKT_USER, TKT_PASS, TKT_DBNAME);


        $this->db->begin_transaction();
        try {
            $idTicket = $this->generarId("wpwt_wpsc_ticket");
            $idTicketmeta = $this->generarId("wpwt_wpsc_ticketmeta");
            $idPosts = $this->generarId("wpwt_posts");

            $ticketPostsData = $this->postsData($idPosts);
            $ticketData = $this->ticketData($toma, $idTicket, $idPosts);
            $ticketmetaData = $this->ticketMetadata($toma, $idTicketmeta, $idTicket);
            $this->generarPostsData();
            $this->generarTicket($ticketData);
            $this->generarTicketmeta($ticketmetaData);
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
        return $this->container->getDb()->get("toma", $idToma);
    }

    public function postsData($t, $idPosts){
        return [
            "id" => $idPosts,
            "post_date" => date("Y-m-d h:i:s"),
            "post_date_gmt" => date("Y-m-d h:i:s"),
            "post_content" => "Registro del desarrollo del curso",
            "post_status" => "publish",
            "comment_status" => "closed", 
            "ping_status" => "closed", 
            "post_name" => $idPosts,
            "post_modified" => date("Y-m-d h:i:s"),
            "post_modified_gmt" => date("Y-m-d h:i:s"),
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
            "date_created" => date("Y-m-d h:i:s"),
            "date_updated" => date("Y-m-d h:i:s"),
            "ticket_auth_code" => uniqid(),
            "history_id" => "4097",

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

    protected function generarId($descripcion){
        $sql = "SELECT max(id) AS id FROM `$descripcion`";
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
            post_type,
        ) VALUES (
            " . $d["id"] . ",
            '" . $d["post_date"] . "',
            '" . $d["post_date_gmt"] . "',
            '" . $d["post_content"] . "',

            " . $d["id"] . ",
            " . $d["ticket_id"] . ",
            '" . $d["meta_key"] . "',
            '" . $d["meta_value"] . "',
            " . $d["id"] . ",
            " . $d["ticket_id"] . ",
            '" . $d["meta_key"] . "',
            '" . $d["meta_value"] . "',
            " . $d["id"] . ",
            " . $d["ticket_id"] . ",
            '" . $d["meta_key"] . "',
            '" . $d["meta_value"] . "'
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
            ticket_auth_code
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
            '" . $d["ticket_auth_code"] . "'
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
        );";
        // echo $sql;
        $this->db->query($sql);
    }
}
