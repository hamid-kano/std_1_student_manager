<?php
$success = Session::flash('success');
$error   = Session::flash('error');
?>
<?php if ($success): ?>
<div class="alert alert-success">
  <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="alert alert-error">
  <i class="fa-solid fa-circle-xmark"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>
