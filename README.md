### Course Registraton System (With Result Processing)
---

##### Development Tools & Technology :
---
* [CodeIgniter 2.x Framework](https://www.codeigniter.com/)
* [MySQL 5 +](https://www.mysql.com/)
* [CSS(960 Framework)](http://960.gs/)
* [AJAX & JQuery](https://jquery.com/)
* [FPDF v1.7](http://fpdf.org/)

##### Installation
---
1st import database which in(database directory).

In this project index.php file was removed, 
so if wampServer
needs mod_rewrite enabled.
Left-Click the system tray icon -> Apache -> Apache Modules -> rewrite_module

if XAMPP no need to change.

##### Here three types of user :
---

If Register section: </br>
User Id:R12345 </br>
Password:123456 </br>

If Adviser: </br>
User Id:A00001 </br>
Password:123456 </br>

If Student: </br>
User Id:074051 </br>
Password:123456 </br>

##### Userdefine Classes :
---
*MyTemplate :* This class contains Header, Footer and Sidebar of this project. When a page required header ,footer or sidebar then this page call its corresponding function like Header(), Footer(), Aside($aside). </br>
*Fpdf(Version: 1.7) :* It is a class library that downloaded from fpdf.org , which provide facility to create pdf file. </br>
*pdfTemplateForIdPassword :* This class inherits the Fpdf class. It contains the structure of  generated password pdf file for adviser and student. </br>
*pdfTemplateForResult :* This class also inherits the Fpdf class. And it contains the design of student grade sheet.

##### Database table and their relationship :
---
![alt text](http://i.imgur.com/fnTMkcw.jpg "Database design")

##### Basic forms and their criteria :
---
*Login form :*

![alt text](http://i.imgur.com/9ZTODuB.jpg "Login form")

When a user (teacher, register, student) login their ID & Password then it redirect their individual
destination (which decided by their ID)
