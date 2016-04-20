<?php #student_search.inc$saved_grades = array();if($refine && get_cookie("grades") ){	$saved_grades = explode(",",get_cookie("grades"));}$lower_school = implode("\r", create_grade_checklist(0, 4,"grades", $saved_grades));$middle_school = implode("\r", create_grade_checklist(5,8,"grades", $saved_grades));$needs_checked = "";if($refine && get_cookie("hasNeeds")){	$needs_checked = "checked";}$former_students_checked = "";if($refine && get_cookie("includeFormerStudents")){	$former_students_checked = "checked";}$sorting = "last_first";if($refine && get_cookie("sorting")){	$sorting = get_cookie("sorting");}?><div id="advancedSearch">	<h2>Buscar Estudiante</h2>	<h6>Busqueda por grupos de estudiantes por Clase &amp; Grado</h6>	<form id="searchForm"		action="<?=site_url("student/search");?>" method="get"		name="searchForm">		<fieldset>			<legend>Grados</legend>			<ul class="search">				<?=$lower_school;?>			</ul>			<ul class="search">				<?=$middle_school;?>			</ul>			<div id="stuGroup-menu">			<label for="stuGroup">Grupo de Estudiantes:</label><? echo form_dropdown("stuGroup",array("0"=>"","A"=>"A","B"=>"B"),$refine?get_cookie("stuGroup"):"");?></div><div id="kTeach-menu"><label for="kTeach">Guia Montessori</label><?php echo form_dropdown("kTeach",$teachers,$refine?get_cookie("kTeach"):"");?></div ><div id="humanitiesTeacher-menu"><label for="humanitiesTeacher">Maestri de Humanidades</label><?php echo form_dropdown("humanitiesTeacher",$humanitiesTeachers,$refine?get_cookie("humanitiesTeacher"):"");?></div>		</fieldset>		<fieldset class='advanced'>			<legend>Avanzado</legend>			<div class='advanced'>				<input type="checkbox" name="hasNeeds" id="hasNeeds" value="1" <?=$needs_checked;?> />                                 <label for="hasNeeds">Solo mostrar Estudiantes con apoyo escolar</label>                                <br/>				<input type="checkbox" name="includeFormerStudents" id="includeFormerStudents" value="1" <?=$former_students_checked;?> />                                 <label for="includeFormerStudents">Iincluir Estudiantes Inscritos</label>				<br/>								</div>		</fieldset>		<fieldset>			<legend>Orden</legend>			<label for="sorting">Orden de Resultados: </label>			<?=form_dropdown("sorting",$student_sort,$sorting,"id='sorting'");?>		</fieldset>		<p id="yearSearch">			Ciclo Escolar<br />			<?=form_dropdown('year', $yearList, $currentYear,"id='year' class='year'"); ?>			- <input type="text" id='yearEnd' name="yearEnd" size="5"				maxlength="4" readonly value="<?=$currentYear + 1?>" />		</p>		<p style="text-align: center;">			<input type="submit" class="button" value="Buscar" />		</p>	</form></div>