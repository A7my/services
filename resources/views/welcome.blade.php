<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service System</title>

<style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-image: url('https://th.bing.com/th/id/OIP.aUM_JglbgYaJu34tWkVZOgHaFj?pid=ImgDet&rs=1');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    margin: 0;
    padding: 0;
}

#container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.title {
    font-size: 36px;
    font-weight: bold;
    color: rgb(224, 231, 181);
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.choices {
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

.choice {
    flex: 1;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s;
}

.choice:hover {
    transform: scale(1.05);
}

h2, p {
    color: white;
}
</style>

</head>
<body>

<div id="container">
    <div class="title" >
        Services System
    </div>

    <div class="choices">
    <div class="choice" id="adminChoice">
        <h2>Login as Admin</h2>
        <p>Manage the service system as an administrator.</p>
    </div>

    <div class="choice" id="restaurantChoice">
        <h2>Login as Service Provider</h2>
        <p>Access and update your information.</p>
    </div>
    </div>

</div>

<script>
    const adminChoice = document.getElementById('adminChoice');
    const restaurantChoice = document.getElementById('restaurantChoice');

    adminChoice.addEventListener('click', () => {
    window.location.href = 'admin/login'; // Replace with your admin login page URL
    });

    restaurantChoice.addEventListener('click', () => {
    window.location.href = 'provider/login'; // Replace with your restaurant login page URL
    });
</script>

</body>
</html>
