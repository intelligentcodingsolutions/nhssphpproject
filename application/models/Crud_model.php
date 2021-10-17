<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crud_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


	 function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
        return $row[$field];
    }



     function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;

    }

    function get_subject_name_by_id ($subject_id){
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
            return $query->name;
    }

    function get_class_name ($class_id){
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $result = $query->result_array();
        foreach ($result as $key => $row)
                return $row['name'];

    }

    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }


    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_admin_name($admin_id) {
        $query = $this->db->get_where('admin', array('admin_id' => $admin_id));
        $resi = $query->result_array();
        foreach ($resi as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }


    function get_invoice_info() {
        $query = $this->db->get('invoice');
        return $query->result_array();
    }

    /***********  Subjects  *******************/
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }


    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    /***********  Exams  *******************/
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    /***********  Grades  *******************/
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_students($class_id){
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function list_all_student_and_order_with_student_id(){

        $data = array();
        $sql = "select * from student order by student_id desc limit 0, 5";
        $all_student_selected = $this->db->query($sql)->result_array();

        foreach($all_student_selected as $key => $selected_students_from_student_table){
            $student_id = $selected_students_from_student_table['student_id'];
            $face_file = 'uploads/student_image/'. $student_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/student_image/default_image.jpg/';
            }

            $selected_students_from_student_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_students_from_student_table);
        }

        return $data;
    }

    function list_all_teacher_and_order_with_teacher_id(){

        $data = array();
        $sql = "select * from teacher order by teacher_id desc limit 0, 5";
        $all_teacher_selected = $this->db->query($sql)->result_array();

        foreach($all_teacher_selected as $key => $selected_teachers_from_teacher_table){
            $teacher_id = $selected_teachers_from_teacher_table['teacher_id'];
            $face_file = 'uploads/teacher_image/'. $teacher_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/teacher_image/default_image.jpg/';
            }

            $selected_teachers_from_teacher_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_teachers_from_teacher_table);
        }

        return $data;
    }


    function enquiry_category(){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->insert('enquiry_category', $page_data);
    }

    function update_category($param2){
        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->where('enquiry_category_id', $param2);
        $this->db->update('enquiry_category', $page_data);

    }

    function delete_category($param2){
        $this->db->where('enquiry_category_id', $param2);
        $this->db->delete('enquiry_category');

    }

    function delete_enquiry($param2){
        $this->db->where('enquiry_id', $param2);
        $this->db->delete('enquiry');
    }

    function insert_club(){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');

        $this->db->insert('club', $page_data);
    }

    function update_club($param2){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');

        $this->db->where('club_id', $param2);
        $this->db->update('club', $page_data);
    }


    function delete_club($param2){
        $this->db->where('club_id', $param2);
        $this->db->delete('club');
    }


    function insert_circular(){

        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');

        $this->db->insert('circular', $page_data);

    }

    function update_circular($param2){
        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');

        $this->db->where('circular_id', $param2);
        $this->db->update('circular', $page_data);
    }


    function delete_circular($param2){
        $this->db->where('circular_id', $param2);
        $this->db->delete('circular');
    }


    function insert_parent(){

        $page_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);

        $this->db->insert('parent', $page_data);
    }


    function update_parent($param2){
        $page_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);

        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $page_data);
    }

    function delete_parent($param2){
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
    }

    function insert_librarian(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'librarian_number' 	=> $this->input->post('librarian_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );
            
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('librarian', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/librarian/', 'refresh');
		}
		else
		{
        $this->db->insert('librarian', $page_data);
        $librarian_id = $this->db->insert_id();
		
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/librarian_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('librarian', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }

    function update_librarian($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('librarian_id', $param2);
                $this->db->update('librarian', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $param2 . '.jpg');            
    }

    function delete_librarian($param2){
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
    }



    function insert_accountant(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'accountant_number' 	=> $this->input->post('accountant_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );
            
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('accountant', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/accountant/', 'refresh');
		}
		else
		{
        $this->db->insert('accountant', $page_data);
        $accountant_id = $this->db->insert_id();
		
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/accountant_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('accountant', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }




    function update_accountant($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('accountant_id', $param2);
                $this->db->update('accountant', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $param2 . '.jpg');            
    }

    function delete_accountant($param2){
        $this->db->where('accountant_id', $param2);
        $this->db->delete('accountant');
    }




    function insert_hostel(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'hostel_number' 	=> $this->input->post('hostel_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );
            
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hostel', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hostel/', 'refresh');
		}
		else
		{
        $this->db->insert('hostel', $page_data);
        $hostel_id = $this->db->insert_id();
		
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hostel_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $hostel_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('hostel', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }

    
    function update_hostel($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('hostel_id', $param2);
                $this->db->update('hostel', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $param2 . '.jpg');            
    }

    function delete_hostel($param2){
        $this->db->where('hostel_id', $param2);
        $this->db->delete('hostel');
    }



    function insert_hrm(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'hrm_number' 	    => $this->input->post('hrm_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );
            
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hrm', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hrm/', 'refresh');
		}
		else
		{
        $this->db->insert('hrm', $page_data);
        $hrm_id = $this->db->insert_id();
		
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hrm_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $hrm_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('hrm', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }


    function update_hrm($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('hrm_id', $param2);
                $this->db->update('hrm', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $param2 . '.jpg');            
    }

    function delete_hrm($param2){
        $this->db->where('hrm_id', $param2);
        $this->db->delete('hrm');
    }


    function system_logo(){

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
    }


    function update_settings(){

        $data['description']    =   $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('running_session');
        $this->db->where('type', 'session');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('footer');
        $this->db->where('type', 'footer');
        $this->db->update('settings', $data);
    }


    function update_theme(){

        $data['description']    =   $this->input->post('skin_colour');
        $this->db->where('type', 'skin_colour');
        $this->db->update('settings', $data);
    }

    function get_settings($type){
        $get_settings = $this->db->get_where('settings', array('type' => $type))->row()->description;
        return $get_settings;
    }


    function stripe_settings (){
        $stripe_info = array();

        $stripe['stripe_active']    = html_escape($this->input->post('stripe_active'));
        $stripe['testmode']         = html_escape($this->input->post('testmode'));
        $stripe['secret_key']       = html_escape($this->input->post('secret_key'));
        $stripe['public_key']       = html_escape($this->input->post('public_key'));
        $stripe['secret_live_key']  = html_escape($this->input->post('secret_live_key'));
        $stripe['public_live_key']  = html_escape($this->input->post('public_live_key'));

        array_push($stripe_info, $stripe);

        $data['description'] = json_encode($stripe_info);
        $this->db->where('type', 'stripe_setting');
        $this->db->update('settings', $data);

    }

    function paypal_settings(){
        $paypal_info = array();

        $stripe['paypal_active']    = html_escape($this->input->post('paypal_active'));
        $stripe['paypal_mode']         = html_escape($this->input->post('paypal_mode'));
        $stripe['sandbox_client_id']       = html_escape($this->input->post('sandbox_client_id'));
        $stripe['production_client_id']       = html_escape($this->input->post('production_client_id'));
        
        array_push($paypal_info, $stripe);

        $data['description'] = json_encode($paypal_info);
        $this->db->where('type', 'paypal_setting');
        $this->db->update('settings', $data);


    }
    function get_total_mark($online_exam_id){

        $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if(sizeof($added_question_info) > 0){
            foreach($added_question_info as $key => $single_question){
                $total_mark = $total_mark + $single_question['mark'];
            }
        }

        return $total_mark;
    }


    function create_online_exam(){
        $data['code']  = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title'] = $this->input->post('exam_title');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction'] = $this->input->post('instruction');
        $data['status'] = 'pending';
        
        $data['exam_date'] = strtotime($this->input->post('exam_date'));
       
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end'] = $this->input->post('time_end');
        $data['duration'] = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);
        $data['running_year'] =   $this->db->get_where('settings' , array('type'=>'session'))->row()->description;
        echo($data['exam_date']);
        $this->db->insert('online_exam', $data);
    }

    function update_online_exam(){

        $data['title'] = $this->input->post('exam_title');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction'] = $this->input->post('instruction');
        $data['exam_date'] = strtotime($this->input->post('exam_date'));
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end'] = $this->input->post('time_end');
        $data['duration'] = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);

        $this->db->where('online_exam_id', $this->input->post('online_exam_id'));
        $this->db->update('online_exam', $data);
    }

    function delete_online_exam($param2){
        $this->db->where('online_exam_id', $param2);
        $this->db->delete('online_exam');
    }

    // multiple_choice_question crud functions
    function add_multiple_choice_question_to_online_exam($online_exam_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('options can noy be blank'));
            return;
        }
        foreach ($this->input->post('options') as $key => $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));
    }


    function update_multiple_choice_question($question_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('options can noy be blank'));
            return;
        }
        foreach ($this->input->post('options') as $key => $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));
    }

    // true_false_question crud functions
    function add_true_false_question_to_online_exam($online_exam_id){

        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'true_false';
        $data['correct_answers']    = $this->input->post('true_false_answer');

        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));
    }

    function update_true_false_question($question_id){

        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = $this->input->post('true_false_answer');

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));
    }

     // fill_in_the_blanks_question crud functions
    function add_fill_in_the_blanks_question_to_online_exam($online_exam_id){

        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach($suitable_words_array as $key => $row){
            array_push($suitable_words, strtolower($row));
        }

        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'fill_in_the_blanks';
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));

        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));

    }


    function update_fill_in_the_blanks_question($question_id){

        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach($suitable_words_array as $key => $row){
            array_push($suitable_words, strtolower($row));
        }

        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'fill_in_the_blanks';
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));

    }

    function delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('question_bank');
    }

    function manage_online_exam_status($online_exam_id = null, $status = null){

        $checker = array(

            'online_exam_id' => $online_exam_id
        );

        $updater = array(

            'status' => $status
        );

        $this->db->where($checker);
        $this->db->update('online_exam', $updater);
        $this->session->set_flashdata('flash_message' , get_phrase('exam').' '. $status);
    }



    function available_exams($student_id) {
       
        $running_year = get_settings('session');
        echo( $running_year);
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $section_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'status' => 'published');
        $this->db->order_by("exam_date", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }

    


    function change_online_exam_status_to_attended_for_student($online_exam_id = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('online_exam_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('online_exam_result', $inserted_array);
        }
    }

    function submit_online_exam($online_exam_id = null, $answer_script = null){
       echo("crud submit_online_exam ");
      
       
        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );
        //echo(json_encode($checker));
        $this->db->where($checker);
        $this->db->update('online_exam_result', $updated_array);

        $this->calculate_exam_mark($online_exam_id);
    }

    function calculate_exam_mark($online_exam_id) {
        echo("calculate_exam_mark");

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {
            echo("in if");
            $data['obtained_mark'] = 0;
        }
        else{
            echo("in else");
            $results = $online_exam_result->row_array();
           // echo(json_encode($results));
            $answer_script = json_decode($results['answer_script'], true);
            echo(json_encode( $answer_script));
            echo("answerscript");
            echo($answer_script);
            foreach ($answer_script as $row) {
                echo("here");

                if ($row['submitted_answer'] == $row['correct_answers']) {
                    echo("correct");
                    echo($obtained_marks);
                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                    echo("Obtained");
                    echo($obtained_marks);
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        echo("Before Total Mark");
        $total_mark = $this->get_total_mark($online_exam_id);
        echo($total_mark);
        $query = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];
        echo($minimum_percentage);
        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('online_exam_result', $data);

    }



    function get_question_details_by_id($question_ban_id, $column_name = null){
        echo("inside get_question_details_by_id");
        echo($question_ban_id);
        echo($column_name);
       


        return $this->db->get_where('question_bank', array('question_bank_id' => $question_ban_id))->row()->$column_name;
    }



    function check_availability_for_student($online_exam_id){
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }


    function get_online_exam_result($student_id){

        $match = array('student_id' => $student_id, 'status' => 'submitted');
        $exams = $this->db->where($match)->get('online_exam_result')->result_array();
        return $exams;
    }


    function get_correct_answer($question_bank_id = null){
        echo("get_correct_answer");
        echo($question_bank_id);
        $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }
    
   function send_student_score_model(){

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $receiver = $this->input->post('receiver');

        $select_all_student_from_student_table = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($select_all_student_from_student_table as $key => $all_selected_student_from_student_table){

            if($receiver == 'student')
                $recieverPhoneNumber = $all_selected_student_from_student_table['phone'];
            if($receiver == 'parent' && $all_selected_student_from_student_table['parent_id'] != NULL)
            $select_from_parent_table = $this->db->get_where('parent', array('parent_id' => $all_selected_student_from_student_table['parent_id']))->row()->phone;

            $this->db->where('exam_id', $exam_id);
            $this->db->where('student_id', $all_selected_student_from_student_table['student_id']);
            $select_student_score_from_mark_table = $this->db->get('mark')->result_array();

            foreach($select_student_score_from_mark_table as $key => $all_selected_student_scores_from_mark_table){
                $message = '';
            
                $selelect_all_subject_from_subject_table = $this->db->get_where('subject', array('subject_id' => $all_selected_student_scores_from_mark_table['subject_id']))->row()->name;
                $student_mark_obtained_in_class_score_and_exam = $all_selected_student_scores_from_mark_table['class_score1'] + $all_selected_student_scores_from_mark_table['class_score2'] + $all_selected_student_scores_from_mark_table['class_score3'] + $all_selected_student_scores_from_mark_table['exam_score'];
                $message .= $all_selected_student_scores_from_mark_table['student_id'] . ' ' . $selelect_all_subject_from_subject_table . ':' . $student_mark_obtained_in_class_score_and_exam . 'Over 100';

                // Sending sms 
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
     

        }

    }
    


	
	
}

