<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit a case - Autodesk Developer Network</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="/main.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>

<div class="container">

  <h1>API Support</h1>

  <div class="card">

    <!-- Navigation tabs -->
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="create-case-tab" data-toggle="tab" href="#create-case" role="tab" aria-controls="create-case" aria-selected="true">Create Case</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="view-cases-tab" data-toggle="tab" href="#view-cases" role="tab" aria-controls="view-cases" aria-selected="false">View Cases</a>
        </li>
      </ul>
    </div>

    <!-- Tab content -->
    <div class="card-body tab-content">

      <!-- Create case tab -->
      <div class="tab-pane fade show active" id="create-case" role="tabpanel" aria-labelledby="create-case-tab">
        <h5 class="card-title">Create Case</h5>
        <form action="submitForm.php" method="post" enctype="multipart/form-data" class="support-form">
          <div class="form-row">
            <!-- Product field -->
            <div class="form-group col">
              <label for="productField">Product<span class="required">*</span></label><br>
              <select id="productField" class="form-control" name="product" required>
                <option value="" disabled selected>Select one</option>
                <?php
                  // Fill the dropdown with a list of products
                  $fields = getDataFromJson('fields.json');
                  $products = $fields['products'];

                  foreach ($products as $product) {
                    echo "<option value='$product'>$product</option>";
                  }
                ?>
              </select>
            </div> 
            <!-- Release field -->
            <div class="form-group col">
              <label for="releaseField">Release/Version<span class="required">*</span></label><br>
              <input type="text" id="releaseField" class="form-control" name="release" aria-describedby="releaseFieldHelp" required>
              <small id="releaseFieldHelp" class="form-text text-muted">
                E.g. 2020, 2020.4, 2022, etc.
              </small>
            </div>
            <!-- Platform/OS -->
            <div class="form-group col">
              <label for="platformField">Platform/OS<span class="required">*</span></label><br>
              <input type="text" id="platformField" class="form-control" name="platform" aria-describedby="platformFieldHelp" required>
              <small id="platformFieldHelp" class="form-text text-muted">
                E.g. Windows 10, MacOS 10.15, etc.
              </small>
            </div>
          </div>
          <!-- Subject field -->
          <div class="form-group">
            <label for="subjectField">Subject<span class="required">*</span></label><br>
            <input type="text" id="subjectField" class="form-control" name="subject" required>
          </div>
          <!-- Description field -->
          <div class="form-group">
            <label for="descriptionField">Description<span class="required">*</span></label><br>
            <textarea type="text" id="descriptionField" class="form-control" name="description" rows="10" aria-describedby="descriptionFieldHelp" required></textarea>
            <small id="descriptionFieldHelp" class="form-text text-muted">
              Provide exact steps to reproduce the problem and include brief description of the expected result. 
              Include error messages if applicable.
            </small>
          </div>
          <!-- Files field -->
          <div class="form-group">
            <label for="filesField">Attach Files</label>
            <input type="file" id="filesField" class="form-control-file" name="files[]" aria-describedby="filesFieldHelp" multiple>      
            <small id="filesFieldHelp" class="form-text text-muted">
              File names: 80 characters max
            </small>
          </div>
          <div class="form-row">
            <!-- Submit button -->
            <input type="submit" class="col btn btn-primary" value="Submit" name="submit" style="margin-right: 5px">
            <!-- Clear button -->
            <input type="reset" class="col btn btn-secondary" value="Clear" name="clear" style="margin-left: 5px">
          </div>
        </form>
      </div>

      <!-- View cases tab -->
      <div class="tab-pane fade" id="view-cases" role="tabpanel" aria-labelledby="view-cases-tab">
        <h5 class="card-title">View Cases</h5>

        <!-- Account information -->
        <div class="card account-container">
          <div class="card-header">
            My Account
          </div>
          <div class="card-body">
          <?php 
            $account = getDataFromJson('account.json');

            $accountName = $account['account_name'];
            $accountNumber = $account['account_number'];

            echo "<strong>Account Name:</strong> $accountName<br>";
            echo "<strong>Account Number:</strong> $accountNumber";
          ?>
          </div>
        </div>

        <!-- Cases table -->
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">Case ID</th>
              <th scope="col">Product</th>
              <th scope="col">Release</th>
              <th scope="col">Subject</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $cases = getDataFromJson('cases.json');
              // Fill the table with a list of their cases
              foreach ($cases as $case) {
                $caseId = $case['case_id'];
                $product = $case['product'];
                $release = $case['release'];
                $subject = $case['subject'];
              
                echo "<tr><th scope='row'>$caseId</th>";
                echo "<td>$product</td>";
                echo "<td>$release</td>";
                echo "<td>$subject</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div> 

</div>


<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>


<?php 

function getDataFromJson($pathToJson) {
  $json = file_get_contents($pathToJson);
  $dataArray = json_decode($json, true);
  return $dataArray;
}

?>