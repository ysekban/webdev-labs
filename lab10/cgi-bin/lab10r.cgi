#!/usr/bin/env ruby
require 'cgi'
cgi = CGI.new

# Capitalize the inputs
city = cgi['city'].capitalize
state = cgi['state'].capitalize
country = cgi['country'].capitalize
picture_url = cgi['picture']

puts cgi.header
puts "<html>"
puts "<head><title>City Information</title></head>"
puts "<body>"
puts "<h1 style='text-align:center; background-color:blue; color:white;'>#{city}, #{country}</h1>"
puts "<img src='#{picture_url}' style='width:100%; height:auto;'>"
puts "</body>"
puts "</html>"
