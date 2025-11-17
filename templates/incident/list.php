<?php
?>
<h2>Incidents</h2>
<p><a href="<?= BASE_URL ?>/?controller=incident&action=create">Report Incident</a></p>
<table>
    <tr><th>ID</th><th>Date</th><th>Student</th><th>Location</th><th>Status</th></tr>
    <?php foreach ($incidents as $i): ?>
    <tr>
        <td><?= htmlspecialchars($i['IncidentID']) ?></td>
        <td><?= htmlspecialchars($i['ReportDate']) ?></td>
        <td><?= htmlspecialchars($i['FirstName'].' '.$i['LastName']) ?></td>
        <td><?= htmlspecialchars($i['Location']) ?></td>
        <td><?= htmlspecialchars($i['Status']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>