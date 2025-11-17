<?php
$isEdit = !empty($student);
$actionUrl = $isEdit ? BASE_URL . '/?controller=student&action=update' : BASE_URL . '/?controller=student&action=store';
?>
<h2><?= $isEdit ? 'Edit Student' : 'Add Student' ?></h2>
<form method="post" action="<?= $actionUrl ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="StudentID" value="<?= htmlspecialchars($student['StudentID']) ?>">
    <?php endif; ?>
    <label>Enrollment No<br><input name="EnrollmentNo" required value="<?= $isEdit ? htmlspecialchars($student['EnrollmentNo']) : '' ?>"></label><br>
    <label>First Name<br><input name="FirstName" required value="<?= $isEdit ? htmlspecialchars($student['FirstName']) : '' ?>"></label><br>
    <label>Last Name<br><input name="LastName" required value="<?= $isEdit ? htmlspecialchars($student['LastName']) : '' ?>"></label><br>
    <label>DOB<br><input type="date" name="DOB" value="<?= $isEdit ? htmlspecialchars($student['DOB']) : '' ?>"></label><br>
    <label>Gender<br>
        <select name="Gender">
            <option value="">--</option>
            <option value="M" <?= ($isEdit && $student['Gender']=='M') ? 'selected' : '' ?>>M</option>
            <option value="F" <?= ($isEdit && $student['Gender']=='F') ? 'selected' : '' ?>>F</option>
            <option value="Other" <?= ($isEdit && $student['Gender']=='Other') ? 'selected' : '' ?>>Other</option>
        </select>
    </label><br>
    <label>Email<br><input name="Email" value="<?= $isEdit ? htmlspecialchars($student['Email']) : '' ?>"></label><br>
    <label>Phone<br><input name="Phone" value="<?= $isEdit ? htmlspecialchars($student['Phone']) : '' ?>"></label><br><br>
    <button type="submit"><?= $isEdit ? 'Update' : 'Create' ?></button>
    <a href="<?= BASE_URL ?>/?controller=student&action=index">Cancel</a>
</form>