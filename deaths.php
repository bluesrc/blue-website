<?php require_once 'engine/init.php'; include 'layout/overall/header.php';
$cache = new Cache('engine/cache/deaths');
if ($cache->hasExpired()) {

	$deaths = fetchLatestDeaths();
	$cache->setContent($deaths);
	$cache->save();
} else {
	$deaths = $cache->load();
}
if ($deaths) {
?>
<h1>Latest Deaths</h1>
<table id="deathsTable" class="table table-striped">
	<tr class="yellow">
		<th>Victim</th>
		<th>Time</th>
		<th>Killer</th>
	</tr>
	<?php foreach ($deaths as $death) {
		echo '<tr>';
		echo "<td>At level ". $death['level'] .": <a href='characterprofile.php?name=". $death['victim'] ."'>". $death['victim'] ."</a></td>";
		echo "<td>". getClock($death['time'], true) ."</td>";
		echo "<td>". ucfirst($death['killed_by']) ."</td>";
		echo '</tr>';
	} ?>
</table>
<?php
} else echo 'No deaths exist.';
include 'layout/overall/footer.php'; ?>
