// Problem 1 Functions

function validateName(name) {
    var regex = /^[a-zA-Z\s]+$/;
    return regex.test(name);
}

function validatePhone(phone) {
    var regex = /^\((\d{3})\)\s(\d{3})-(\d{4})$/;
    return regex.test(phone);
}

function transformPhone(phone) {
    var match = phone.match(/^\((\d{3})\)\s(\d{3})-(\d{4})$/);
    return match[1] + '-' + match[2] + '-' + match[3];
}

function processForm() {
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var phone = document.getElementById('phone').value;
    
    if(!validateName(name) && !validatePhone(phone)) {
        alert('Invalid input. Names should only contain letters. Phone numbers should be in the format (XXX) XXX-XXXX.');
        return;
    }

    else if (!validateName(name)) {
        alert('Invalid input. Names should only contain letters.');
        return;
    }

    else if (!validatePhone(phone)) {
        alert('Invalid input. Phone numbers should be in the format (XXX) XXX-XXXX.');
        return;
    }

    var transformedPhone = transformPhone(phone);
    displayOutput(name, address, transformedPhone);
}

function displayOutput(name, address, phone) {
    var outputDiv = document.getElementById('output');
    outputDiv.innerHTML = `<div style="font-weight:bold;">Name:</div><div>${name}</div>
        <div style="font-weight:bold;">Address:</div><div>${address}</div>
        <div style="font-weight:bold;">Phone:</div><div>${phone}</div>`;
    outputDiv.style.font = '2em Montserrat, sans-serif';
    outputDiv.style.color = 'blue';
    outputDiv.style.border = '2px solid black';
    outputDiv.style.padding = '10px';
    outputDiv.style.overflow = 'auto';
    outputDiv.style.overflowWrap = 'anywhere';

    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;
    
    outputDiv.style.width = (screenWidth * 0.5) + 'px';  // Set width to 50% of screen width
    outputDiv.style.height = (screenHeight * 0.3) + 'px';  // Set height to 30% of screen height

}

// Problem 2 Functions

function updateCounts() {
    var text = document.getElementById('textInput').value;
    var charCount = text.length;
    var letterCount = (text.match(/[a-zA-Z]/g) || []).length;
    
    document.getElementById('charCount').innerText = 'Character Count: ' + charCount;
    document.getElementById('letterCount').innerText = 'Letter Count: ' + letterCount;
}

// Call updateCounts initially to set the counts to 0
updateCounts();

// Problem 3 Functions

function displayBookmarks() {
    var bookmarks = [
        { url: 'https://www.google.com', secure: true },
        { url: 'http://www.neverssl.com', secure: false }
    ];

    var bookmarksDiv = document.getElementById('bookmarks');
    bookmarksDiv.innerHTML = '';

    bookmarks.forEach(bookmark => {
        var icon = bookmark.secure ? 
            '🟢🔒' :  // Green circle and closed padlock for secure URLs
            '🔴🔓';  // Red circle and open padlock for unsecure URLs
        var protocol = bookmark.secure ? 'HTTPS' : 'HTTP';
        bookmarksDiv.innerHTML += `<div><span title="${protocol}">${icon}</span> <a href="${bookmark.url}" target="_blank">${bookmark.url}</a></div>`;
    });
}


// Call displayBookmarks to show the bookmarks on page load
displayBookmarks();
