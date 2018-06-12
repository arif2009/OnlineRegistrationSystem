### Course Registration System (With Result Processing)
---
This system is designed according to [DUET](http://www.duet.ac.bd/) (Dhaka University of Engineering and Technology) course registration and result processing system.  It manage the Course Registration at the beginning of semester and process the student result at the end of the semester. Student can show his status, download mark sheet after publishing result and also get notification from the authority. Teachers (adviser) can verify his student’s registration status and can accept or deny after verifying students registration.

##### Development Tools & Technology :
---
* [CodeIgniter 2.2.6 Framework](https://www.codeigniter.com/)
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
destination (which is decided by their ID) .

##### Register Section
*Starting Form :* When authority (register) login then, he'll see the number of all advisers (separated by department) and students (separated by department) like this :

![alt text](http://i.imgur.com/hpkKyx0.jpg "Register summary")

Here register section can insert a new student, teacher and also can be select adviser for a student or a group of student . When register section insert student and teacher, their password will be auto generated . After inserting information this section can print out password as a pdf file.

Student insertion forms and pdf files look like this :

*Student Insertion Form :*

![alt text](http://i.imgur.com/UDfID1O.jpg "Student Insertion Form")

*Download inrerface form :*

![alt text](http://i.imgur.com/9fZNYyE.jpg "Download inrerface form")

*Downloaded pdf file :*

![alt text](http://i.imgur.com/TbReSIV.jpg "Downloaded pdf file")

##### Adviser Section

*Starting Form :* When adviser login then he'll see all requested student with their registration status like this :

![alt text](http://i.imgur.com/SjgbEt1.jpg "Adviser startup")

Adviser can check their registration form(by clicking View Details) after checking he can accept or deny.

*View Details Form :*

![alt text](http://i.imgur.com/mqPx30r.jpg "View Details Form")

*Insert or Edit form :* A teacher can insert or edit a student mark by selecting subject criteria like this :

![alt text](http://i.imgur.com/e4eeeqM.jpg "Insert or Edit form for teacher")

##### Students Section

*Starting Form :* When a student login then he'll see notice that provided by Register Section :

![alt text](http://i.imgur.com/qpWif8I.jpg "Students startup form")

*Registration Form :* Student can registered his current semester subject ,this subject will show automatically and if he failed any subject of previous semester, this will show automatically like this :

![alt text](http://i.imgur.com/ZqRJBeu.jpg "Registration Form")

*Download Result Form :* When publish result student can download his own result sheet as pdf file, by selecting required year and semester.

*Download inrerface form :*

![alt text](http://i.imgur.com/gE91zIn.jpg "Download inrerface form")

*Pdf result sheet :*

![alt text](http://i.imgur.com/8ZPBnPU.gif "Pdf result sheet")

#### Author
Arifur Rahman ( arif.rahman2009@gmail.com )

#### License

This application is released under the [MIT](http://www.opensource.org/licenses/MIT) License.

Copyright (c) 2014 [Arifur Rahman.](http://arifur-rahman-sazal.blogspot.com/)
