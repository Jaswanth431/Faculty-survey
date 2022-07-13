<?php

include "db.php";
session_start();
ob_start();

//to login the user
  if(isset($_POST['id']) && isset($_POST['password'] )){
      $id = mysqli_real_escape_string($conn,$_POST['id']);
      $id = strtoupper($id);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

      if(empty($id) || empty($password)){
        echo "<script>
         $('#error-box').css('display', 'block');
          $('#error-box').text('All fields are required!!!');</script>";
        exit();
      }else{
        $query = "SELECT * FROM student_details WHERE clg_id = '$id' and hall_ticket = '$password'  LIMIT 1";
        $result =  mysqli_query($conn, $query);
        if(!$result){
          echo "<script>
          $('#error-box').css('display', 'block');
           $('#error-box').text('Connetion error !!!');</script>";
         exit();
        }else{
          if(!mysqli_num_rows($result)>0){
             echo "<script>
                $('#error-box').css('display', 'block');
                $('#error-box').text('Invalid ID or Password !!');</script>";
             exit();
          }else{
             $_SESSION['clg_id'] = $id;
              echo "<script type='text/javascript'>window.location.href = 'survey.php';</script>";
              exit();
          }
        }
      }
  }

//to logout the user
  if(isset($_POST['logout'])){
      session_unset();
      session_destroy();
      echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
  }

//to get faculty name with class and subject
if(isset($_POST['section']) && isset($_POST['subject'])){
  $section = $_POST['section'];
  $subject = $_POST['subject'];
  if(!empty($subject)){
      $query = "SELECT * FROM faculty_data WHERE section='$section' AND subject LIKE '$subject' LIMIT 1";
      $result =mysqli_query($conn,$query);
      if(!$result){
        echo "<option value=''>Unknown error</option>";
        exit();
      }else{
          if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            echo "<option value='".$row['name']."'>".$row['name']."</option>";
            exit();
          }
          else{
            echo "<option value=''>No data available</option>";
            exit();
          }
      }
  }

}


//get the survey form 
if(isset($_POST['survey_subject'])){
  $sub = $_POST['survey_subject'];
  $id = $_SESSION['clg_id'];
  if(!empty($sub)){
      $query = "SELECT * FROM survey_data WHERE clg_id='$id' AND subject='$sub' LIMIT 1";
      $result = mysqli_query($conn,$query);
      if(!$result){
          echo "
          <script>
          $('#survey-error-box').css('display', 'block');
          $('#survey-error-box').html('Unknown error occured!!');
          </script>
          ";
          exit();
      }else{
        if(mysqli_num_rows($result)> 0){
          echo "
          <script>
          $('#survey-error-box').css('display', 'block');
          $('#survey-error-box').html('You have already submitted  feedback for ".$sub." ');
          </script>
          ";
          exit();
        }else {
          $questions = [
              "1. Whether the Syllabus and the Lecture Plan are provided at beginning of the course?",
              "2. Is instructor punctual & regular to the class?",
              "3. Level of Instructor’s Preparedness to the class",
              "4. Level of Instructor’s Communication and Presentation",
              "5. Level of Instructor’s Effectiveness in organizing the class",
              "6. Level of Instructor’s subject depth",
              "7. Whether the instructor covered entire syllabus?",
              "8. Whether the instructor discussed topics beyond syllabus?",
              "9. Level of Instructor’s availability to the students outside the class room",
              "10. Overall quality in delivery of the course"
          ];
          $options = ["VERY GOOD(5 POINTS)","GOOD(4 POINTS)","FAIR(3 POINTS)","POOR(2 POINTS)","VERY POOR(1 POINTS)" ];
          $options_value = ["very_good", "good","fair","poor","very_poor"];

        $output = "";
        
          for( $i=0;$i<10;$i++){
            $x = $i+1;
            $output .= "<div class='form-group survey-question-box'><h3>".$questions[$i]."</h3>";
            $output .="<select  id='q".$x."' class='form-control form-control-lg'>";
            $output .= "<option value='' selected>Please select Rating points</option>";
            for($j=0;$j<5;$j++){
              $output.="<option value='".$options_value[$j]."'>".$options[$j]."</option>";
            }
            $output .="</select></div>";
          }
          $output .= "<div class='form-group survey-question-box'><h3>11. Share Your Review via Comment On The Faculty</h3><input  id='q11' class='form-control form-control-lg comment-box' placeholder='Share Your Review via Comment On The Faculty'></div><div class='form-group button-submit-survey mb-5'><button id='submit_survey' class='bg-success'>Submit Survey</button></div>";
        echo"
          <script>
          $('#survey-error-box').css('display', 'none');
          $('#submit_survey').css('display','block');
          $('#survey_form').html(\"". $output ."\");

          </script>
        ";
        exit();
        
        }//result
      }//empty sub
  }else{
    exit();
  }
}//isset

//to upload feedback to server
if(isset($_POST['upload_section']) && isset($_POST['upload_subject']) && isset($_POST['upload_faculty']) && isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3']) && isset($_POST['q4']) && isset($_POST['q5']) && isset($_POST['q6']) && isset($_POST['q7']) && isset($_POST['q8']) && isset($_POST['q9']) && isset($_POST['q10']) && isset($_POST['q11']) ){
  $section = $_POST['upload_section'];
  $sub = $_POST['upload_subject'];
  $faculty = $_POST['upload_faculty'];
  $q1 = $_POST['q1'];
  $q2 = $_POST['q2'];
  $q3 = $_POST['q3'];
  $q4 = $_POST['q4'];
  $q5 = $_POST['q5'];
  $q6 = $_POST['q6'];
  $q7 = $_POST['q7'];
  $q8 = $_POST['q8'];
  $q9 = $_POST['q9'];
  $q10 = $_POST['q10'];
  $q11= $_POST['q11'];
  $id = $_SESSION['clg_id'];

  if(!empty($section) && !empty($sub) && !empty($faculty) && !empty($q1) && !empty($q2) && !empty($q3) && !empty($q4) && !empty($q5) && !empty($q6) && !empty($q7) && !empty($q8) && !empty($q9) && !empty($q10) && !empty($q11) ){
    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $points = ["very_good"=>5,"good"=>4,"fair"=>3,"poor"=>2, "very_poor"=>1];
    $avg = ($points[$q1] + $points[$q2] +$points[$q3] +$points[$q4] +$points[$q5] +$points[$q6] +$points[$q7] +$points[$q8] +$points[$q9] +$points[$q10])/10;

    $date  = date("Y-m-d H:i:s");

    $query = "INSERT INTO survey_data(clg_id,subject,faculty,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,comments,avg,submitted,section,time) VALUES ('$id','$sub','$faculty', '$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$avg','yes','$section','$date')";

    $result = mysqli_query($conn,$query);
    if($result){
      echo"
      <script>
      $('#survey-error-box').css('display', 'block');
      $('#survey_form').html('');
      $('#submit_survey').css('display','none');
      $('#survey-error-box').html('Faculty feedback for ".$sub." is subbmitted!!');
      </script>
      ";
      exit();
    }else{
      echo"
      <script>
      $('#survey-error-box').css('display', 'block');
      $('#survey-error-box').html('Faculty feedback for ".$sub." is not submitted,Try again!!');
      </script>
      ";
      exit();
    }

  }

}
?>