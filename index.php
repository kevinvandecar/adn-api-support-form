<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit a case - Autodesk Developer Network</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="/main.css"></link>

</head>
<body>

<h1>API Support</h1>

<h2>Create a case</h2>

<!-- API Support Form -->
<div class="apiSupportForm">
  <form action="submitForm.php" method="post" enctype="multipart/form-data" >

    <div class="requiredFieldText"><span class="required">*</span> = required field</div>

    <!-- Product Information -->
    <h3>Product Information</h3>
    <div class="productInfoContainer">

      <!-- Product field -->
      <div class="productInfoFieldContainer">
        <label for="productField">Product<span class="required">*</span></label><br>
        <select id="productField" class="field" name="product" required>
          <option value="" disabled selected>Select one</option>
          <?php
            // Fill the dropdown with a list of products
            $fieldsJson = file_get_contents('inputs/fields.json');
            $fields = json_decode($fieldsJson, true);
            $products = $fields['products'];

            foreach ($products as $product) {
              echo "<option value='$product'>$product</option>";
            }
          ?>
        </select>
      </div> 

      <!-- Release field -->
      <div class="productInfoFieldContainer">
        <label for="releaseField">Release<span class="required">*</span></label><br>
        <input type="text" id="releaseField" class="field" name="release" placeholder="2021" required>
      </div>

      <!-- Platform/OS -->
      <div class="productInfoFieldContainer">
        <label for="platformField">Platform/OS<span class="required">*</span></label><br>
        <input type="text" id="platformField" class="field" name="platform" placeholder="Windows" required>
      </div>

    </div>

    <!-- Case Information -->
    <h3>Case Information</h3>
    <div class="caseInfoContainer">

      <!-- Subject field -->
      <div class="caseInfoFieldContainer">
        <label for="subjectField">Subject<span class="required">*</span></label><br>
        <input type="text" id="subjectField" class="field" name="subject" required>
      </div>
      
      <!-- Description field -->
      <div class="caseInfoFieldContainer">
        <label for="descriptionField">Description<span class="required">*</span></label><br>
        <textarea type="text" id="descriptionField" class="field" name="description" required></textarea>
      </div>

    </div>

    <!-- Attach Files -->
    <h3>Attach Files</h3>
    <div class="filesContainer">

      <!-- Files field -->
      <div class="filesFieldContainer">
        <input type="file" id="filesField" name="files[]" multiple>      
      </div>
    
    </div>

    <!-- Submit/Clear Form -->
    <div class="formButtonsContainer">

      <!-- Submit button -->
      <input type="submit" class="formButton" value="Submit" name="submit">

      <!-- Clear button -->
      <input type="reset" class="formButton" value="Clear" name="clear">

    </div>

  </form>
</div>


</body>
</html>