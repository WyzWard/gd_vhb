<?php

class RestaurantesModel extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function restaurantes() 
    {
        $query = $this->db->get('restaurantes');
        return $query->result_array();
    }

    public function pratos($id)
    {
        $query = $this->db->get_where('restaurantes', array('restaurante_id' => $id));
        $rest = $query->row();

        $query = $this->db->get_where('pratos', array('prato_restaurante_id' => $id));
        $pratos = $query->result_array();

        $result = array(
            'restaurante'   => json_decode(json_encode($rest), true),
            'pratos'        => $pratos
        );

        return $result;
    }
}