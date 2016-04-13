<?php 
// narrative_view.inc
$narrYear = $narrative->narrYear;
$stuGrade = get_current_grade ( $narrative->baseGrade, $narrative->baseYear, $narrYear );
$report_grade = $narrative->narrGrade;
if ($letter_grade) {
	$report_grade = $letter_grade;
}
?>


$buttons [] = array (
		"text" => "Edit Original",
		"href" => site_url ( "narrative/edit/$narrative->kNarrative" ),
		"class" => "button edit small",
		"id" => "n_$narrative->kNarrative" 
); // ,
if ($benchmarks_available) {
	$buttons [] = array (
			"text" => "Edit Benchmarks",
			"href" => site_url ( "benchmark/edit_for_student/$narrative->kNarrative" ),
			"class" => "button dialog small" 
	);
}
if ($backups) {
	$buttons [] = array (
			"text" => "Show Backups",
			"href" => site_url ( "narrative/list_backups/$narrative->kNarrative" ),
			"class" =>"button small"
	);
}
print create_button_bar ( $buttons );
?>

if (! empty ( $benchmarks )) {
	
	$this->load->view ( "benchmark/chart", array (
			"benchmarks" => $benchmarks,
			"legend" => $legend));