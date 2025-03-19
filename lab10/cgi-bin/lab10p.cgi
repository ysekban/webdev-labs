#!/usr/bin/env python
from __future__ import print_function
import cgi, cgitb
cgitb.enable()

form = cgi.FieldStorage()

city = form.getvalue('city').upper()
state = form.getvalue('state').upper()
country = form.getvalue('country').upper()
picture_url = form.getvalue('picture')

print("Content-Type: text/html")
print()
print("<html>")
print("<head><title>City Information</title></head>")
print("<body>")
print("<h1 style='text-align:center; background-color:green; color:white;'>{0}, {1}</h1>".format(city, country))
print("<img src='{0}' style='width:80%; height:auto; border: 5px solid red;'>".format(picture_url))
print("</body>")
print("</html>")
