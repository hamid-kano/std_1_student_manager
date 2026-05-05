<?php
// حماية مؤقتة - سيتم استبدالها بـ session PHP لاحقاً
?>
<?php include 'views/layout/header.php'; ?>
<?php include 'views/auth/login.php'; ?>

<div class="dashboard">
  <?php include 'views/layout/sidebar.php'; ?>

  <div class="content">
    <?php include 'views/pages/dashboard.php'; ?>
    <?php include 'views/pages/students.php'; ?>
    <?php include 'views/pages/faculties.php'; ?>
    <?php include 'views/pages/departments.php'; ?>
    <?php include 'views/pages/courses.php'; ?>
    <?php include 'views/pages/register.php'; ?>
    <?php include 'views/pages/staff.php'; ?>
    <?php include 'views/pages/grades.php'; ?>
    <?php include 'views/pages/absences.php'; ?>
    <?php include 'views/pages/cards.php'; ?>
  </div>
</div>

<?php include 'views/layout/footer.php'; ?>
