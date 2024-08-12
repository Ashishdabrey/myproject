
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <style>
        body {
            background-image: url('images/4478925.jpg');
            background-size: cover;
            background-repeat: repeat;
            display: flex;
            justify-content: center;
            height: auto;
            font-family: Arial, sans-serif;
        }

        form {
            display: flex;
            flex-direction: column;
            background-color: #FFFDD0;
            max-width: 35%;
            border: 10px solid #2c5b4c;
            border-radius: 10px;
            padding: 30px;
            box-sizing: border-box;
            align-items: center;
            margin-top: 50PX;
            height: fit-content;
            margin-bottom: 40px;
            

            
        }
        ::-webkit-scrollbar {
            width: 15px;
            /* Scrollbar ki width */
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Scrollbar track ka background color */
        }

        ::-webkit-scrollbar-thumb {
            background-color: #2c5b4c;
            /* Scrollbar ki thumb ka color */
            border-radius: 6px;
            /* Round corners */
            border: 3px solid #f1f1f1;
            /* Thumb ke ird gird border */
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #e05570;
            /* Hover karne par thumb ka color */
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 10px;
            padding: 5px;
        }

        label {
            color: #2c5b4c;
            font-size: 23px;
            font-weight: bolder;
            width: 50%;
        }

        /* input,select{
            width: 50%;
            border:2px solid #2c5b4c;
            border-radius: 5px;
            color:#2c5b4c;
            padding: 5px;
            font-size: 18px;
        } */
        input,
        select,
        textarea {
            width: 50%;
            border: 2px solid #2c5b4c;
            border-radius: 5px;
            color: #2c5b4c;
            padding: 5px;
            font-size: 18px;
            box-sizing: border-box;
        }


        input[type="submit"],
        input[type="reset"] {
            width: 40%;
            padding: 10px 20px;
            font-size: 20px;
            background-color: #2c5b4c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #e05570;
        }

        h2 {
            color: #2c5b4c;
            font-size: 35px;
            margin-top: 0;
        }
    </style>
    <script>
    
        // Function to get query parameter value
        function getQueryParam(param) {
            let params = new URLSearchParams(window.location.search);
            return params.get(param);
        }

        // Check for status parameter and show alert accordingly
        window.onload = function() {
            let status = getQueryParam('status');
            if (status === 'success') {
                alert('Form submitted successfully!');
            }
        };




        window.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;
        });

        function calculateAge() {
            const dob = document.getElementById('dob').value;
            if (dob) {
                const dobDate = new Date(dob);
                const today = new Date();
                let age = today.getFullYear() - dobDate.getFullYear();
                const monthDiff = today.getMonth() - dobDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
                    age--;
                }
                document.getElementById('age').value = age;
            } else {
                document.getElementById('age').value = '';
            }
        }
    </script>
</head>

<body>
    <form action="preview.php" method="post" enctype="multipart/form-data">
        <h2>Employee Registration</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="fathername">Father's name:</label>
            <input type="text" id="fathername" name="fathername" required>
        </div>


        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="phone">Mobile no.:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required onchange="calculateAge()">
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="18" readonly required>
        </div>


        <div class="form-group">
            <label for="position">Position:</label>
            <select id="position" name="position" required>
                <option value="">Select a position</option>
                <option value="chef">Chef</option>
                <option value="sous-chef">Sous Chef</option>
                <option value="line-cook">Line Cook</option>
                <option value="prep-cook">Prep Cook</option>
                <option value="dishwasher">Dishwasher</option>
                <option value="server">Server</option>
                <option value="host">Host/Hostess</option>
                <option value="bartender">Bartender</option>
                <option value="busser">Busser</option>
                <option value="manager">Manager</option>
                <option value="assistant-manager">Assistant Manager</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date of joining:</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="bank-account">Bank Account Number:</label>
            <input type="text" id="bank-account" name="bank-account" required>
        </div>

        <div class="form-group">
            <label for="aadhaar">Aadhaar Number:</label>
            <input type="number" id="aadhaar" name="aadhaar" pattern="[0-9]{12}" required>
        </div>

        <div class="form-group">
            <label for="profile-pic">Profile Picture:</label>
            <input type="file" id="profile-pic" name="profile-pic" accept="image/*" required>
        </div>



        <div class="form-group">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

    </form>
</body>

</html>