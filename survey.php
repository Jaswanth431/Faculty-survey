<?php
session_start();
if(!isset($_SESSION['clg_id']) || empty($_SESSION['clg_id'])){
 echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
}
include "includes/db.php";
include "header.php";
?>  

  <?php 
      $id = $_SESSION['clg_id'];
      $query = "SELECT * FROM student_details where clg_id= '$id' LIMIT 1";
      $result = mysqli_query($conn,$query);
      if(!$result){
        echo mysqli_error($conn);
      }else{
          $row = mysqli_fetch_assoc($result);
          $section = $row['section'];
          $name = $row['name'];
      }
      $subjects = ["MATHEMATICS","PHYSICS","CHEMISTRY","INFORMATION TECHNOLOGY","TELUGU", "ENGLISH",];
      $sub_count = 6;
  ?>

  <div class="main">
      <h2 class="heading-primary text-center">Hello <i><?php echo $name.","?></i>(<span id="clg_id"><?php echo $id; ?></span>)</h2>
      <h2 class="heading-primary text-center mb-4">Complete the Faculty Survey</h2>

      <div class="element-box">
          <label for="">Section:</label>
          <select id="section" class="form-control form-control-lg select-info">
            <option value="<?php echo $section; ?>" selected><?php echo $section; ?></option>
          </select>
      </div>
      <div class="element-box">
          <label for="">Subject:</label>
          <select id="subject" class="form-control form-control-lg select-info">
            <option value="">Select Subject</option>
            <?php
              foreach($subjects as $subject){
                echo "<option value='".$subject."'>".$subject."</option>";
              }
            ?>
           </select>
       </div>
       <div class="element-box">
          <label for="">Faculty:</label>
          <select id="faculty" class="form-control form-control-lg select-info">
            <option value="">Select Faculty</option>
          </select>
       </div>

       <div class="element-box">
         <button id="get-survey-btn" class=" bg-primary">GET SURVEY</button>
       </div>
       <div class="element-box">
        <div class="logout-box">
              <button id="logout" class="bg-danger ">LOGOUT</button>
        </div>
       </div>
      
       <!-- error display box -->
       <div class="alert alert-danger text-center" id="survey-error-box" role="alert"></div>
        
       <!-- survey form box -->
       <div id="survey_form">
          
       </div>

          <div class="form-group button-submit-survey mb-5">
            <button id="submit_survey" class="bg-success">Submit Survey</button>
          </div>


      </div>
  </div>


  </body>
</html>

