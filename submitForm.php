<?php 

// Get account information and data from the submitted form.
$accountData = getAccountData();
$formData = getFormData();

// Create an array to hold all the data (account information and submitted form data).
$dataArray = array();
$dataArray += $accountData;
$dataArray += $formData;

// Upload attached files to the uploads folder, if any. 
if ($_FILES['files']['size'][0] > 0) {
  $fileData = uploadAttachments();
  $dataArray += $fileData;
  echo "Files attached.<br>";
}
else {
  echo "No files attached.<br>";
}

// Add case to cases.json
addToCases($dataArray);
echo "<a href='/'>Go back</a>";



// Add new case data to list of cases
function addToCases($dataArray) {
  $casesJsonPath = "cases.json";
  $casesJson = file_get_contents($casesJsonPath);
  $casesArray = json_decode($casesJson, true);
  
  $caseData = array(
    "case_id" => count($casesArray)+1
  );
  $dataArray += $caseData;

  array_push($casesArray, $dataArray);
  $dataJson = json_encode($casesArray, JSON_PRETTY_PRINT);
  file_put_contents($casesJsonPath, $dataJson);

  echo "API support case submitted.<br>";
  echo "<pre>$dataJson</pre>";
}

// Return account details from a JSON.
function getAccountData() {
  $accountJsonPath = "account.json";

  $accountJsonPath = file_get_contents($accountJsonPath);
  $accountObj = json_decode($accountJsonPath);
  $accountData = array(
    "account_name" => $accountObj->account_name,
    "account_number" => $accountObj->account_number,
  );
  return $accountData;
}

// Return data from the submitted form.
function getFormData(){
  $formData = array(
    "product" => $_POST['product'],
    "release" => $_POST['release'],
    "platform" => $_POST['platform'],
    "subject" => $_POST['subject'],
    "description" => $_POST['description']
  );
  return $formData;
}

// Upload attachments to the uploads directory and return the file information.
function uploadAttachments() {
  $uploadDirectory = "uploads/";

  $fileNames = $_FILES['files']['name'];
  $fileTmpNames = $_FILES['files']['tmp_name'];
  $fileSizes = $_FILES['files']['size'];
  $numOfFiles = count($fileNames);
  
  // Information on the files
  $fileData = array(
    "files" => array(
      "file_names" => $fileNames,
      "file_sizes" => $fileSizes
    )
  );
  // Upload file/files
  for ($i = 0; $i < $numOfFiles; $i++) {
    $fileName = $fileNames[$i];
    $uploadPath = $uploadDirectory . basename($fileName);
    move_uploaded_file($fileTmpNames[$i], $uploadPath);
  }
  return $fileData;
}
  
?>