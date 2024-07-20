<?php
require_once('login_redirect.php');
include('header.php');
?>
<title>Home - Teacher Portal</title>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="home.php"><img id="imglogo" src="resources/images/logo.png" alt="logo"></a>
        <div class="collapse navbar-collapse" id="navbarText">
            <span class="navbar-text">
                <a href="logout.php" class="btn btn-danger" id="logoutbtn">Logout</a>
            </span>
        </div>
    </nav>
    <div class="student_container">
        <h2>Welcome, <?php echo isset($_SESSION['teacher']) ? $_SESSION['teacher'] : ''; ?></h2>
        <button type="button" id="createBtn" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#studentModal">Create Student</button>
        <table id="studentTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Tamil/Language</th>
                    <th>English</th>
                    <th>Mathematics</th>
                    <th>Science</th>
                    <th>Social Science</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Student Modal -->
    <div class="modal fade bd-example-modal-lg" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalTitle">Create Student</h5>
                </div>
                <div class="modal-body">
                    <form id="student_form" method="post">
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="roll_no">Roll Number</label>
                                <input type="text" class="form-control" name="roll_no" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" name="student_name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="standard">Class</label>
                                <select class="form-control" name="standard" id="class_std" required>
                                    <option value>Choose your class</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>
                                    <option value="3">III</option>
                                    <option value="4">IV</option>
                                    <option value="5">V</option>    
                                    <option value="6">VI</option>
                                    <option value="7">VII</option>
                                    <option value="8">VIII</option>
                                    <option value="9">IX</option>
                                    <option value="10">X</option>
                                    <option value="11">XI</option>
                                    <option value="12">XII</option>
                                </select>
                            </div>
                        </div>
                        <h5>Marks</h5>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="english">English</label>
                                <input type="text" class="form-control mark_field" name="english" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="language">Tamil/Language</label>
                                <input type="text" class="form-control mark_field" name="language" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="maths">Mathematics</label>
                                <input type="text" class="form-control mark_field" name="maths" required>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="science">Science</label>
                                <input type="text" class="form-control mark_field" name="science" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="social">Social Science</label>
                                <input type="text" class="form-control mark_field" name="social" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group text-center">
                            <input type="hidden" name="student_id" id="stud_id" value="">
                            <button type="submit" class="btn btn-primary saveStudent name="create">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>