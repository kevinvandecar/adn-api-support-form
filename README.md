# ADN API Support Form

- **Start server on localhost**: `php -S localhost:3000`

- **Bootstrap** is used for quick and easy styling.

- `account.json` : An ADN members' account information.

- `cases.json` : A list of their support cases. All submitted cases will be added to the end of the list. Each case include their account information, form data (product, release, platform, etc.), files data (if there's any), and case ID.

- `fields.json` : Used to populate the fields in the support form. Currently, only the product field uses this to populate the dropdown.

- `index.php` : Main page to submit a new case and to view their cases, separated into tabs.

  - **Create Case tab**: All fields are required (excluding attaching files). The `fields.json` is used to populate the fields that are not text fields. Submitting the form will send the form data to `submitForm.php`.
  
  - **View Cases tab**: Displays their account information and a list of their cases. The `cases.json` is used to build the cases table.

- `main.css` : Main stylesheet. Not much here so far, but any additional styling can be added here.

- `submitForm.php` : The logic for submitting the form. It also displays the submission confirmation. 

  - The form data gets collected, any attached files is uploaded to `uploads` folder, and the submitted case gets added to `cases.json`. 
  
  - Displays all of the collected information as confirmation. A link is provided to go back to the main page.

- `uploads` : The folder where file attachments are uploaded.