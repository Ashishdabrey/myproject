<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curved Border Div</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
    margin: 0;
}

.curved-div {
    position: relative;
    background-color: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.curved-div::before,
.curved-div::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: white;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.curved-div::before {
    top: -10px;
    left: -10px;
}

.curved-div::after {
    bottom: -10px;
    right: -10px;
}
</style>

</head>
<body>
    <div class="curved-div">
        This is a div with curved sides.
    </div>
</body>
</html>
