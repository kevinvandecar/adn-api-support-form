<?php 

// Get account information and data from the submitted form.
$accountData = getAccountData();
$formData = getFormData();

// Create an array to hold all the data.
$dataArray = array();
$dataArray += $accountData;
$dataArray += $formData;

// Upload files, if any. 
if ($_FILES['files']['size'][0] > 0) {
  $fileData = uploadAttachments();
  $dataArray += $fileData;
  echo "Files attached.<br>";
}
else {
  echo "No files attached.<br>";
}

// Submit the data as a JSON.
submitFormAsJson($dataArray);
echo "API support case submitted.";


//-----------------------------------------------------------------------------

// Return account details from a JSON.
function getAccountData() {
  $accountDataJson = file_get_contents('inputs/account.json');
  $accountData = array(
    "account" => json_decode($accountDataJson, true)
  );
  return $accountData;
}

// Return data from the form.
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
  $fileNames = $_FILES['files']['name'];
  $fileTmpNames = $_FILES['files']['tmp_name'];
  $fileSizes = $_FILES['files']['size'];

  $numOfFiles = count($fileNames);
  $uploadDirectory = "outputs/uploads/";

  // Information on the files
  $fileData = array(
    "files" => array(
      "file_names" => $fileNames,
      "file_sizes" => $fileSizes
    )
  );

  // Upload multiple files
  for ($i = 0; $i < $numOfFiles; $i++) {
    $fileName = $fileNames[$i];
    $uploadPath = $uploadDirectory . basename($fileName);

    move_uploaded_file($fileTmpNames[$i], $uploadPath);
  }

  return $fileData;
}

// Submit form by writing to a JSON file with all the data.
function submitFormAsJson($dataArray) {
  $dataJson = json_encode($dataArray, JSON_PRETTY_PRINT);
  file_put_contents('outputs/submit.json', $dataJson);
}

  
?>