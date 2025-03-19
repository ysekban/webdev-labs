#!/usr/bin/perl
use strict;
use warnings;
use CGI ':standard';

print header;
print start_html(
    -title => 'My First Perl Program',
    -style => { -src => 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' }
);

print qq(
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            color: #0056b3; /* A color that's not black */
        }
        .large-text {
            font-size: 40px;
            margin-top: 50px;
        }
    </style>
);

print qq(
    <div class="large-text">This is my first Perl program</div>
);

print end_html;
