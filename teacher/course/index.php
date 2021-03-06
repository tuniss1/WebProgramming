<?php
// Create new teacher object:
$teacher = new Teacher($_SESSION["teacherId"]);

// Handle submit add course:
if (isset($_POST['btnAddCourse'])) {
  $teacher->addCourse($_POST['ipCourseName']);
}

// Handle edit courseName
if (isset($_POST['btnEditCourseName'])) {
  $teacher->editCourseName($_POST['courseId'], $_POST['ipEditCourseName']);
}

// Handle delete course
if (isset($_POST['btnDeleteCourse'])) {
  $teacher->deleteCourse($_POST['courseId']);
}
?>

<script>
  window.onload = function() {
    history.replaceState("", "", "./");
    <?php
    // if (isset($_POST['btnAddCourse']) || isset($_POST['btnEditCourseName']) || isset($_POST['btnDeleteCourse'])) {
    //   echo "history.back();";
    // }
    ?>
  }
</script>

<form class="form-course" method="POST">
  <div class="form-header">
    <div class="form-title">Add a course</div>
    <p class="wrong"></p>
  </div>
  <input type="text" name="ipCourseName" class="input" placeholder="Course Name" />
  <input type="hidden" name="courseId">
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button type="submit" class="submit" name="btnAddCourse">Submit</button>
  </div>
</form>

<h1><?php echo $title; ?></h1>

<div class="form-wrapper">
  <form class="form-edit" method="POST">
    <div class="form-header">
      <div class="form-title">Edit name</div>
      <p class="wrong"></p>
    </div>
    <input type="text" name="ipEditCourseName" class="input" placeholder="Course Name" />
    <input type="hidden" name="courseId">
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnEditCourseName">Submit</button>
    </div>
  </form>
</div>

<div class="form-wrapper">
  <form class="form-delete" method="POST">
    <p style="text-align: center">Do you want to delete this course ?</p>
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnDeleteCourse">Submit</button>
      <input type="hidden" name="courseId">
    </div>
  </form>
</div>

<div class="content-container">
  <?php
  // Create new teacher object:
  $teacher = new Teacher($_SESSION["teacherId"]);

  // Get teacher courses:
  $teacherCourses = $teacher->getAllCoursesBelongsTo();

              // <img src='../assets/ellipsis-h-solid.svg' alt='menu-icon' class='fas' />
  // Render courses to card
  foreach ($teacherCourses as $teacherCourse) {
    echo "
      <div class='card'>
        <div class='card-image'>
          <img src='../assets/course.png' alt=''>
        </div>
        <div class='card-content'>
          <p class='course-name'>" . $teacherCourse->name . "</p>
          <div class='content-bottom'>
            <a href='./?page=quiz&courseId=" . $teacherCourse->courseId . "&courseName=" . $teacherCourse->name . "'><button>View</button></a>
            <div class='drop-down'>
              <svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='ellipsis-h' class='svg-inline--fa fa-ellipsis-h fa-w-16 fas' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='currentColor' d='M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z'></path></svg>
              <div class='drop-down-list'>
                <p class='edit'>Edit name</p>
                <p class='delete'>Delete course</p>
              </div>
              <input type='hidden' name='courseId' value='" . $teacherCourse->courseId . "' >
            </div>
          </div>
        </div>
      </div> 
    ";
  }
  // }
  ?>
</div>
<script src="./course/course.js"></script>