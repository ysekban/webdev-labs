<%
' Check if the color is provided in the query string
Dim bgColor
bgColor = Request.QueryString("color")
If bgColor = "" Then bgColor = "#FFFFFF" ' Default to white if no color is specified

' Check for the cookie
Dim lastVisit
lastVisit = Request.Cookies("LastVisit")
If lastVisit = "" Then
    Response.Cookies("LastVisit") = Now()
    lastVisit = "This is your first visit."
Else
    Response.Cookies("LastVisit") = Now()
End If
%>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 10a - Dynamic Background</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: <%=bgColor%>;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            border: 1px solid #ddd;
            padding: 20px;
            background: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            color: #5a5a5a;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Lab 10a</h1>
    <p><strong>Last Visit:</strong> <%=lastVisit%></p>
</div>

</body>
</html>
