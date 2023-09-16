<html>
<head>
    <title>all subjects page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="messages.php">
    <style>
        body {
            background-image: url("https://img.freepik.com/free-vector/blue-futuristic-networking-technology_53876-100679.jpg?w=360");
            background-size: cover;
        }
        #add {
            float: right;
        }
        fieldset {
            width: 70%;
            background-color: #404040;
        }
        input {
            width: 300px;
            height: 40px;
        }
        label, p {
            font-size: 40px;
            color: white;
        }
        #send, #add {
            width: 200px;
            border: 5px solid black;
        }
        h1 {
            font-size: 50px;
            color: black;
            background-color:white;
            border:5px solid black;

        }
        #btn1 {
            width: 150px;
            height: 50px;
        }
        .delete-btn {
            float: right;
        }
        #delete{
            display: none;
        }
        #subjectForm{
            display: none;
        }
        

    </style>
    <script>
        var fieldsetCount = 1;

        function deleteFieldset(event) {
            var fieldset = event.target.closest('fieldset');
            fieldset.remove();
            saveContent();
        }

        function addToForm(event) {
            event.preventDefault(); // Prevent form submission

            var form = document.getElementById("subjectForm");

            // Create the dynamic content
            var dynamicContent =
                "<fieldset id='subjectFieldset" + fieldsetCount + "'>" +
                "<button style='font-size:24px' class='delete-btn' onclick='deleteFieldset(event)'><i class='material-icons'>delete_forever</i></button>" +
                "<label>any comments" + fieldsetCount + ": </label><input type='longtext' name='S_comment" + fieldsetCount + "' id='S_comment" + fieldsetCount + "'><br><br>" +
                "<label>file name:     </label><input type='text' name='S_file" + fieldsetCount + "' id='S_file" + fieldsetCount + "'>" +
                "<label>->file link:  </label><input type='url' name='S_fileLink" + fieldsetCount + "' id='S_fileLink" + fieldsetCount + "'><br><br>" +
                "</fieldset>";

            // Append the dynamic content to the document
            var fieldsetContainer = form.querySelector('.fieldset-container');
            fieldsetContainer.insertAdjacentHTML('beforeend', dynamicContent);

            fieldsetCount++;
        }

        var i = 1;

        // Function to save dynamic content to localStorage
        function saveContent() {
            var subjectContainer = document.getElementById('subjectContainer');
            localStorage.setItem('dynamicContent', subjectContainer.innerHTML);
        }

        // Function to load dynamic content from localStorage
        function loadContent() {
            var subjectContainer = document.getElementById('subjectContainer');
            subjectContainer.innerHTML = localStorage.getItem('dynamicContent');
        }

        // Function to submit the form and add dynamic content
        function submitForm(event) {
            event.preventDefault(); // Prevent form submission

            var form = document.getElementById("subjectForm");

            var subjectName = form.elements["S_name"].value;

            var dynamicContent = "<center><fieldset><center>";
            dynamicContent += "<button style='font-size:24px' id='delete' onclick='deleteFieldset(event)'><i class='material-icons'>delete_forever</i></button>";
            dynamicContent += "<h1>" + subjectName + "</h1>";

            for (var j = 1; j < fieldsetCount; j++) {
                // Get the form inputs
                var comment = form.elements["S_comment" + j].value;
                var fileName = form.elements["S_file" + j].value;
                var fileLink = form.elements["S_fileLink" + j].value;

                // Create the dynamic content
                dynamicContent +=
                    "<p>" + comment + "</p><br>" +
                    "<label>click to open-></label><a href='" + fileLink + "' target='_blank'><button id='btn1'>" + fileName + "</button></a>";
            }

            dynamicContent += "</center></fieldset></center><br>";

            // Append the dynamic content to the document
            var subjectContainer = document.getElementById('subjectContainer');
            subjectContainer.innerHTML += dynamicContent;

            // Reset the form inputs
            form.reset();

            // Save the dynamic content to localStorage
            saveContent();
        }
    </script>
</head>
<body onload="loadContent()">
    <form id="subjectForm">
        <fieldset>
            <center>
                <label>subject name:  </label><input type="text" name="S_name" id="S_name"><br><br>
                <div class="fieldset-container"></div>
                <input type="submit" name="send" id="send" onclick="submitForm(event)">
                <input type="submit" value="add" name="add" id="add" onclick="addToForm(event)"> <br><br>
            </center>
        </fieldset>
    </form>

    <div id="subjectContainer"></div>
</body>
</html>

