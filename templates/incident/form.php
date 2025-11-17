<?php
$isEdit = !empty($incident);
$actionUrl = $isEdit ? BASE_URL . '/?controller=incident&action=update' : BASE_URL . '/?controller=incident&action=store';
?>
<h2><?= $isEdit ? 'Edit Incident' : 'Report Incident' ?></h2>
<form method="post" action="<?= $actionUrl ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="IncidentID" value="<?= htmlspecialchars($incident['IncidentID']) ?>">
    <?php endif; ?>
    <label>Report Date<br><input type="datetime-local" name="ReportDate" required value="<?= $isEdit ? date('Y-m-d\TH:i', strtotime($incident['ReportDate'])) : date('Y-m-d\TH:i') ?>"></label><br>
    <label>Student<br>
        <select name="StudentID" required>
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['StudentID'] ?>"><?= htmlspecialchars($s['EnrollmentNo'].' - '.$s['FirstName'].' '.$s['LastName']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Location<br><input name="Location" value="<?= $isEdit ? htmlspecialchars($incident['Location']) : '' ?>"></label><br>
    <label>Description<br><textarea name="Description"><?= $isEdit ? htmlspecialchars($incident['Description']) : '' ?></textarea></label><br>
    <label>Status<br>
        <select name="Status">
            <option value="Open">Open</option>
            <option value="Under Review">Under Review</option>
            <option value="Actioned">Actioned</option>
            <option value="Closed">Closed</option>
        </select>
    </label><br><br>
    <button type="submit"><?= $isEdit ? 'Update' : 'Save' ?></button>
    <a href="<?= BASE_URL ?>/?controller=incident&action=index">Cancel</a>
</form>