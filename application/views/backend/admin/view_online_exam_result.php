<?php
    $online_exam_details = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
    $students = $this->db->get_where('student', array('class_id' => $online_exam_details['class_id'], 'section_id' => $online_exam_details['section_id'], 
	'session' => $online_exam_details['running_year']))->result_array();
    $subject_info = $this->crud_model->get_subject_info($online_exam_details['subject_id']);
    $total_mark = $this->crud_model->get_total_mark($online_exam_id);
	$students = $this->db->get_where('student', array('section_id' => $online_exam_info->section_id))->row()->name;
?>

<div class="row">

	<div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;<?php echo get_phrase('student_results'); ?><a href="<?php echo base_url();?>admin/manage_online_exam"><button type="button"  class="btn btn-info btn-xs pull-right"><i class="fa fa-mail-reply-all"></i>&nbsp;back</button></a></div>
				  <div class="panel-body table-responsive">
				  
<div class="" style="text-align: left; border:1px solid green; padding-left:10px">
    <h4>Exam name:&nbsp;<?php echo $online_exam_details['title']; ?></h4>
    <?php foreach ($subject_info as $subject): ?>
        <h4><?php echo get_phrase('subject').': '.$subject['name']; ?></h4>
    <?php endforeach; ?>
    <h4><?php echo get_phrase('total_mark').': '.$total_mark; ?></h4>
    <h4><?php echo get_phrase('minimum_percentage').': '.$online_exam_details['minimum_percentage'].'%'; ?></h4>
    <?php
        $current_time = time();
        $exam_end_time = strtotime(date('Y-m-d', $online_exam_details['exam_date']).' '.$online_exam_details['time_end']);
        if ($current_time < $exam_end_time):?>
            <h4 style="color: #ef5350;"> <strong><?php echo get_phrase('exam_has_not_finished_yet'); ?></strong></h4>
    <?php endif ?>
</div>

								
		<table class="table">
			<thead>
                <tr>
                    <th><div><b><?php echo get_phrase('student_name');?></b></div></th>
                    <th><div><b><?php echo get_phrase('obtained_marks');?></b></div></th>
                    <th><div><b><?php echo get_phrase('result');?></b></div></th>
                </tr>
            </thead>
            <tbody>
            	<?php 

$online_exam_details1 = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
//echo(json_encode($online_exam_details1));
$online_exam_results1 = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id))->result_array();
//echo(json_encode($online_exam_results1));ddT
$students1 = $this->db->get_where('student', array('class_id' => $online_exam_details1['class_id'], 'section_id' => $online_exam_details1['section_id'], 'student_id' => '45',
'session' => $online_exam_details1['running_year']))->result_array();


//echo(json_encode($students1));

                   // $students = $this->db->get_where('student', array('section_id' => $online_exam_details->section_id, 'class_id' => $online_exam_details->class_id, 'session' => $online_exam_details->running_year  ))->row()->name;
                    ?>

<?php foreach ($online_exam_results1 as $key => $online_exam_result1): ?>

    <tr>

    <td>
    <?php $studentdetail = $this->db->get_where('student', array('student_id' => $online_exam_result1['student_id']))->row()->name;
 ?>
  <?php echo $studentdetail;?>

    </td>
                    	<td>
                            <?php echo $online_exam_result1['obtained_mark'];?>
                            
                        </td>
                        <td>
                         <?php echo $online_exam_result1['result'];?>
                        </td>

    </tr>
 <?php endforeach; ?>



            </tbody>
		</table>
	</div>
</div>
	</div>
</div>
