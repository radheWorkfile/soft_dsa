<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Dashboard extends CI_Controller
    {
        public function __construct()
        {

            parent::__construct();
            $this->load->model('employee/Common_model','common_model');
            $this->load->model('employee/Dashboard_model', 'dashboard_model');
            ($this->session->userdata('user_cate') != 1 && $this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';error_reporting(0);

        }

        function index()
        {
           
            $data['title']           = 'Dashboard';
            $data['breadcrumb']      = 'Dashboard';
            $data['total_customer']  = $this->common_model->count_all_or_cond('customer', array('document_status' => 2,),array('created_by_user_type_id'=> $this->session->userdata('user_id')));
            $data['follow_customer'] = $this->common_model->count_all_or_cond('customer_document', array('status' => 1, 'document_status' => 1), array('created_by_user_type_id'=> $this->session->userdata('user_id')));
            $data['approve_customer'] = $this->common_model->count_all_or_cond('customer_document', array('status' => 2, 'document_status' => 2), array('created_by_user_type_id' => $this->session->userdata('user_id')));
            $data['reject_customer']  = $this->common_model->count_all_or_cond('customer_document', array('status' => 3, 'document_status' => 2), array('created_by_user_type_id' => $this->session->userdata('user_id')));
            $data['assing_menu'] = $this->common_model->get_assign_data();
            $this->load->view('employee/base', $data);
        }

    }
?>