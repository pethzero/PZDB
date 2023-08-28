<?php
include("sql_exe.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // $targetDir = "uploads/";
  $paramhdJson = isset($_POST['paramhd']) ? $_POST['paramhd'] : null;
  $paramhd = json_decode($paramhdJson, true);

  $sqlhd = sqlmixexe('test',$paramhd);
  echo $sqlhd;
  // print_r($paramhdJson);

  // //////////////////////////////////////////////////  UPLOAD ////////////////////////////////////////////////////
  if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] === UPLOAD_ERR_OK) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    if (file_exists($targetFile)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  } elseif (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] === UPLOAD_ERR_NO_FILE) {
    echo "No file was uploaded.";
    // ... continue with other processing if needed
  } else {
    echo "File upload error.";
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //////////////////////////////////////////////////// MUTIPLE UPLOAD ////////////////////////////////////////////////////
  echo '<br>';
  echo '---------';
  echo '<br>';
  if (isset($_FILES["mutiplefileToUpload"]) && is_array($_FILES["mutiplefileToUpload"]["error"])) {
    $targetDir = "uploads/";
    $uploadedFiles = $_FILES["mutiplefileToUpload"];
    $i = 0;
    foreach ($uploadedFiles["name"] as $key => $fileName) {
      if ($uploadedFiles["error"][$key] === UPLOAD_ERR_OK) {
        $targetFile = $targetDir . basename($fileName);

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;
        ++$i;

        if (file_exists($targetFile)) {
          echo "Sorry, file already exists.";
          echo '<br>';
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["mutiplefileToUpload"]["size"][$key] > 100) {
          echo "Sorry, your file  ".htmlspecialchars($fileName)  ." is too large.";
          echo '<br>';
          $uploadOk = 0;
        }

        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          echo '<br>';
          $uploadOk = 0;
        }
       

        if ($uploadOk == 0) {
          echo "$i"."Sorry, your file was not uploaded.";
          echo '<br>';
          echo '---------';
          echo '<br>';
        } else {
          if (move_uploaded_file($_FILES["mutiplefileToUpload"]["tmp_name"][$key], $targetFile)) {
            echo "$i"."The file " . htmlspecialchars($fileName) . " has been uploaded.";
            echo '<br>';
          } else {
            echo "$i"."Sorry, there was an error uploading your file.";
            echo '<br>';
          }
        }

        // // Check if file already exists
        // if (file_exists($targetFile)) 
        // {
        //   echo "Sorry, file $fileName already exists.";
        // } else {
        //   // ... continue with the rest of the file upload process

        //   // Move the uploaded file to the target directory
        //   if (move_uploaded_file($uploadedFiles["tmp_name"][$key], $targetFile)) {
        //     echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
        //   } else {
        //     echo "Sorry, there was an error uploading file: $fileName.";
        //   }

        //   echo '-------';
        // }
      } elseif ($uploadedFiles["error"][$key] === UPLOAD_ERR_NO_FILE) {
        echo "No file was uploaded.";
      } else {
        echo "File upload error for file: $fileName.";
      }
    }
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////  TABLE /////////////////////////////////////////////////////////////
  $tableData = json_decode($_POST['tableData'], true);
  if ($tableData) {
    echo "<table>";
    echo "<tr><th>Month</th><th>Savings</th></tr>";
    foreach ($tableData as $row) {
      echo "<tr><td>" . $row['month'] . "</td><td>" . $row['savings'] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No table data received.";
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
