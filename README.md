### Course Registration System (With Result Processing)
---
This system is designed according to [DUET](http://www.duet.ac.bd/) (Dhaka University of Engineering and Technology) course registration and result processing system.  It can manage the Course Registration at the beginning of semester and process the student result at the end of the semester. Student can show his status, download mark sheet after publishing result and also get notification from the authority. Teachers (adviser) can verify his student’s registration status and can accept or deny after verifying students registration.

##### Development Tools & Technology :
---
* [CodeIgniter 3.1.10 Framework](https://www.codeigniter.com/)
* [MySQL 5 +](https://www.mysql.com/)
* [CSS(960 Framework)](http://960.gs/)
* [JQuery](https://jquery.com/)
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

![alt text](https://i.imgur.com/uhBA1yq.png "Login form")

When a user (teacher, register, student) login their ID & Password then it redirect their individual
destination (which is decided by their ID) .

##### Register Section
*Starting Form :* When authority (register) login then, he'll see the number of all advisers (separated by department) and students (separated by department) like this :

![alt text](https://i.imgur.com/y0prZIol.png "Register summary")

Here register section can insert a new student, teacher and also can be select adviser for a student or a group of student . When register section insert student and teacher, their password will be auto generated . After inserting information this section can print out password as a pdf file.

Student insertion forms and pdf files look like this :

*Student Insertion Form :*

![alt text](http://i.imgur.com/UDfID1O.jpg "Student Insertion Form")

*Download inrerface form :*

![alt text](https://i.imgur.com/AUdqIFYl.png "Download inrerface form")

*Downloaded pdf file :*

![alt text](https://i.imgur.com/zANKY5B.png "Downloaded pdf file")

##### Adviser Section

*Starting Form :* When adviser login then he'll see all requested student with their registration status like this :

![alt text](https://i.imgur.com/jwWA3B9l.png "Adviser startup")

Adviser can check their registration form(by clicking View Details) after checking he can accept or deny.

*View Details Form :*

![alt text](https://i.imgur.com/C4Bqd86l.png "View Details Form")

*Insert or Edit form :* A teacher can insert or edit a student mark by selecting subject criteria like this :

![alt text](https://i.imgur.com/81VUZOPl.png "Insert or Edit form for teacher")

##### Students Section

*Starting Form :* When a student login then he'll see notice that provided by Register Section :

![alt text](https://i.imgur.com/wb3j3Ozl.png "Students startup form")

*Registration Form :* Student can registered his current semester subject ,this subject will show automatically and if he failed any subject of previous semester, this will show automatically like this :

<img src="https://i.imgur.com/c33Zp6W.png" data-canonical-src="https://i.imgur.com/c33Zp6W.png" width="640"/>

*Download Result Form :* When publish result student can download his own result sheet as pdf file, by selecting required year and semester.

*Download inrerface form :*

![alt text](https://i.imgur.com/OlviUDpl.png "Download inrerface form")

*Pdf result sheet :*

![alt text](https://i.imgur.com/nw95TcN.png "Pdf result sheet")

#### Author
Arifur Rahman ( arif.rahman2009@gmail.com )

#### License

This application is released under the [MIT](http://www.opensource.org/licenses/MIT) License.

Copyright (c) 2014 [Arifur Rahman.](https://arif2009.github.io/)
