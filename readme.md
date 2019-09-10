Quick Forum
=============
A very, very simple forum made in haste.
There are two types of users, admins and normal users.
Users can add posts and comments to each posts.

**If you have any ideas on how to make this simple project better please let me know!**

How to run this project
-----------------------
Honestly, I'm very inexperienced in running other projects thus the description is just a step by step guide on how I run this project myself.
As mentioned before, I'm inexperienced so ~~feel free to~~ **please correct me or send me ideas if you see any way to run this project in a better way**.

1) Download this repo into your xampp/htdocs folder.
2) Right click on the downloaded .zip file and select extract here.
3) Open XAMPP, click on config of the Apache module and open the httpd.conf file.
4) Now add a new virtualHost using these lines. Add the lines to the end of the httpd.conf file.  
   Document root is where your project's www folder is. For me it's *C://xampp/htdocs/forum-master/www*. 

`<VirtualHost localhost.forum:80>`  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`ServerAdmin localhost`  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`DocumentRoot C://xampp/htdocs/forum-master/www`  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`ServerName localhost.forum`  
`</VirtualHost>`

5) Add the new project to your hosts file. The path to the file, on Windows, is: *C:\Windows\System32\drivers\etc\hosts*  
   There add this line at the end of the file. `127.0.0.1       localhost.forum`
6) Let's add the database now. The .sql file's path is *www/db-backup/test.sql* .  
7) The project should be fine to run now. 


Images used
------------
All images are free and here are the links.
  
https://pixabay.com/photos/chihuahua-dog-puppy-cute-nose-2769980/

https://pixabay.com/photos/pug-the-awww-look-innocence-2494537/
