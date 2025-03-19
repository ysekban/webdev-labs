#!/usr/bin/perl

use strict;
use warnings;
use CGI;
use CGI::Carp qw(fatalsToBrowser);

my $q = CGI->new;

print $q->header;
print $q->start_html(-title => 'Customer Registration Results', -style => { -code => '
    body { font-family: Arial, sans-serif; margin: 20px; }
    .container { background: #f9f9f9; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
    h2 { color: #0056b3; }
    .error { color: red; }
    .info { margin-bottom: 10px; }
    img { max-width: 200px; max-height: 200px; border: 1px solid #ddd; }
'});


# Retrieving form data
my $fname = $q->param('fname');
my $lname = $q->param('lname');
my $street = $q->param('street');
my $city = $q->param('city');
my $postal_code = $q->param('postal_code');
my $province = $q->param('province');
my $phone = $q->param('phone');
my $email = $q->param('email');

my $photo = $q->param('photo');
my $upload_dir = '/class-years/y2019/ysekban/public_html/lab07/images';

if ($photo) {
    my $filename = $q->param('photo');
    $filename =~ s/.*[\/\\](.*)/$1/; # Extract filename from full path (if provided by browser)

    # Define the full path to save the file
    my $upload_file_path = "$upload_dir/$filename";

    # Open a filehandle to save the file
    open (my $upload_file, '>', $upload_file_path) or die "Can't open $upload_file_path: $!";
    binmode $upload_file;

    # Write the file data to the file
    while (my $bytesread = read($photo, my $buffer, 1024)) {
        print $upload_file $buffer;
    }

    close $upload_file;
}

# Validation
my $errors = {};
$errors->{phone} = 'Invalid phone number' unless $phone =~ /^\d{10}$/;
$errors->{postal_code} = 'Invalid postal code' unless $postal_code =~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/;
$errors->{email} = 'Invalid email address' unless $email =~ /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

# Displaying results
print qq(<div class="container">);
print qq(<h2>Customer Registration Details</h2>);

foreach my $field (qw(fname lname street city postal_code province phone email)) {
    my $value = $q->param($field) // '';
    print qq(<p class="info"><b>$field:</b> $value</p>) unless exists $errors->{$field};
}

foreach my $error (keys %$errors) {
    print qq(<p class="error">$errors->{$error}</p>);
}

my $filename = $q->param('photo');
$filename =~ s/.*[\/\\](.*)/$1/; # Extract filename
print qq(<p class="info"><img src="https://www2.cs.torontomu.ca/~ysekban/lab07/images/$filename" alt="Uploaded Photo"></p>);


print "<p>Upload directory: $upload_dir</p>";
print "<p>filename: $filename</p>";


print qq(</div>);
print $q->end_html;
