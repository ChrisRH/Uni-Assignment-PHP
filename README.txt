READ ME

ASSIGNMENT 2

WEBSITE PROJECT SUBMISSION
SIT780 Enterprise Applications Development - Trimester 1, 2017

28 May 2017

-----------------------------------------------------------------

All requirements have been meet as per the 9 specifications layed out in the assignment project document.

Functionality beyond the requirements are as follows:

# Input validation: All user supplied input is validated so as no non-alphanumeric characters are passed to the database.

# Controlled access to pages to limit non-logged in users navigating to restricted pages.  Users cannot phycially navigate (copy/past url) to any page 
without the correct credentials. If a non-logged in use attempts to navigate to: http://www.deakin.edu.au/~hchri/sit780/website/home.php or other 
such pages (either using the menu system or url directly) they will be redirected to the login page. 
 
Likewise, if a 'normal' logged in user attempts to navigate (by bypassing the menu system) to an admin only page whist logged in they will 
be redirected to the home page - not logged out.

# Styling and layout captilises on modern HTML5 and CSS techniques and Twitter Bootstrap 3.  Therefore a modern browser is recommeded
when viewing this site.

# All images used on this site are used by permission under the Creative Commons License; sourced from https://pixabay.com

# Special attention was made to ensure when new staff were appended to the staff.xml file that the xml formatting was maintained 
when viewing the file itself - otherwise all new additions would be appended in one long line.

# Much attention has been given to usability; especially in prompting the end user of any mistakes they may have made, such as incorrect
input etc.

# This solution ensures that the test accounts cannot be deleted by the end user - therefore there will always be two test accounts at all times

# When a user logs out all session variables are cleaned/deleted.  This prevents a user, after logging out, from using the brower's back-button
to continue accessing restricted pages.

# A intermedite file called, 'validate.php', is used to authenticate all users.  This file is self-containing in that if new roles are added they can be 
added to this one area.  All attempted logins need to be approved by this file before they can move forward in the site.  Site visitors never navigate to 
this page as such, it is called when a user attempts to login.

