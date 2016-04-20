<?php defined('BASEPATH') OR exit('No direct script access allowed');//define variables outside the html for less clutter.$currentYear = get_current_year();$stuDOB = format_date($student->stuDOB, 'standard');//create a human-friendly version of the enrollment status.$enrollmentStatus = "Enrolled";if($student->isEnrolled == 0){	$enrollmentStatus = "Not Enrolled";}$graduateStatus = FALSE;if($student->isGraduate == 1 && $student->stuGrade > 8){	$graduateStatus = "Yes";}$teacherLabel = "Guia Montessori";if($student->stuGrade > 4){	$teacherLabel = "Middle School Advisor";}?>		<h3>			Info for			<?=format_name($student->stuFirst, $student->stuLast, $student->stuNickname);?>		</h3>		<? $this->load->view("student/navigation", array("kStudent" => $student->kStudent));?>		<div class='content inner'>			<?			if( $this->session->userdata("dbRole") != 3 ){			$edit_buttons[] = array("href"=>site_url("student/edit/$student->kStudent"), "class"=>"student_edit dialog button edit", "id"=>"es_$student->kStudent", "text"=>"Edit Info");			print create_button_bar($edit_buttons);		}		?>			<fieldset class="fieldset" id="student-info">			<legend>General Info</legend>			<p>				<input type="hidden" name="target" value="student">			</p>			<p>				<label>First Name: </label><?=$student->stuFirst;?>			</p>			<p>				<label>Last Name: </label><?=$student->stuLast;?>			</p>			<p>				<label>Nickname: </label><?=$student->stuNickname;?>			</p>			<p>				<label>Birthdate: </label><?=$stuDOB;?>			</p>			<p>				<label>Grade at Enrollment:</label><?=format_grade($student->baseGrade);?>			</p>			<p>				<label>School Year of Enrollment: </label><?=$student->baseYear;?>-<?=$student->baseYear+1;?>			</p>				<p>				<label>Enrollment Status: </label><?=$enrollmentStatus;?>			</p>			<p>				<label>Current Grade: </label><?=format_grade($student->stuGrade);?>			</p>			<? if($student->stuGrade > 4): ?>			<p>				<label>Group: </label>				<? if($student->stuGrade < 7){					print "5/6 $student->stuGroup";				}else{				print "7/8 $student->stuGroup";			}?></p>				<? endif; //current grade > 4?>			<p>				<label>Gender: </label>				<?=$student->stuGender;?>			</p>			<? if($student->isEnrolled == 1 ): ?>			<p>				<label><?=$teacherLabel; ?>: </label>				<?=format_name($student->teachFirst,$student->teachLast);?>			</p>			<? if($student->stuGrade > 4):?>                <p>                <label>Humanities Teacher: </label>                			<?=format_name($student->humanitiesFirst,$student->humanitiesLast);?>                </p>              <?endif; //end if grade > 4 ?>		</fieldset>		<fieldset class="fieldset" style="width: 35%">			<legend>Email</legend>			<p>				<label>Address: </label>				<?=format_email(get_value($student,"stuEmail"),"TRUE");?>			</p>			<p>				<label>Parent Permission to Use Email: </label>				<? if(get_value($student,'stuEmailPermission') == 1){					echo "Yes";				}else{					echo "No";				}?>			</p>			<div class='password-box'>				<label class='link' title='click to toggle'>Show Password</label>&nbsp;				<span class='password-field'> <?=get_value($student,'stuEmailPassword');?>				</span>			</div>		</fieldset>		<? elseif($graduateStatus == "Yes") :?>			<p>			<label>Is a Graduate:</label>			<?=$graduateStatus;?>			</p>		<? endif; //if enrolled ?>		<!--  grade preferences are only used for middleschoolers and enrolled students.  -->		<? if(get_value($student,"isEnrolled") == 1 && get_current_grade($student->baseGrade, $student->baseYear) > 4):?>		<div id="grade-preferences">			<fieldset class="fieldset" style="width: 35%">				<legend>Grade Preferences</legend>				<p>Grade Preferences are for students who may be uniquely graded as					pass/fail in subjects traditionally graded with letter grades</p>				<? if(!empty($grade_preferences)):?>				<? $this->load->view("grade_preference/list",array('grade_preferences' =>$grade_preferences));?>				<? endif;?>				<?=create_button_bar(array(array(						"href"=>site_url("grade_preference/create/$student->kStudent"),						"text"=>"Add Grade Preference",						"class" => "link new dialog",						"selection" => "grade_preference",						"id" => sprintf("add-grade-preference_%s", $student->kStudent),					)));?>			</fieldset>		</div>		<? endif;?></div>